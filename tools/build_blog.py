#!/usr/bin/env python3
"""Build blog: content/posts/*.md -> blog/<slug>/index.html + blog/index.html
Juga memperbarui bagian blog di sitemap.xml.
Jalankan: python3 tools/build_blog.py"""
import html
import os
import re
from datetime import date

BASE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
POSTS_DIR = os.path.join(BASE, "content", "posts")
BLOG_DIR = os.path.join(BASE, "blog")
SITEMAP = os.path.join(BASE, "sitemap.xml")

WA_SVG = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>'

HEADER = '''<header class="site-header">
    <div class="container header-inner">
      <a class="brand" href="/" aria-label="Bikin-Baju.com - Beranda">
        <img src="/assets/img/logo.png" alt="Logo Bikinbaju" width="44" height="44">
        <span>Bikinbaju<small>Konveksi Seragam</small></span>
      </a>
      <nav class="main-nav" aria-label="Navigasi utama">
        <ul>
          <li><a href="/">Beranda</a></li>
          <li><a href="/#produk">Produk</a></li>
          <li><a href="/#katalog">Katalog</a></li>
          <li><a href="/galeri/">Galeri</a></li>
          <li><a href="/blog/"{current}>Blog</a></li>
          <li><a href="/kontak/">Kontak</a></li>
        </ul>
      </nav>
      <div class="header-cta">
        <a class="btn btn-wa" href="https://wa.me/6281211671157?text=Halo%20Bikinbaju%2C%20saya%20mau%20tanya%20harga%20seragam.%20Bisa%20dibantu%3F" rel="noopener" target="_blank">{wa_svg}<span>Tanya Harga</span></a>
        <button class="nav-toggle" aria-label="Buka menu navigasi" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>'''

FOOTER = '''<footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <img src="/assets/img/logo.png" alt="Logo Bikinbaju" width="52" height="52">
          <p class="brand-name">Bikin-Baju.com<small>Konveksi Seragam Kerja</small></p>
          <p>Produsen seragam kerja &amp; seragam kantor sejak 2017. 1.300+ klien, 928.000+ pcs diproduksi, kirim ke seluruh Indonesia dan luar negeri.</p>
        </div>
        <div>
          <h3>Produk</h3>
          <ul class="footer-list">
            <li><a href="/produk/kemeja/">Kemeja Seragam</a></li>
            <li><a href="/produk/kaos-t-shirt/">Kaos T-Shirt</a></li>
            <li><a href="/produk/polo-shirt/">Polo Shirt</a></li>
            <li><a href="/produk/rompi/">Rompi Kerja</a></li>
            <li><a href="/produk/celana/">Celana Kerja</a></li>
            <li><a href="/produk/wearpack/">Wearpack</a></li>
          </ul>
        </div>
        <div>
          <h3>Hubungi Kami</h3>
          <ul class="footer-list footer-contact">
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 22a10 10 0 110-20 10 10 0 010 20zm1-10.41V6h-2v6.41l5.29 3.04 1-1.73L13 11.59z"/></svg>
              <span>Senin–Sabtu 08.00–17.00 WIB<br>Minggu tutup</span>
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              <a href="https://wa.me/6281211671157" rel="noopener" target="_blank">WhatsApp 0812-1167-1157</a>
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
              <a href="https://www.instagram.com/official.bikinbaju" rel="noopener" target="_blank">Instagram @official.bikinbaju</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© <span data-year>2026</span> Bikin-Baju.com</p>
        <div class="footer-social">
          <a href="https://www.instagram.com/official.bikinbaju" aria-label="Instagram Bikinbaju" rel="noopener" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
          <a href="https://www.tiktok.com/@bikinbajucom" aria-label="TikTok Bikinbaju" rel="noopener" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>
          <a href="https://www.youtube.com/@bikinbajucom" aria-label="YouTube Bikinbaju" rel="noopener" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          <a href="https://www.linkedin.com/company/bikinbaju/" aria-label="LinkedIn Bikinbaju" rel="noopener" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
        </div>
      </div>
    </div>
  </footer>

  <script src="/assets/js/main.js" defer></script>
</body>
</html>'''

MONTHS_ID = {
    1: "Januari", 2: "Februari", 3: "Maret", 4: "April", 5: "Mei", 6: "Juni",
    7: "Juli", 8: "Agustus", 9: "September", 10: "Oktober", 11: "November", 12: "Desember",
}


def fmt_date(iso):
    d = date.fromisoformat(iso)
    return f"{d.day} {MONTHS_ID[d.month]} {d.year}"


def parse_front_matter(text):
    meta = {}
    body = text
    m = re.match(r"^---\s*\n(.*?)\n---\s*\n", text, re.DOTALL)
    if m:
        for line in m.group(1).splitlines():
            if ":" in line:
                key, _, val = line.partition(":")
                meta[key.strip()] = val.strip().strip('"')
        body = text[m.end():]
    return meta, body


