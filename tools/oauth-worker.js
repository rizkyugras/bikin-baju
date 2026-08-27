// OAuth proxy untuk Decap CMS (backend GitHub) di Cloudflare Workers
// Cara pakai:
// 1. Buat Worker di dashboard Cloudflare, tempel seluruh kode ini
// 2. Settings -> Variables and Secrets:
//    - CLIENT_ID     (text)   = Client ID OAuth app GitHub
//    - CLIENT_SECRET (secret) = Client Secret OAuth app GitHub
// 3. Di GitHub OAuth app, tambahkan callback URL: https://<nama-worker>.<subdomain>.workers.dev/callback
// 4. Di admin/config.yml website, isi backend.base_url dengan https://<nama-worker>.<subdomain>.workers.dev

export default {
  async fetch(request, env) {
    const url = new URL(request.url);
    const clientId = env.CLIENT_ID;
    const clientSecret = env.CLIENT_SECRET;
    const redirectUri = url.origin + "/callback";

    if (!clientId || !clientSecret) {
      return new Response("CLIENT_ID / CLIENT_SECRET belum diisi di settings Worker.", { status: 500 });
    }

    // 1) Mulai login: arahkan ke GitHub
    if (url.pathname === "/auth") {
      const params = new URLSearchParams({
        client_id: clientId,
        redirect_uri: redirectUri,
        scope: "repo",
        state: crypto.randomUUID(),
      });
      return Response.redirect("https://github.com/login/oauth/authorize?" + params.toString(), 302);
    }

    // 2) GitHub kembalikan kode -> tukar dengan access token -> kirim ke CMS
    if (url.pathname === "/callback") {
      const code = url.searchParams.get("code");
      if (!code) {
        return new Response("Kode otorisasi tidak ditemukan.", { status: 400 });
      }
      const tokenRes = await fetch("https://github.com/login/oauth/access_token", {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({
          client_id: clientId,
          client_secret: clientSecret,
          code: code,
          redirect_uri: redirectUri,
        }),
      });
      const data = await tokenRes.json();
      if (!data.access_token) {
        return new Response("Gagal mendapat token: " + (data.error_description || "tidak diketahui"), { status: 400 });
      }
      const html = `<!DOCTYPE html><html><body><script>
        window.opener.postMessage({ token: ${JSON.stringify(data.access_token)}, provider: "github" }, "*");
        window.close();
      <\/script>Masuk berhasil. Silakan tutup tab ini jika tidak tertutup otomatis.</body></html>`;
      return new Response(html, { headers: { "Content-Type": "text/html; charset=utf-8" } });
    }

    return new Response("OAuth proxy Bikinbaju CMS aktif.", { status: 200 });
  },
};
