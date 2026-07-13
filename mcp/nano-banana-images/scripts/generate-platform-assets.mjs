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
    "Reference style: clean minimal agriculture technology, premium dark green and leaf green accents, white-card website UI friendly.",
    "Avoid watermarks, fake logos, random text, letters, numbers, and unreadable typography.",
    prompt
  ].join("\n");
  const interaction = await client.interactions.create({ model, input: finalPrompt });
  const image = findImageBlock(interaction);
  if (!image?.data) throw new Error(`No image returned for ${key}`);
  return saveImage(image, baseName);
}

const magentaIconBase = "STRICT isolated icon asset only. The entire background from edge to edge must be one perfectly flat solid #ff00ff color for chroma key removal. Center one simple premium green line icon, dark forest green stroke, small light green accent, rounded organic agriculture style. No text, no letters, no numbers, no logo, no watermark, no frame, no shadow outside the icon. Keep generous #ff00ff padding. Do not use #ff00ff inside the icon.";

const jobs = [
  {
    key: "smartFarmMonitoring",
    baseName: "platform-icon-smart-farm-monitoring",
    prompt: `${magentaIconBase} Icon concept: smart farm monitoring, a small robot sensor with leaves, dots, and a circular field monitor signal.`
  },
  {
    key: "precisionAgriculture",
    baseName: "platform-icon-precision-agriculture",
    prompt: `${magentaIconBase} Icon concept: precision agriculture, rising bar chart with crop sprout and a small target marker.`
  },
  {
    key: "pestDiseaseMonitoring",
    baseName: "platform-icon-pest-disease-monitoring",
    prompt: `${magentaIconBase} Icon concept: pest and disease monitoring, simple beetle/insect inside a protective scan ring with tiny leaf marks.`
  },
  {
    key: "climateSmartFarming",
    baseName: "platform-icon-climate-smart-farming",
    prompt: `${magentaIconBase} Icon concept: climate-smart farming, two healthy leaves with a subtle water droplet and circular climate signal.`
  },
  {
    key: "pandoyAssistant",
    baseName: "platform-pandoy-ai-assistant",
    aspectRatio: "1:1",
    prompt: "Create an isolated friendly Filipino young farmer AI assistant character named Pandoy, upper body, wearing a straw farm hat and green farm shirt, holding a dark tablet. Add a small cute green robot chat bubble floating near his shoulder. Soft modern illustration with gentle dimensional shading. Background must be perfectly flat solid #ff00ff from edge to edge for chroma key removal. No text, no letters, no logo, no watermark. Do not use #ff00ff in the character."
  }
];

const manifest = { generatedAt: new Date().toISOString(), model, outputDir, images: {} };
for (const job of jobs) {
  const saved = await generate(job);
  manifest.images[job.key] = saved;
  console.log(`Saved ${job.key}: ${saved.relativePath}`);
}
const manifestPath = path.join(serverRoot, "generated-platform-assets.json");
await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
console.log(JSON.stringify(manifest, null, 2));