def inline(md):
    s = html.escape(md, quote=False)
    s = re.sub(r"!\[([^\]]*)\]\(([^)]+)\)", r'<img src="\2" alt="\1" loading="lazy">', s)
    s = re.sub(r"\[([^\]]+)\]\(([^)]+)\)", r'<a href="\2">\1</a>', s)
    s = re.sub(r"\*\*([^*]+)\*\*", r"<strong>\1</strong>", s)
    s = re.sub(r"(?<!\*)\*([^*]+)\*(?!\*)", r"<em>\1</em>", s)
    s = re.sub(r"`([^`]+)`", r"<code>\1</code>", s)
    return s


def markdown_to_html(md):
    out = []
    lines = md.splitlines()
    i = 0
    while i < len(lines):
        line = lines[i]
        stripped = line.strip()
        if not stripped:
            i += 1
            continue
        if stripped.startswith("### "):
            out.append(f"<h3>{inline(stripped[4:])}</h3>")
        elif stripped.startswith("## "):
            out.append(f"<h2>{inline(stripped[3:])}</h2>")
        elif stripped.startswith("# "):
            out.append(f"<h2>{inline(stripped[2:])}</h2>")
        elif stripped == "---":
            out.append("<hr>")
        elif stripped.startswith("> "):
            quote = [inline(stripped[2:])]
            i += 1
            while i < len(lines) and lines[i].strip().startswith("> "):
                quote.append(inline(lines[i].strip()[2:]))
                i += 1
            out.append("<blockquote>" + " ".join(quote) + "</blockquote>")
            continue
        elif re.match(r"^[-*]\s+", stripped):
            items = []
            while i < len(lines) and re.match(r"^[-*]\s+", lines[i].strip()):
                content_li = re.sub("^[-*]\\s+", "", lines[i].strip())
                items.append("<li>" + inline(content_li) + "</li>")
                i += 1
            out.append("<ul>" + "".join(items) + "</ul>")
            continue
        elif re.match(r"^\d+\.\s+", stripped):
            items = []
            while i < len(lines) and re.match(r"^\d+\.\s+", lines[i].strip()):
                content_li = re.sub("^\\d+\\.\\s+", "", lines[i].strip())
                items.append("<li>" + inline(content_li) + "</li>")
                i += 1
            out.append("<ol>" + "".join(items) + "</ol>")
            continue
        else:
            para = [inline(stripped)]
            i += 1
            while i < len(lines) and lines[i].strip() and not re.match(r"^(#|>|-|\*|\d+\.\s|---)", lines[i].strip()):
                para.append(inline(lines[i].strip()))
                i += 1
            out.append("<p>" + " ".join(para) + "</p>")
            continue
        i += 1
    return "\n".join(out)


def load_posts():
    posts = []
    for fn in sorted(os.listdir(POSTS_DIR)):
        if not fn.endswith(".md"):
            continue
        slug = fn[:-3]
        with open(os.path.join(POSTS_DIR, fn), encoding="utf-8") as f:
            meta, body = parse_front_matter(f.read())
        posts.append({
            "slug": slug,
            "title": meta.get("title", slug.replace("-", " ").title()),
            "date": meta.get("date", "2026-01-01"),
            "description": meta.get("description", ""),
            "html": markdown_to_html(body),
        })
    posts.sort(key=lambda p: p["date"], reverse=True)
    return posts


def render_post(p):
    url = f"https://bikin-baju.com/blog/{p['slug']}/"
    header = HEADER.format(wa_svg=WA_SVG, current=' aria-current="page"')
    schema = {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": p["title"],
        "description": p["description"],
        "datePublished": p["date"],
        "inLanguage": "id",
        "author": {"@id": "https://bikin-baju.com/#bisnis"},
        "publisher": {"@id": "https://bikin-baju.com/#bisnis"},
        "mainEntityOfPage": url,
        "image": "https://bikin-baju.com/assets/img/og-image.jpg",
    }
    import json
    return f'''<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{html.escape(p['title'])} | Blog Bikin-Baju.com</title>
  <meta name="description" content="{html.escape(p['description'])}">
  <link rel="canonical" href="{url}">
  <meta name="robots" content="index, follow">
  <meta property="og:type" content="article">
  <meta property="og:site_name" content="Bikin-Baju.com">
  <meta property="og:title" content="{html.escape(p['title'])}">
  <meta property="og:description" content="{html.escape(p['description'])}">
  <meta property="og:url" content="{url}">
  <meta property="og:image" content="https://bikin-baju.com/assets/img/og-image.jpg">
  <meta property="article:published_time" content="{p['date']}">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
  <script type="application/ld+json">{json.dumps(schema, ensure_ascii=False)}</script>
</head>
<body>

  {header}

  <main>
    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="/">Beranda</a><span aria-hidden="true">/</span><a href="/blog/">Blog</a><span aria-hidden="true">/</span>Artikel
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <article class="article">
          <header class="article-header">
            <time datetime="{p['date']}">{fmt_date(p['date'])}</time>
            <h1>{html.escape(p['title'])}</h1>
            <p class="lead">{html.escape(p['description'])}</p>
          </header>
          <div class="article-body">
{p['html']}
          </div>
          <footer class="article-footer">
            <a href="/blog/">← Semua artikel</a>
            <a class="btn btn-wa" href="https://wa.me/6281211671157?text=Halo%20Bikinbaju%2C%20saya%20mau%20tanya%20harga%20seragam.%20Bisa%20dibantu%3F" rel="noopener" target="_blank">{WA_SVG} Tanya Harga</a>
          </footer>
        </article>
      </div>
    </section>
  </main>

  {FOOTER}'''


