#!/usr/bin/env node
import { McpServer } from "@modelcontextprotocol/sdk/server/mcp.js";
import { StdioServerTransport } from "@modelcontextprotocol/sdk/server/stdio.js";
import { GoogleGenAI } from "@google/genai";
import dotenv from "dotenv";
import { z } from "zod";
import crypto from "node:crypto";
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const serverRoot = path.resolve(__dirname, "..");

dotenv.config({ path: path.join(serverRoot, ".env") });

const wpRoot = path.resolve(process.env.DIGISAKA_WP_ROOT || path.join(serverRoot, "..", ".."));
const defaultOutputDir = path.resolve(
  process.env.DIGISAKA_IMAGE_OUTPUT_DIR || path.join(wpRoot, "wp-content", "uploads", "digisaka-generated")
);
const publicBaseUrl = (process.env.DIGISAKA_PUBLIC_BASE_URL || "http://localhost/digisaka_website").replace(/\/+$/, "");
const defaultModel = process.env.NANO_BANANA_MODEL || "gemini-3.1-flash-image";

const sectionHints = {
  hero: "A cinematic Philippine rice field or farm landscape for a website hero, modern digital agriculture mood, realistic and bright.",
  about: "Filipino farmers and agricultural field teams collaborating with mobile or tablet tools, warm documentary style.",
  platform: "Digital agriculture platform visuals, GIS maps, satellite monitoring, crop analytics, clean product-marketing composition.",
  webgis: "Aerial farmland, satellite map, field monitoring and GIS analysis visual, suitable for WebGIS product sections.",
  mobile: "Mobile agriculture app in use in a rice field, farm alerts, crop monitoring, practical and trustworthy.",
  sustainability: "Climate-smart rice farming, AWD, sustainable agriculture, carbon-smart farming, lush and realistic.",
  news: "Agriculture innovation news thumbnail, Filipino farming context, modern and editorial.",
  partner: "Agriculture partnership and institutional collaboration, professional and optimistic."
};

function requireApiKey() {
  const key = (process.env.GEMINI_API_KEY || process.env.GOOGLE_API_KEY || "").trim();
  if (!key) {
    throw new Error(`Missing GEMINI_API_KEY. Set it in ${path.join(serverRoot, ".env")}`);
  }
  if (/your|paste|replace|api_key_here/i.test(key)) {
    throw new Error(`GEMINI_API_KEY looks like a placeholder. Set the real key in ${path.join(serverRoot, ".env")}`);
  }
  return key;
}

function getClient() {
  return new GoogleGenAI({ apiKey: requireApiKey() });
}

function sanitizeSlug(value) {
  const slug = String(value || "digisaka-image")
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "")
    .slice(0, 70);
  return slug || "digisaka-image";
}

function ensureInsideWpRoot(candidatePath) {
  const resolved = path.resolve(candidatePath);
  const rootWithSep = wpRoot.endsWith(path.sep) ? wpRoot : `${wpRoot}${path.sep}`;
  if (resolved !== wpRoot && !resolved.startsWith(rootWithSep)) {
    throw new Error(`Refusing path outside WordPress root: ${resolved}`);
  }
  return resolved;
}

function resolveOutputDir(target, customOutputDir) {
  if (target === "theme") {
    return ensureInsideWpRoot(path.join(wpRoot, "wp-content", "themes", "digisaka-theme", "assets", "images", "generated"));
  }
  if (target === "custom") {
    if (!customOutputDir) {
      throw new Error("customOutputDir is required when outputTarget is custom.");
    }
    const custom = path.isAbsolute(customOutputDir) ? customOutputDir : path.join(wpRoot, customOutputDir);
    return ensureInsideWpRoot(custom);
  }
  return ensureInsideWpRoot(defaultOutputDir);
}

function extensionFromMime(mimeType) {
  const mime = String(mimeType || "image/png").toLowerCase();
  if (mime.includes("jpeg") || mime.includes("jpg")) return ".jpg";
  if (mime.includes("webp")) return ".webp";
  return ".png";
}

function mimeFromPath(filePath) {
  const ext = path.extname(filePath).toLowerCase();
  if (ext === ".jpg" || ext === ".jpeg") return "image/jpeg";
  if (ext === ".webp") return "image/webp";
  if (ext === ".gif") return "image/gif";
  return "image/png";
}

function toPublicUrl(filePath) {
  const resolved = ensureInsideWpRoot(filePath);
  const relative = path.relative(wpRoot, resolved).split(path.sep).map(encodeURIComponent).join("/");
  return `${publicBaseUrl}/${relative}`;
}

