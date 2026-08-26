#!/usr/bin/env python3
"""Generate placeholder SVG untuk produk, galeri, dan og-image.
File asli nanti diganti foto WebP dari Google Drive."""
import os

BASE = os.path.join(os.path.dirname(__file__), "..", "assets", "img")

TEAL_50 = "#eff7f9"
TEAL_100 = "#dceef3"
TEAL_600 = "#0f5e74"
TEAL_700 = "#0b4a5c"
TEAL_800 = "#08404f"
TEAL_900 = "#06333f"
YELLOW = "#ffd200"

SHIRT = "M70 40 L85 32 Q100 44 115 32 L130 40 L155 60 L140 80 L133 72 L133 165 L67 165 L67 72 L60 80 L45 60 Z"
POLO = "M70 40 L85 32 L100 48 L115 32 L130 40 L155 60 L140 80 L133 72 L133 165 L67 165 L67 72 L60 80 L45 60 Z"
VEST = "M70 38 L86 32 L100 60 L114 32 L130 38 L142 62 L132 78 L132 165 L68 165 L68 78 L58 62 Z"
PANTS = "M74 38 L126 38 L136 165 L108 165 L100 100 L92 165 L64 165 Z"
COVERALL = "M70 38 L130 38 L152 62 L136 80 L130 72 L130 108 L137 165 L110 165 L102 112 L98 112 L90 165 L63 165 L70 108 L70 72 L64 80 L48 62 Z"

PRODUCTS = {
    "kemeja": ("Kemeja Seragam", SHIRT),
    "kaos-t-shirt": ("Kaos T-Shirt", SHIRT),
    "polo-shirt": ("Polo Shirt", POLO),
    "rompi": ("Rompi Kerja", VEST),
    "celana": ("Celana Kerja", PANTS),
    "wearpack": ("Wearpack", COVERALL),
}


def product_svg(label, path):
    return f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="800" height="600" role="img" aria-label="{label}">
  <rect width="200" height="200" fill="{TEAL_50}"/>
  <rect x="8" y="8" width="184" height="184" fill="none" stroke="{TEAL_600}" stroke-width="1.5" stroke-dasharray="6 5" opacity=".45" rx="12"/>
  <g transform="translate(0,-6)">
    <path d="{path}" fill="{TEAL_600}" opacity=".92"/>
    <path d="{path}" fill="none" stroke="{TEAL_900}" stroke-width="2" stroke-dasharray="5 4"/>
  </g>
  <rect x="40" y="168" width="120" height="20" rx="10" fill="{YELLOW}"/>
  <text x="100" y="182" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="11" font-weight="bold" fill="{TEAL_900}">{label.upper()}</text>
</svg>'''


def gallery_svg(n):
    return f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="600" height="600" role="img" aria-label="Foto produksi {n}">
  <rect width="200" height="200" fill="{TEAL_100}"/>
  <rect x="8" y="8" width="184" height="184" fill="none" stroke="{TEAL_700}" stroke-width="1.5" stroke-dasharray="6 5" opacity=".4" rx="12"/>
  <g transform="translate(100,88)" opacity=".85">
    <rect x="-26" y="-14" width="52" height="36" rx="6" fill="{TEAL_700}"/>
    <rect x="-10" y="-20" width="20" height="8" rx="3" fill="{TEAL_700}"/>
    <circle cx="0" cy="4" r="10" fill="{TEAL_50}"/>
    <circle cx="0" cy="4" r="5" fill="{TEAL_600}"/>
  </g>
  <rect x="55" y="140" width="90" height="18" rx="9" fill="{TEAL_700}"/>
  <text x="100" y="153" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="10" font-weight="bold" fill="#ffffff">FOTO PRODUKSI {n:02d}</text>
</svg>'''


OG = f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 630" width="1200" height="630" role="img" aria-label="Bikin-Baju.com Konveksi Seragam Kerja">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{TEAL_900}"/>
      <stop offset="1" stop-color="{TEAL_700}"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="630" fill="url(#bg)"/>
  <line x1="0" y1="614" x2="1200" y2="614" stroke="{YELLOW}" stroke-width="4" stroke-dasharray="18 12" opacity=".7"/>
  <line x1="0" y1="16" x2="1200" y2="16" stroke="#ffffff" stroke-width="2" stroke-dasharray="14 10" opacity=".25"/>
  <rect x="70" y="120" width="150" height="150" rx="34" fill="{TEAL_800}" stroke="{YELLOW}" stroke-width="5"/>
  <text x="145" y="205" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="64" font-weight="bold" fill="#ffffff">bb</text>
  <rect x="240" y="128" width="330" height="56" rx="28" fill="{YELLOW}"/>
  <text x="405" y="165" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="28" font-weight="bold" fill="{TEAL_900}">BIKIN-BAJU.COM</text>
  <text x="72" y="360" font-family="Arial, Helvetica, sans-serif" font-size="62" font-weight="bold" fill="#ffffff">Konveksi Seragam Kerja</text>
  <text x="72" y="435" font-family="Arial, Helvetica, sans-serif" font-size="62" font-weight="bold" fill="{YELLOW}">&amp; Seragam Kantor</text>
  <text x="74" y="495" font-family="Arial, Helvetica, sans-serif" font-size="28" fill="#dceef3">Sejak 2017 · 1.300+ klien · 928.000+ pcs diproduksi · MOQ 12 pcs</text>
  <text x="74" y="545" font-family="Arial, Helvetica, sans-serif" font-size="24" fill="#9fc4cf">Karanganyar, Jawa Tengah — kirim ke seluruh Indonesia &amp; luar negeri</text>
</svg>'''


def main():
    prod_dir = os.path.join(BASE, "produk")
    gal_dir = os.path.join(BASE, "galeri")
    os.makedirs(prod_dir, exist_ok=True)
    os.makedirs(gal_dir, exist_ok=True)
    for slug, (label, path) in PRODUCTS.items():
        with open(os.path.join(prod_dir, f"{slug}.svg"), "w") as f:
            f.write(product_svg(label, path))
    for i in range(1, 9):
        with open(os.path.join(gal_dir, f"{i:02d}.svg"), "w") as f:
            f.write(gallery_svg(i))
    with open(os.path.join(BASE, "og-image.svg"), "w") as f:
        f.write(OG)
    print("Placeholder SVG dibuat.")


if __name__ == "__main__":
    main()
