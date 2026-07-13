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
const manifestPath = path.join(serverRoot, "generated-hero-overlays.json");

const jobs = [
  {
    key: "polygon",
    filenameSlug: "hero-farm-polygon-overlay-nano-banana",
    section: "hero",
    aspectRatio: "16:9",
    prompt: "Transparent website overlay asset only, shown on a perfectly flat solid #ff00ff chroma key background. A realistic digital GIS farm boundary polygon matching a Philippine rice field hero reference: white thin perspective grid lines, white node dots at corners, translucent yellow green farm parcels inside the polygon, one clean green map location pin in the center, subtle glow. No real background landscape, no words, no logos, no watermark, no shadows outside the asset. Keep the complete overlay centered with generous padding. Do not use #ff00ff anywhere in the asset."
  },
  {
    key: "cropHealth",
    filenameSlug: "hero-card-crop-health-nano-banana",
    section: "hero",
    aspectRatio: "4:3",
    prompt: "Transparent website overlay asset only, shown on a perfectly flat solid #ff00ff chroma key background. A premium glassmorphism agriculture analytics card, rounded rectangle, translucent moss green glass, soft border, subtle grid. Exact readable text: Crop Health, Good, 86%. Include a white crop-health line chart and a small simple status circle icon. No logos, no watermark, no extra words. Keep the whole card centered with generous padding. Do not use #ff00ff anywhere in the card."
  },
  {
    key: "yieldForecast",
    filenameSlug: "hero-card-yield-forecast-nano-banana",
    section: "hero",
    aspectRatio: "4:3",
    prompt: "Transparent website overlay asset only, shown on a perfectly flat solid #ff00ff chroma key background. A premium glassmorphism agriculture forecast card, rounded rectangle, translucent moss green glass, soft border, subtle grid. Exact readable text: Yield Forecast, High. Include a clean white vertical bar chart with six bars and a tiny slash-zero forecast icon. No logos, no watermark, no extra words. Keep the whole card centered with generous padding. Do not use #ff00ff anywhere in the card."
  },
  {
    key: "satellite",
    filenameSlug: "hero-satellite-overlay-nano-banana",
    section: "hero",
    aspectRatio: "1:1",
    prompt: "Transparent website overlay asset only, shown on a perfectly flat solid #ff00ff chroma key background. A small sleek agriculture satellite / remote sensing accent icon, white and deep green, slight realistic 3D shine, solar panels, tiny data signal dots, designed for a digital farming hero section. No words, no logos, no watermark. Keep centered with generous padding. Do not use #ff00ff anywhere in the subject."
  }
];

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-hero-overlay-batch", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({ command: "node", args: [serverPath], cwd: serverRoot });
await client.connect(transport);
const manifest = { generatedAt: new Date().toISOString(), serverPath, images: {} };

try {
  for (const job of jobs) {
    console.error(`Generating ${job.key} with Nano Banana...`);
    const result = await client.callTool({
      name: "generate_digisaka_image",
      arguments: {
        prompt: job.prompt,
        filenameSlug: job.filenameSlug,
        section: job.section,
        aspectRatio: job.aspectRatio,
        outputTarget: "theme"
      }
    }, undefined, { timeout: 240000 });
    const parsed = parseToolJson(result);
    manifest.images[job.key] = parsed;
    console.error(`Saved ${job.key}: ${parsed.filePath}`);
  }
  await fs.writeFile(manifestPath, JSON.stringify(manifest, null, 2));
  console.log(JSON.stringify(manifest, null, 2));
} finally {
  await client.close();
}
