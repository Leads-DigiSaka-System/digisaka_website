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
const outPath = path.join(serverRoot, "generated-polygon-overlay.json");

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-polygon-overlay-regenerate", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({ command: "node", args: [serverPath], cwd: serverRoot });
await client.connect(transport);
try {
  const result = await client.callTool({
    name: "generate_digisaka_image",
    arguments: {
      prompt: "STRICT isolated transparent UI overlay asset. The entire background from edge to edge must be one perfectly flat solid #ff00ff color for chroma key removal. No rice field photo, no landscape, no full rectangular map tile, no square grid sheet, no text, no logos, no watermark. Draw only one irregular six to seven point farm plot boundary, like a realistic plotted polygon on a GIS map: skewed perspective, front edge lower, right side angled, one small notch, thin white glowing boundary lines, small white node dots on vertices and internal grid intersections, a few internal white subdivision lines, translucent pale yellow-green fill only inside the irregular polygon, one green map pin near the center. Leave generous #ff00ff padding around the irregular plot. Do not use #ff00ff in the asset.",
      filenameSlug: "hero-farm-polygon-overlay-nano-banana-irregular",
      aspectRatio: "16:9",
      outputTarget: "theme"
    }
  }, undefined, { timeout: 240000 });
  const parsed = parseToolJson(result);
  await fs.writeFile(outPath, JSON.stringify(parsed, null, 2));
  console.log(JSON.stringify(parsed, null, 2));
} finally {
  await client.close();
}
