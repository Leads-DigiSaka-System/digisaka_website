# Digisaka Nano Banana Images MCP Server

This MCP server generates and edits images for the Digisaka WordPress website using Google Gemini Nano Banana image models.

## Location

`C:\wamp64\www\digisaka_website\mcp\nano-banana-images`

Generated images are saved by default to:

`C:\wamp64\www\digisaka_website\wp-content\uploads\digisaka-generated`

That maps to:

`http://localhost/digisaka_website/wp-content/uploads/digisaka-generated/...`

## API key

Set your Google AI Studio / Gemini API key here:

`C:\wamp64\www\digisaka_website\mcp\nano-banana-images\.env`

Edit this line:

```env
GEMINI_API_KEY=your_real_api_key_here
```

You can get a key from:

https://aistudio.google.com/apikey

The `mcp` folder contains an `.htaccess` deny rule so the `.env` file and server code are not publicly accessible through Apache.

## Install

PowerShell on this machine blocks the `npm.ps1` shim, so use `npm.cmd`:

```powershell
cd C:\wamp64\www\digisaka_website\mcp\nano-banana-images
npm.cmd install
```

## Run manually

```powershell
cd C:\wamp64\www\digisaka_website\mcp\nano-banana-images
npm.cmd start
```

## MCP client config

Use `mcp-client.example.json` as the reference. The important command is:

```json
{
  "mcpServers": {
    "digisaka-nano-banana-images": {
      "command": "node",
      "args": [
        "C:\\wamp64\\www\\digisaka_website\\mcp\\nano-banana-images\\src\\server.mjs"
      ]
    }
  }
}
```

Because the server loads `.env` from its own folder, you can keep the API key out of the MCP client config.

## Tools

- `generate_digisaka_image`: creates a new website image and saves it to WordPress uploads or theme assets.
- `edit_digisaka_image`: edits an existing image inside `digisaka_website` and saves a new file.
- `list_digisaka_generated_images`: lists recent generated images.

## Models

Default model:

`gemini-3.1-flash-image`

Other Nano Banana options you can set in `.env` with `NANO_BANANA_MODEL`:

- `gemini-3.1-flash-lite-image`
- `gemini-3.1-flash-image`
- `gemini-3-pro-image`
- `gemini-2.5-flash-image`