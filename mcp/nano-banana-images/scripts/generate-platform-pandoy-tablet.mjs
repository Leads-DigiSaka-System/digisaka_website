#!/usr/bin/env node
import { GoogleGenAI } from "@google/genai";
import dotenv from "dotenv";
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const serverRoot = path.resolve(__dirname, "..");

dotenv.config({ path: path.join(serverRoot, ".env") });

const wpRoot = process.env.DIGISAKA_WP_ROOT || "C:\\wamp64\\www\\digisaka_website";
const themeImagesDir = path.join(wpRoot, "wp-content", "themes", "digisaka-theme", "assets", "images");
const outputDir = path.join(themeImagesDir, "generated");
const model = process.env.NANO_BANANA_MODEL || "gemini-3.1-flash-image";
const apiKey = (process.env.GEMINI_API_KEY || process.env.GOOGLE_API_KEY || "").trim();

if (!apiKey || /your|paste|replace|api_key_here/i.test(apiKey)) {
  console.error(`ERROR: Missing or placeholder GEMINI_API_KEY in ${path.join(serverRoot, ".env")}`);
  process.exit(1);
}

const client = new GoogleGenAI({ apiKey });

function mimeFromPath(filePath) {
  const ext = path.extname(filePath).toLowerCase();
  if (ext === ".jpg" || ext === ".jpeg") return "image/jpeg";
  if (ext === ".webp") return "image/webp";
  return "image/png";
}

function extensionFromMime(mimeType) {
  const mime = String(mimeType || "image/png").toLowerCase();
  if (mime.includes("jpeg") || mime.includes("jpg")) return ".jpg";
  if (mime.includes("webp")) return ".webp";
  return ".png";
}

function findImageBlock(value, depth = 0) {
  if (!value || depth > 8) return null;
  if (Array.isArray(value)) {
    for (const item of value) {
      const found = findImageBlock(item, depth + 1);
      if (found) return found;
    }
    return null;
  }
  if (typeof value === "object") {
    const maybeData = value.data || value.inlineData?.data || value.inline_data?.data;
    const maybeMime = value.mime_type || value.mimeType || value.inlineData?.mimeType || value.inline_data?.mime_type;
    if (typeof maybeData === "string" && (maybeMime || value.type === "image" || value.type === "output_image")) {
      return { data: maybeData, mimeType: maybeMime || "image/png" };
    }
    for (const key of ["output_image", "outputImage", "image", "content", "parts", "steps", "output", "outputs"]) {
      const found = findImageBlock(value[key], depth + 1);
      if (found) return found;
    }
  }
  return null;
}

async function main() {
  const sourcePath = path.join(themeImagesDir, "pandoy.png");
  const sourceData = await fs.readFile(sourcePath);
  const prompt = `Use the provided image as the exact character reference for Pandoy.
Keep the same identity: friendly chubby 3D mascot, round smiling face, gray glasses, black bangs, wide woven straw hat, yellow sleeves, green apron/shirt, cheerful Philippine farm mascot style.
Change only the pose: both gloved hands should hold a modern dark tablet at chest height, as if helping farmers with AI advice. The tablet should be visible but should not cover the face. Keep the big smile and approachable expression.
Composition: upper body, centered, full hat visible, generous padding, premium clean 3D render, website-ready cutout for a small platform card.
Background must be perfectly flat solid #ff00ff from edge to edge for chroma key removal. Do not add extra text, labels, logos, watermarks, or random UI. Do not redesign the character into a different person.`;

  console.log(`Generating Pandoy tablet pose with ${model}...`);
  const interaction = await client.interactions.create({
    model,
    input: [
      { type: "text", text: prompt },
      { type: "image", data: sourceData.toString("base64"), mime_type: mimeFromPath(sourcePath) }
    ]
  });

  const image = findImageBlock(interaction);
  if (!image?.data) throw new Error("Nano Banana did not return an image block.");

  await fs.mkdir(outputDir, { recursive: true });
  const fileName = `platform-pandoy-ai-assistant-tablet${extensionFromMime(image.mimeType)}`;
  const filePath = path.join(outputDir, fileName);
  await fs.writeFile(filePath, Buffer.from(image.data, "base64"));

  const result = {
    generatedAt: new Date().toISOString(),
    model,
    sourcePath,
    fileName,
    filePath,
    relativePath: `assets/images/generated/${fileName}`,
    mimeType: image.mimeType || "image/png"
  };
  await fs.writeFile(path.join(serverRoot, "generated-platform-pandoy-tablet.json"), JSON.stringify(result, null, 2));
  console.log(JSON.stringify(result, null, 2));
}

main().catch((error) => {
  console.error(error);
  process.exit(1);
});