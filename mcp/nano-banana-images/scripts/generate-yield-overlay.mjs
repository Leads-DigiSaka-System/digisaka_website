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
const outPath = path.join(serverRoot, "generated-yield-overlay.json");

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-yield-overlay-regenerate", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({ command: "node", args: [serverPath], cwd: serverRoot });
await client.connect(transport);
try {
  const result = await client.callTool({
    name: "generate_digisaka_image",
    arguments: {
      prompt: "STRICT isolated UI overlay asset. The entire background from edge to edge must be one perfectly flat solid #ff00ff color for chroma key removal. No rice field, no landscape, no photo background, no gradient, no texture, no shadows outside the card. Center one premium glassmorphism agriculture forecast card only: rounded rectangle, translucent moss green glass, subtle border, small chart grid, white vertical bar chart with six bars. Exact readable text only: Yield Forecast and High. No logos, no watermark, no extra words. Keep generous #ff00ff padding around the card. Do not use #ff00ff anywhere inside the card.",
      filenameSlug: "hero-card-yield-forecast-nano-banana-isolated",
      aspectRatio: "4:3",
      outputTarget: "theme"
    }
  }, undefined, { timeout: 240000 });
  const parsed = parseToolJson(result);
  await fs.writeFile(outPath, JSON.stringify(parsed, null, 2));
  console.log(JSON.stringify(parsed, null, 2));
} finally {
  await client.close();
}
