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
const outputDir = path.join(wpRoot, "wp-content", "themes", "digisaka-theme", "assets", "images", "generated");
const model = process.env.NANO_BANANA_MODEL || "gemini-3.1-flash-image";
const apiKey = (process.env.GEMINI_API_KEY || process.env.GOOGLE_API_KEY || "").trim();

if (!apiKey || /your|paste|replace|api_key_here/i.test(apiKey)) {
  console.error(`ERROR: Missing or placeholder GEMINI_API_KEY in ${path.join(serverRoot, ".env")}`);
  process.exit(1);
}

const client = new GoogleGenAI({ apiKey });

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

async function saveImage(image, baseName) {
  await fs.mkdir(outputDir, { recursive: true });
  const ext = extensionFromMime(image.mimeType);
  const fileName = `${baseName}${ext}`;
  const filePath = path.join(outputDir, fileName);
  await fs.writeFile(filePath, Buffer.from(image.data, "base64"));
  return { fileName, filePath, relativePath: `assets/images/generated/${fileName}`, mimeType: image.mimeType || "image/png" };
}

async function generate({ key, baseName, prompt, aspectRatio = "1:1" }) {
  console.log(`Generating ${key}...`);
  const finalPrompt = [
    "Create a high-quality website-ready image asset for Digisaka, a Philippine digital agriculture platform.",
    `Aspect ratio: ${aspectRatio}.`,
    "Reference style: soft clean agriculture technology website illustration, premium dark green and light leaf green palette, friendly Filipino context, suitable for a light green homepage section.",
    "Avoid watermarks, fake logos, random text, letters, numbers, and unreadable typography.",
    prompt
  ].join("\n");
  const interaction = await client.interactions.create({ model, input: finalPrompt });
  const image = findImageBlock(interaction);
  if (!image?.data) throw new Error(`No image returned for ${key}`);
  return saveImage(image, baseName);
}

const cutoutBase = "STRICT isolated persona illustration only. The entire background from edge to edge must be one perfectly flat solid #ff00ff color for chroma key removal. Center the upper-body character or small pair, with generous padding. Soft modern 3D/illustration hybrid matching Digisaka Pandoy website style. Dark green and farm colors, no text, no letters, no numbers, no logos, no watermark, no frame. Do not use #ff00ff inside the character.";

const jobs = [
  {
    key: "usersBackground",
    baseName: "users-parallax-background",
    aspectRatio: "16:9",
    prompt: "Create a very soft pale green parallax background for a website section. Rolling Philippine rice field hills, faint terrace shapes, subtle leaf silhouettes, morning light, clean airy composition, no people, no buildings, no text, no logos. It should be low-contrast so dark green text can sit on top."
  },
  {
    key: "filipinoFarmers",
    baseName: "users-filipino-farmers",
    prompt: `${cutoutBase} Persona: two Filipino farmers, one male and one female, wearing farm hats and green/yellow field clothing, friendly confident expressions, holding a small crop or phone/tablet, representing empowered farmers.`
  },
  {
    key: "agriculturalTechnicians",
    baseName: "users-agricultural-technicians",
    prompt: `${cutoutBase} Persona: Filipino agricultural technician, young professional in green field vest, holding a tablet and clipboard, data-driven field operations, friendly and capable expression.`
  },
  {
    key: "governmentAgencies",
    baseName: "users-government-agencies",
    prompt: `${cutoutBase} Persona: Filipino government agriculture officer, smart casual formal green jacket, holding documents or tablet, trustworthy policy and program decision maker, friendly professional expression.`
  },
  {
    key: "researchersPartners",
    baseName: "users-researchers-partners",
    prompt: `${cutoutBase} Persona: Filipino researcher or partner, professional with beard or mature look, holding a tablet/stylus, innovation and collaboration, friendly thoughtful expression, agriculture technology style.`
  }
];

const manifest = { generatedAt: new Date().toISOString(), model, outputDir, images: {} };
for (const job of jobs) {
  const saved = await generate(job);
  manifest.images[job.key] = saved;
  console.log(`Saved ${job.key}: ${saved.relativePath}`);
}
const manifestPath = path.join(serverRoot, "generated-users-assets.json");
await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
console.log(JSON.stringify(manifest, null, 2));