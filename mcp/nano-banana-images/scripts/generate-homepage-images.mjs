#!/usr/bin/env node
import { Client } from "@modelcontextprotocol/sdk/client/index.js";
import { StdioClientTransport } from "@modelcontextprotocol/sdk/client/stdio.js";
import fs from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const serverRoot = path.resolve(__dirname, "..");
const serverPath = path.join(serverRoot, "src", "server.mjs");
const manifestPath = path.join(serverRoot, "generated-homepage-images.json");

const jobs = [
  {
    key: "hero",
    section: "hero",
    aspectRatio: "16:9",
    filenameSlug: "homepage-hero-digital-rice-field",
    prompt: "Wide cinematic Philippine rice field with mountains and soft morning sky, premium digital agriculture website hero background. Show subtle transparent GIS lines, small satellite-inspired data points, and a clean location pin integrated into the field. No words, no logos, no fake UI text, no watermark. Leave darker green space on the left for headline text."
  },
  {
    key: "about",
    section: "about",
    aspectRatio: "4:3",
    filenameSlug: "homepage-about-filipino-farmers-tablet",
    prompt: "Three Filipino farmers in straw hats standing in a lush rice field, smiling and reviewing farm data on a tablet together. Documentary-realistic but polished like a premium agriculture website. Green mountains in the background, natural daylight, no text, no logos, no watermark."
  },
  {
    key: "sustainability_field",
    section: "sustainability",
    aspectRatio: "16:9",
    filenameSlug: "homepage-sustainability-rice-field-mountains",
    prompt: "Beautiful sustainable rice farm landscape with bright green rows, clean irrigation channels, and blue-green mountains behind it. Climate-smart agriculture mood, realistic, crisp, optimistic, website card image. No text, no logos, no watermark."
  },
  {
    key: "sustainability_drone",
    section: "sustainability",
    aspectRatio: "16:9",
    filenameSlug: "homepage-sustainability-drone-rice-field",
    prompt: "Agricultural drone flying low over a healthy rice field, monitoring crops with a clean modern precision agriculture feeling. Realistic daylight, lush rows, subtle motion, premium website card image. No text, no logos, no watermark."
  },
  {
    key: "news_farmer",
    section: "news",
    aspectRatio: "16:9",
    filenameSlug: "homepage-news-farmer-digital-agriculture",
    prompt: "Editorial news thumbnail: Filipino farmer in rice field holding a tablet with a hopeful expression, warm sunlight, digital agriculture story mood. Realistic, clean, no readable text, no logos, no watermark."
  },
  {
    key: "news_partnership",
    section: "news",
    aspectRatio: "16:9",
    filenameSlug: "homepage-news-agri-partnership-field",
    prompt: "Editorial news thumbnail: agricultural technician and farmer in a rice field discussing sustainable farming, tablet and field notebook visible, friendly partnership mood, realistic, no text, no logos, no watermark."
  },
  {
    key: "news_resilience",
    section: "news",
    aspectRatio: "16:9",
    filenameSlug: "homepage-news-resilient-agriculture-drone",
    prompt: "Editorial news thumbnail: crop monitoring scene with a drone above a rice field and a field worker checking crop health, resilient agriculture and technology theme, realistic, no text, no logos, no watermark."
  },
  {
    key: "news_features",
    section: "news",
    aspectRatio: "16:9",
    filenameSlug: "homepage-news-new-webgis-features",
    prompt: "Editorial news thumbnail: aerial view of rice paddies with subtle digital map-layer glow and crop analytics feeling, modern WebGIS feature update image, realistic landscape, no text, no logos, no watermark."
  }
];

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-homepage-image-batch", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({
  command: "node",
  args: [serverPath],
  cwd: serverRoot
});

await client.connect(transport);
const manifest = {
  generatedAt: new Date().toISOString(),
  serverPath,
  images: {}
};

try {
  for (const job of jobs) {
    console.error(`Generating ${job.key}...`);
    const result = await client.callTool(
      {
        name: "generate_digisaka_image",
        arguments: {
          prompt: job.prompt,
          filenameSlug: job.filenameSlug,
          section: job.section,
          aspectRatio: job.aspectRatio,
          outputTarget: "theme"
        }
      },
      undefined,
      { timeout: 180000 }
    );
    const parsed = parseToolJson(result);
    manifest.images[job.key] = parsed;
    console.error(`Saved ${job.key}: ${parsed.filePath}`);
  }
  await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
  console.log(JSON.stringify(manifest, null, 2));
} finally {
  await client.close();
}