function buildPrompt({ prompt, section, aspectRatio }) {
  const sectionLine = section && sectionHints[section] ? `Section direction: ${sectionHints[section]}` : "";
  return [
    "Create a high-quality, website-ready visual for Digisaka, a Philippine digital agriculture platform.",
    sectionLine,
    `Aspect ratio: ${aspectRatio}.`,
    "Style: realistic, clean, premium, agriculture technology, bright natural light, visually inspectable subjects.",
    "Avoid random text, fake logos, distorted UI, watermarks, and unreadable typography unless text is explicitly requested.",
    `User prompt: ${prompt}`
  ].filter(Boolean).join("\n");
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

async function saveImage({ base64Data, mimeType, filenameSlug, outputDir }) {
  await fs.mkdir(outputDir, { recursive: true });
  const stamp = new Date().toISOString().replace(/[:.]/g, "-");
  const suffix = crypto.randomBytes(3).toString("hex");
  const fileName = `${stamp}-${sanitizeSlug(filenameSlug)}-${suffix}${extensionFromMime(mimeType)}`;
  const filePath = path.join(outputDir, fileName);
  await fs.writeFile(filePath, Buffer.from(base64Data, "base64"));
  return {
    fileName,
    filePath,
    publicUrl: toPublicUrl(filePath),
    mimeType: mimeType || "image/png"
  };
}

async function generateImage({ prompt, filenameSlug, section, aspectRatio, model, outputTarget, customOutputDir, includeGoogleSearch }) {
  const client = getClient();
  const finalPrompt = buildPrompt({ prompt, section, aspectRatio });
  const interaction = await client.interactions.create({
    model,
    input: finalPrompt,
    ...(includeGoogleSearch ? { tools: [{ type: "google_search" }] } : {})
  });
  const image = findImageBlock(interaction);
  if (!image?.data) {
    throw new Error("Nano Banana did not return an image block.");
  }
  const outputDir = resolveOutputDir(outputTarget, customOutputDir);
  const saved = await saveImage({
    base64Data: image.data,
    mimeType: image.mimeType,
    filenameSlug: filenameSlug || section || "digisaka-image",
    outputDir
  });
  return { ...saved, model, section, outputTarget, prompt: finalPrompt };
}

async function editImage({ sourceImagePath, prompt, filenameSlug, model, outputTarget, customOutputDir }) {
  const sourcePath = ensureInsideWpRoot(path.isAbsolute(sourceImagePath) ? sourceImagePath : path.join(wpRoot, sourceImagePath));
  const sourceData = await fs.readFile(sourcePath);
  const client = getClient();
  const interaction = await client.interactions.create({
    model,
    input: [
      { type: "text", text: buildPrompt({ prompt, section: undefined, aspectRatio: "same as source image" }) },
      { type: "image", data: sourceData.toString("base64"), mime_type: mimeFromPath(sourcePath) }
    ]
  });
  const image = findImageBlock(interaction);
  if (!image?.data) {
    throw new Error("Nano Banana did not return an edited image block.");
  }
  const outputDir = resolveOutputDir(outputTarget, customOutputDir);
  const saved = await saveImage({
    base64Data: image.data,
    mimeType: image.mimeType,
    filenameSlug: filenameSlug || `${path.basename(sourcePath, path.extname(sourcePath))}-edit`,
    outputDir
  });
  return { ...saved, model, sourceImagePath: sourcePath };
}

const mcp = new McpServer({
  name: "digisaka-nano-banana-images",
  version: "1.0.0"
});

mcp.tool(
  "generate_digisaka_image",
  "Generate a new Digisaka website image with Gemini Nano Banana and save it into WordPress uploads or theme assets.",
  {
    prompt: z.string().min(8).describe("Detailed image prompt."),
    filenameSlug: z.string().optional().describe("Short filename slug, for example homepage-hero-rice-field."),
    section: z.enum(["hero", "about", "platform", "webgis", "mobile", "sustainability", "news", "partner"]).optional(),
    aspectRatio: z.enum(["1:1", "16:9", "3:2", "4:3", "9:16"]).default("16:9"),
    model: z.string().default(defaultModel).describe("Nano Banana model id."),
    outputTarget: z.enum(["uploads", "theme", "custom"]).default("uploads"),
    customOutputDir: z.string().optional().describe("Relative to WordPress root, or absolute inside WordPress root."),
    includeGoogleSearch: z.boolean().default(false).describe("Allow Gemini to use Google Search for grounding when the image prompt benefits from current references.")
  },
  async (args) => {
    const result = await generateImage(args);
    return {
      content: [
        { type: "text", text: JSON.stringify(result, null, 2) }
      ]
    };
  }
);

mcp.tool(
  "edit_digisaka_image",
  "Edit an existing image inside digisaka_website with Nano Banana and save a new image file.",
  {
    sourceImagePath: z.string().describe("Image path inside WordPress root, for example wp-content/uploads/example.png."),
    prompt: z.string().min(8).describe("Edit instruction."),
    filenameSlug: z.string().optional(),
    model: z.string().default(defaultModel),
    outputTarget: z.enum(["uploads", "theme", "custom"]).default("uploads"),
    customOutputDir: z.string().optional()
  },
  async (args) => {
    const result = await editImage(args);
    return {
      content: [
        { type: "text", text: JSON.stringify(result, null, 2) }
      ]
    };
  }
);

mcp.tool(
  "list_digisaka_generated_images",
  "List recently generated Digisaka website images from the default generated uploads folder.",
  {
    limit: z.number().int().min(1).max(50).default(20)
  },
  async ({ limit }) => {
    await fs.mkdir(defaultOutputDir, { recursive: true });
    const entries = await fs.readdir(defaultOutputDir, { withFileTypes: true });
    const images = [];
    for (const entry of entries) {
      if (!entry.isFile()) continue;
      if (!/\.(png|jpe?g|webp)$/i.test(entry.name)) continue;
      const filePath = path.join(defaultOutputDir, entry.name);
      const stat = await fs.stat(filePath);
      images.push({
        fileName: entry.name,
        filePath,
        publicUrl: toPublicUrl(filePath),
        bytes: stat.size,
        modified: stat.mtime.toISOString()
      });
    }
    images.sort((a, b) => b.modified.localeCompare(a.modified));
    return {
      content: [
        { type: "text", text: JSON.stringify(images.slice(0, limit), null, 2) }
      ]
    };
  }
);

const transport = new StdioServerTransport();
await mcp.connect(transport);