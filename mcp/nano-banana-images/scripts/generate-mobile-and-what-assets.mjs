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

async function saveStableImage(image, baseName) {
  await fs.mkdir(outputDir, { recursive: true });
  const ext = extensionFromMime(image.mimeType);
  const fileName = `${baseName}${ext}`;
  const filePath = path.join(outputDir, fileName);
  await fs.writeFile(filePath, Buffer.from(image.data, "base64"));
  return {
    fileName,
    filePath,
    relativePath: `assets/images/generated/${fileName}`,
    mimeType: image.mimeType || "image/png"
  };
}

async function generateFromText({ key, baseName, prompt, aspectRatio = "1:1" }) {
  console.log(`Generating ${key}...`);
  const finalPrompt = [
    "Create a high-quality website-ready image asset for Digisaka, a Philippine digital agriculture platform.",
    `Aspect ratio: ${aspectRatio}.`,
    "Use a clean premium green agriculture technology visual style.",
    "Avoid watermarks, fake logos, random text, and unreadable typography.",
    prompt
  ].join("\n");

  const interaction = await client.interactions.create({ model, input: finalPrompt });
  const image = findImageBlock(interaction);
  if (!image?.data) throw new Error(`No image returned for ${key}`);
  return saveStableImage(image, baseName);
}

async function generateFromScreenshot({ key, baseName, sourceFile, prompt }) {
  console.log(`Generating ${key} from ${sourceFile}...`);
  const sourcePath = path.join(themeImagesDir, sourceFile);
  const sourceData = await fs.readFile(sourcePath);
  const finalPrompt = [
    "Create a high-quality website-ready product mockup for Digisaka.",
    "Use the provided app screenshot as the phone screen content.",
    prompt
  ].join("\n");

  const interaction = await client.interactions.create({
    model,
    input: [
      { type: "text", text: finalPrompt },
      { type: "image", data: sourceData.toString("base64"), mime_type: mimeFromPath(sourcePath) }
    ]
  });
  const image = findImageBlock(interaction);
  if (!image?.data) throw new Error(`No image returned for ${key}`);
  return saveStableImage(image, baseName);
}

const phonePrompt = `
Place the screenshot inside a realistic iPhone 17 Pro front-view product cutout.
Critical requirements: preserve the screenshot design, text, colors, and layout; do not redesign the app; do not crop the left or right edges; scale the whole screenshot to fit naturally inside the screen.
Phone hardware: straight head-on iPhone 17 Pro, slim black bezels, Dynamic Island, polished dark titanium frame.
Background: transparent PNG if possible; otherwise perfectly flat white with no texture. No labels, no extra text, no added UI, no hand, no environment.
Make it suitable for a website product showcase beside other phones.`;

const jobs = [
  {
    type: "screenshot",
    key: "mobileFarmAlerts",
    baseName: "mobile-iphone17-farm-alerts",
    sourceFile: "farm_alerts.jpg",
    prompt: phonePrompt
  },
  {
    type: "screenshot",
    key: "mobileWeatherUpdates",
    baseName: "mobile-iphone17-weather-updates",
    sourceFile: "realtime_weather_updates.jpg",
    prompt: phonePrompt
  },
  {
    type: "screenshot",
    key: "mobileAiPlantAnalysis",
    baseName: "mobile-iphone17-ai-plant-analysis",
    sourceFile: "ai_based_plant_analysis_result.jpg",
    prompt: phonePrompt
  },
  {
    type: "text",
    key: "whatPhone",
    baseName: "what-digisaka-phone",
    aspectRatio: "9:16",
    prompt: `Create one isolated realistic iPhone 17 Pro front-view product cutout with transparent PNG background. The screen shows a clean Digisaka mobile dashboard: dark green header, satellite farm map with rice field parcel polygons, white rounded cards, a small farmer assistant avatar, bottom tab navigation icons, and a soft green/cream UI. Do not include readable body text, fake brand names, or random letters. Make the phone centered, sharp, premium, and similar to an agriculture app explainer graphic.`
  },
  {
    type: "text",
    key: "iconMobilePlatform",
    baseName: "what-icon-mobile-platform",
    prompt: `Transparent PNG icon only. Center a simple premium green line icon of a smartphone with a leaf and tiny signal spark. Dark forest green stroke, small light green accent, rounded organic style, no background, no text, no frame.`
  },
  {
    type: "text",
    key: "iconLowCarbonRice",
    baseName: "what-icon-low-carbon-rice",
    prompt: `Transparent PNG icon only. Center a simple premium green line icon showing a rice stalk inside a low-carbon eco badge with a small circular arrow. Dark forest green stroke, small light green accent, no background, no text, no frame.`
  },
  {
    type: "text",
    key: "iconSatelliteData",
    baseName: "what-icon-satellite-data",
    prompt: `Transparent PNG icon only. Center a simple premium green line icon of a satellite scanning a small farm grid map. Dark forest green stroke, small light green accent, no background, no text, no frame.`
  },
  {
    type: "text",
    key: "iconGis",
    baseName: "what-icon-gis",
    prompt: `Transparent PNG icon only. Center a simple premium green line icon of GIS map nodes connected around a location pin and polygon boundary. Dark forest green stroke, small light green accent, no background, no text, no frame.`
  },
  {
    type: "text",
    key: "iconAwd",
    baseName: "what-icon-awd",
    prompt: `Transparent PNG icon only. Center a simple premium green line icon for alternate wetting and drying water management: rice plants beside water level bars and a small droplet. Dark forest green stroke, small light green accent, no background, no text, no frame.`
  }
];

const manifest = { generatedAt: new Date().toISOString(), model, outputDir, images: {} };

for (const job of jobs) {
  const saved = job.type === "screenshot"
    ? await generateFromScreenshot(job)
    : await generateFromText(job);
  manifest.images[job.key] = saved;
  console.log(`Saved ${job.key}: ${saved.relativePath}`);
}

const manifestPath = path.join(serverRoot, "generated-mobile-and-what-assets.json");
await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
console.log(JSON.stringify(manifest, null, 2));
