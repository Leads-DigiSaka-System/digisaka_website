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
const manifestPath = path.join(serverRoot, "generated-about-icons.json");

const base = "STRICT isolated icon asset only. The entire background from edge to edge must be one perfectly flat solid #ff00ff color for chroma key removal. Center one simple premium green line icon, rounded organic agriculture style, dark forest green stroke, tiny light green accent, no text, no letters, no numbers, no logos, no watermark, no square frame, no shadow outside the icon. Keep generous #ff00ff padding. Do not use #ff00ff in the icon.";

const jobs = [
  { key: "mission", slug: "about-icon-mission", prompt: `${base} Icon concept: farmer decision mission, a document checklist with a small sprout and location marker.` },
  { key: "vision", slug: "about-icon-vision", prompt: `${base} Icon concept: thriving farm vision, a sprout inside a circular ecosystem with small connected nodes.` },
  { key: "commitment", slug: "about-icon-commitment", prompt: `${base} Icon concept: commitment and inclusive growth, two hands supporting a small leaf.` },
  { key: "betterFarmers", slug: "about-icon-better-farmers", prompt: `${base} Icon concept: better farmers, simple farmer hat with a sprout and upward leaf.` },
  { key: "dataInsights", slug: "about-icon-data-insights", prompt: `${base} Icon concept: data-driven insights, clean rising bar chart with small leaf.` },
  { key: "farmEmpowerment", slug: "about-icon-farm-empowerment", prompt: `${base} Icon concept: farm empowerment, a strong hand holding a sprouting rice plant.` },
  { key: "closeOutletMarket", slug: "about-icon-close-outlet-market", prompt: `${base} Icon concept: close-outlet market, connected people nodes with a tiny produce basket.` },
  { key: "sustainableFuture", slug: "about-icon-sustainable-future", prompt: `${base} Icon concept: sustainable future, circular arrows around a leaf and water drop.` }
];

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-about-icons", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({ command: "node", args: [serverPath], cwd: serverRoot });
await client.connect(transport);
const manifest = { generatedAt: new Date().toISOString(), images: {} };
try {
  for (const job of jobs) {
    console.error(`Generating ${job.key}...`);
    const result = await client.callTool({
      name: "generate_digisaka_image",
      arguments: {
        prompt: job.prompt,
        filenameSlug: job.slug,
        section: "about",
        aspectRatio: "1:1",
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
