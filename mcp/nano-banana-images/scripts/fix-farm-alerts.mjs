// Quick fix: regenerate farm_alerts with clean background
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

const wpRoot = "C:\\wamp64\\www\\digisaka_website";
const outputDir = path.join(wpRoot, "wp-content", "uploads", "digisaka-generated");
const model = "gemini-3.1-flash-image";
const apiKey = (process.env.GEMINI_API_KEY || "").trim();

const client = new GoogleGenAI({ apiKey });

const sourcePath = path.join(wpRoot, "wp-content", "themes", "digisaka-theme", "assets", "images", "farm_alerts.jpg");
const sourceData = await fs.readFile(sourcePath);
console.log(`Source: ${sourcePath} (${(sourceData.length / 1024).toFixed(1)} KB)`);

// Strong prompt: phone on solid #FFFFFF background for clean edges
const prompt = `Take this mobile app screenshot and place it inside a realistic iPhone 17 Pro phone.
CRITICAL: Place the phone on a pure solid #FFFFFF white background — completely uniform, no gradient, no texture, no artifacts, no tiles, no blocks. The white must be perfectly flat and clean.
The phone must be in straight FRONT VIEW, directly head-on, not angled.
Modern iPhone 17 Pro design: thin bezels, Dynamic Island at top, titanium frame.
The screenshot must fill the entire phone screen naturally.
Do NOT add text, labels, watermarks, or extra UI.`;

console.log("Generating...");
const interaction = await client.interactions.create({
  model,
  input: [
    { type: "text", text: prompt },
    { type: "image", data: sourceData.toString("base64"), mime_type: "image/jpeg" }
  ]
});

// Find image block
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
    const d = value.data || value.inlineData?.data || value.inline_data?.data;
    const m = value.mime_type || value.mimeType || value.inlineData?.mimeType || value.inline_data?.mime_type;
    if (typeof d === "string" && (m || value.type === "image" || value.type === "output_image")) {
      return { data: d, mimeType: m || "image/png" };
    }
    for (const key of ["output_image", "outputImage", "image", "content", "parts", "steps", "output", "outputs"]) {
      const found = findImageBlock(value[key], depth + 1);
      if (found) return found;
    }
  }
  return null;
}

const image = findImageBlock(interaction);
if (!image?.data) {
  console.error("No image returned");
  process.exit(1);
}

await fs.mkdir(outputDir, { recursive: true });
const stamp = new Date().toISOString().replace(/[:.]/g, "-");
const suffix = crypto.randomBytes(3).toString("hex");
const ext = image.mimeType?.includes("jpeg") ? ".jpg" : ".png";
const fileName = `${stamp}-iphone17-farm-alerts-clean-${suffix}${ext}`;
const filePath = path.join(outputDir, fileName);
await fs.writeFile(filePath, Buffer.from(image.data, "base64"));

const publicBaseUrl = "http://localhost/digisaka_website";
const relative = path.relative(wpRoot, filePath).split(path.sep).map(encodeURIComponent).join("/");
console.log(`✅ Saved: ${fileName}`);
console.log(`🌐 URL: ${publicBaseUrl}/${relative}`);
