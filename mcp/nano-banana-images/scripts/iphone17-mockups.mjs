// Generate iPhone 17 mockups for Digisaka mobile screenshots
// Usage: node scripts/iphone17-mockups.mjs
import { GoogleGenAI } from "@google/genai";
import dotenv from "dotenv";
import crypto from "node:crypto";
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const serverRoot = path.resolve(__dirname, "..");

dotenv.config({ path: path.join(serverRoot, ".env") });

const wpRoot = process.env.DIGISAKA_WP_ROOT || "C:\\wamp64\\www\\digisaka_website";
const outputDir = path.join(wpRoot, "wp-content", "uploads", "digisaka-generated");
const publicBaseUrl = (process.env.DIGISAKA_PUBLIC_BASE_URL || "http://localhost/digisaka_website").replace(/\/+$/, "");
const model = process.env.NANO_BANANA_MODEL || "gemini-3.1-flash-image";

const apiKey = (process.env.GEMINI_API_KEY || "").trim();
if (!apiKey || /your|paste|replace|api_key_here/i.test(apiKey)) {
  console.error("ERROR: Missing or placeholder GEMINI_API_KEY in .env");
  process.exit(1);
}

const client = new GoogleGenAI({ apiKey });

// Source images (theme assets)
const themeImagesDir = path.join(wpRoot, "wp-content", "themes", "digisaka-theme", "assets", "images");

const screenshots = [
  {
    name: "farm_alerts",
    sourcePath: path.join(themeImagesDir, "farm_alerts.jpg"),
    label: "Farm Alerts"
  },
  {
    name: "realtime_weather_updates",
    sourcePath: path.join(themeImagesDir, "realtime_weather_updates.jpg"),
    label: "Realtime Weather Updates"
  },
  {
    name: "ai_based_plant_analysis_result",
    sourcePath: path.join(themeImagesDir, "ai_based_plant_analysis_result.jpg"),
    label: "AI-based Plant Analysis Result"
  }
];

function sanitizeSlug(value) {
  return String(value || "digisaka-image")
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "")
    .slice(0, 70);
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

function mimeFromPath(filePath) {
  const ext = path.extname(filePath).toLowerCase();
  if (ext === ".jpg" || ext === ".jpeg") return "image/jpeg";
  if (ext === ".webp") return "image/webp";
  if (ext === ".gif") return "image/gif";
  return "image/png";
}

async function processScreenshot({ name, sourcePath, label }) {
  console.log(`\n📱 Processing: ${label}...`);

  // Read source image
  const sourceData = await fs.readFile(sourcePath);
  console.log(`   Source: ${sourcePath} (${(sourceData.length / 1024).toFixed(1)} KB)`);

  const prompt = `Take this mobile app screenshot and place it inside a realistic iPhone 17 Pro phone mockup. 
The phone must be shown in a straight FRONT VIEW — directly facing the camera, perfectly head-on, NOT angled or tilted.
The phone should have the modern iPhone 17 Pro design with thin bezels, Dynamic Island at the top.
Background: use a VERY subtle, barely-visible soft off-white to light-gray gradient. It should be nearly imperceptible — almost flat. No harsh edges, no tiles, no blocks, no patterns, no shadows cast on the background. The phone itself should be the only prominent element.
Make the screenshot fill the entire phone screen area naturally.
Do NOT add any text labels, watermarks, or fake UI elements on top.`;

  console.log(`   Generating with model: ${model}...`);

  const interaction = await client.interactions.create({
    model,
    input: [
      { type: "text", text: prompt },
      { type: "image", data: sourceData.toString("base64"), mime_type: mimeFromPath(sourcePath) }
    ]
  });

  const image = findImageBlock(interaction);
  if (!image?.data) {
    console.error(`   ❌ No image returned for ${label}`);
    return null;
  }

  // Save the result
  await fs.mkdir(outputDir, { recursive: true });
  const stamp = new Date().toISOString().replace(/[:.]/g, "-");
  const suffix = crypto.randomBytes(3).toString("hex");
  const ext = extensionFromMime(image.mimeType);
  const fileName = `${stamp}-iphone17-${sanitizeSlug(name)}-${suffix}${ext}`;
  const filePath = path.join(outputDir, fileName);
  await fs.writeFile(filePath, Buffer.from(image.data, "base64"));

  const relative = path.relative(wpRoot, filePath).split(path.sep).map(encodeURIComponent).join("/");
  const publicUrl = `${publicBaseUrl}/${relative}`;

  console.log(`   ✅ Saved: ${fileName}`);
  console.log(`   🌐 URL: ${publicUrl}`);

  return { fileName, filePath, publicUrl, label };
}

async function main() {
  console.log("=".repeat(60));
  console.log("Digisaka iPhone 17 Mockup Generator");
  console.log("=".repeat(60));
  console.log(`Output: ${outputDir}`);
  console.log(`Model: ${model}`);

  const results = [];
  for (const screenshot of screenshots) {
    try {
      const result = await processScreenshot(screenshot);
      if (result) results.push(result);
    } catch (err) {
      console.error(`   ❌ Error processing ${screenshot.label}:`, err.message);
    }
  }

  console.log("\n" + "=".repeat(60));
  console.log(`Done! ${results.length}/${screenshots.length} images generated.`);
  console.log("=".repeat(60));
  console.log("\nGenerated images:");
  for (const r of results) {
    console.log(`  ${r.label}: ${r.publicUrl}`);
  }
}

main().catch(err => {
  console.error("Fatal error:", err);
  process.exit(1);
});