def render_listing(posts):
    header = HEADER.format(wa_svg=WA_SVG, current=' aria-current="page"')
    cards = "\n".join(
        f'''          <article class="post-card">
            <div class="body">
              <time datetime="{p['date']}">{fmt_date(p['date'])}</time>
              <h3><a href="/blog/{p['slug']}/">{html.escape(p['title'])}</a></h3>
              <p>{html.escape(p['description'])}</p>
              <a class="card-link" href="/blog/{p['slug']}/">Baca artikel →</a>
            </div>
          </article>''' for p in posts
    )
    return f'''<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Konveksi &amp; Seragam Kerja | Bikin-Baju.com</title>
  <meta name="description" content="Artikel seputar seragam kerja: tips memilih bahan, panduan pemesanan, tren seragam kantor, dan info konveksi dari Bikinbaju.">
  <link rel="canonical" href="https://bikin-baju.com/blog/">
  <meta name="robots" content="index, follow">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Bikin-Baju.com">
  <meta property="og:title" content="Blog Konveksi &amp; Seragam Kerja | Bikin-Baju.com">
  <meta property="og:description" content="Tips memilih bahan, panduan pemesanan, dan info seragam kerja.">
  <meta property="og:url" content="https://bikin-baju.com/blog/">
  <meta property="og:image" content="https://bikin-baju.com/assets/img/og-image.jpg">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

  {header}

  <main>

    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="/">Beranda</a><span aria-hidden="true">/</span>Blog
        </nav>
        <h1>Blog Konveksi Bikinbaju</h1>
        <p class="page-sub">Tips memilih bahan, panduan pemesanan seragam, dan informasi dunia konveksi — langsung dari pengalaman memproduksi 928.000+ pcs pakaian.</p>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="post-list">
{cards}
        </div>
      </div>
    </section>

    <section class="cta-band">
      <div class="container">
        <h2>Butuh Seragam untuk Perusahaan Anda?</h2>
        <p>Konsultasi gratis, desain gratis, sampel kain gratis. Mulai dari 12 pcs saja.</p>
        <div class="hero-actions">
          <a class="btn btn-wa" href="https://wa.me/6281211671157?text=Halo%20Bikinbaju%2C%20saya%20mau%20tanya%20harga%20seragam.%20Bisa%20dibantu%3F" rel="noopener" target="_blank">Tanya Harga Sekarang</a>
        </div>
      </div>
    </section>

  </main>

  {FOOTER}'''


def update_sitemap(posts):
    if not os.path.exists(SITEMAP):
        return
    with open(SITEMAP, encoding="utf-8") as f:
        content = f.read()
    entries = "\n".join(
        f'''  <url><loc>https://bikin-baju.com/blog/{p['slug']}/</loc><lastmod>{p['date']}</lastmod></url>'''
        for p in posts
    )
    block = f"<!-- BLOG:START -->\n{entries}\n  <!-- BLOG:END -->"
    if "<!-- BLOG:START -->" in content:
        content = re.sub(
            r"<!-- BLOG:START -->.*?<!-- BLOG:END -->", block, content, flags=re.DOTALL
        )
    else:
        content = content.replace("</urlset>", block + "\n</urlset>")
    with open(SITEMAP, "w", encoding="utf-8") as f:
        f.write(content)


def main():
    posts = load_posts()
    os.makedirs(BLOG_DIR, exist_ok=True)
    for p in posts:
        out_dir = os.path.join(BLOG_DIR, p["slug"])
        os.makedirs(out_dir, exist_ok=True)
        with open(os.path.join(out_dir, "index.html"), "w", encoding="utf-8") as f:
            f.write(render_post(p))
        print("OK", f"blog/{p['slug']}/index.html")
    with open(os.path.join(BLOG_DIR, "index.html"), "w", encoding="utf-8") as f:
        f.write(render_listing(posts))
    print("OK blog/index.html")
    update_sitemap(posts)
    print("OK sitemap.xml (bagian blog diperbarui)")


if __name__ == "__main__":
    main()
