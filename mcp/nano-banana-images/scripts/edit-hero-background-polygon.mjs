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
const outPath = path.join(serverRoot, "generated-hero-background-polygon.json");

function parseToolJson(result) {
  const text = result?.content?.find((item) => item.type === "text")?.text;
  if (!text) throw new Error("Tool returned no text JSON payload.");
  return JSON.parse(text);
}

const client = new Client({ name: "digisaka-hero-background-polygon-edit", version: "1.0.0" }, { capabilities: {} });
const transport = new StdioClientTransport({ command: "node", args: [serverPath], cwd: serverRoot });
await client.connect(transport);
try {
  const result = await client.callTool({
    name: "edit_digisaka_image",
    arguments: {
      sourceImagePath: "wp-content/themes/digisaka-theme/assets/images/generated-homepage-hero-reference.png",
      filenameSlug: "homepage-hero-background-baked-polygon-dikes",
      outputTarget: "theme",
      prompt: "Edit this exact website hero background. Preserve the same Philippine rice field, mountains, lighting, and the bright clean left-side negative space for headline text. Add the farm plotting effect directly into the rice field, not as a floating overlay: in the middle-right and lower-right field/dike area only, trace the existing farm dikes with thin white GIS polygon boundary lines, tiny white node dots, and a very subtle yellow-green translucent gradient glow along the dike edges. The lines must follow the perspective of the field rows and look integrated into the farmland. Do not add a big separate polygon object, no rectangular grid sheet, no orange overlay, no cards, no text, no logos, no watermark, no UI labels. Keep it realistic and premium, like the reference hero where polygon sides sit naturally on farm dikes."
    }
  }, undefined, { timeout: 240000 });
  const parsed = parseToolJson(result);
  await fs.writeFile(outPath, JSON.stringify(parsed, null, 2));
  console.log(JSON.stringify(parsed, null, 2));
} finally {
  await client.close();
}
