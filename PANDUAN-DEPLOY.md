# Panduan Deploy — Website Baru Bikin-Baju.com

Panduan ini untuk pemula. Ikuti berurutan. Yang butuh bantuan, tanyakan saja.

## Ringkasan yang Sudah Dibangun

```
bikin-baju/
├── index.html              → Beranda
├── produk/…/               → 6 halaman produk (SEO lengkap)
├── galeri/                 → Galeri produksi + lightbox
├── blog/                   → Daftar & artikel (auto-generate)
├── kontak/                 → Kontak + peta Google Maps
├── admin/                  → CMS untuk menulis artikel (Decap CMS)
├── content/posts/          → Sumber artikel blog (markdown)
├── unduhan/                → (kosong) taruh PDF katalog di sini
├── assets/                 → CSS, JS, gambar
├── tools/                  → Script build (Python)
├── sitemap.xml, robots.txt, llms.txt, _headers, 404.html
```

## LANGKAH 1 — Buat Repository GitHub

1. Login ke github.com → klik **+** (kanan atas) → **New repository**
2. Nama: `bikin-baju` · Public · **jangan** centang README
3. Klik **Create repository**

Lalu beri tahu saya username GitHub-mu — saya yang push seluruh kode ini ke repo tersebut (atau ikuti perintah yang muncul di halaman repo).

## LANGKAH 2 — Buat GitHub OAuth App (untuk login CMS)

1. Buka https://github.com/settings/developers → **OAuth Apps** → **New OAuth App**
2. Isi:
   - Application name: `Bikinbaju CMS`
   - Homepage URL: `https://bikin-baju.com`
   - Authorization callback URL: `https://bikin-baju.com/`
3. Klik **Register application**
4. Salin **Client ID** yang muncul (bukan client secret — PKCE tidak butuh secret)

Kirim Client ID itu ke saya → saya pasang ke `admin/config.yml`.

## LANGKAH 3 — Deploy ke Cloudflare Pages

1. Login https://dash.cloudflare.com → menu **Workers & Pages** → **Create** → **Pages** → **Connect to Git**
2. Pilih repo `bikin-baju` → **Begin setup**
3. Isi pengaturan build:
   - Framework preset: **None**
   - Build command: `python3 tools/build_blog.py`
   - Build output directory: `/`
4. Klik **Save and Deploy** — 2 menit kemudian situs online di `namaproject.pages.dev`

## LANGKAH 4 — Sambungkan Domain bikin-baju.com

1. Di project Pages → tab **Custom domains** → **Set up a custom domain** → masukkan `bikin-baju.com`
2. Ikuti instruksi: pindahkan nameserver domainmu ke Cloudflare (kalau domain dibeli lewat registrar lain, Cloudflare menampilkan 2 alamat nameserver yang harus diisi di panel registrar lama)
3. Tunggu DNS aktif (bisa 5 menit – 24 jam) → HTTPS otomatis aktif

## LANGKAH 5 — Uji CMS

1. Buka `https://bikin-baju.com/admin`
2. Klik **Login with GitHub** → izinkan aplikasi
3. Coba tulis 1 artikel percobaan → **Publish** → cek `bikin-baju.com/blog` 1–2 menit kemudian

## Yang Masih Menunggu Darimu

- [ ] Foto dari Google Drive (download ZIP → beri tahu saya path foldernya)
- [ ] 6 file PDF katalog → taruh di folder `unduhan/` dengan nama:
  `katalog-desain.pdf`, `katalog-produk.pdf`, `price-list.pdf`, `company-profile.pdf`, `katalog-warna-kain.pdf`, `template-desain.pdf`
- [ ] Konfirmasi klaim "waktu produksi 2–3 minggu" (dipakai di FAQ)
- [ ] 2–3 testimoni asli klien (nama, jabatan, isi singkat) → akan saya tambahkan
- [ ] Logo klien dalam bentuk gambar (PNG) jika ingin tampil sebagai logo, bukan teks

## Catatan Teknis (untuk referensi)

- Edit halaman produk: ubah `tools/products.json` → jalankan `python3 tools/build_products.py`
- Build blog manual: `python3 tools/build_blog.py`
- Preview lokal: `python3 -m http.server 8000` di folder `bikin-baju/` → buka http://localhost:8000
- Setiap artikel baru dari CMS otomatis memicu build ulang di Cloudflare Pages
