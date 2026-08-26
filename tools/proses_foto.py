#!/usr/bin/env python3
"""Proses foto mentah -> WebP optimasi untuk website.
- Luruskan orientasi (EXIF)
- Resize sisi terpanjang ke 1600px
- Konversi WebP kualitas 80
"""
import os
from PIL import Image, ImageOps

SRC = "/var/folders/78/128cf5892nnf2j63vvhszjf40000gn/T/opencode/foto/Foto Produk"
DST = "/Users/rizky/Documents/Default Project/bikin-baju/assets/img"
MAX = 1600
Q = 80

# pilihan hasil review contact sheet
MAP = {
    # produk
    "14-min.JPG":   ("produk/kemeja.webp",     "Kemeja seragam kerja biru-oranye produksi Bikinbaju"),
    "_DSC1484.JPG": ("produk/polo-shirt.webp", "Polo shirt seragam kerja hijau produksi Bikinbaju"),
    # hero
    "_DSC1503.JPG": ("galeri/jaket-safety.webp", "Jaket safety reflektif produksi Bikinbaju"),
    # galeri
    "2-min.JPG":    ("galeri/galeri-01.webp", "Kemeja seragam kerja two-tone produksi Bikinbaju"),
    "5-min.JPG":    ("galeri/galeri-02.webp", "Kemeja kerja lengan panjang bordir logo perusahaan"),
    "_DSC1408.JPG": ("galeri/galeri-03.webp", "Jaket kerja navy bordir logo dan atribut perusahaan"),
    "IMG_6826.JPG": ("galeri/galeri-04.webp", "Jaket work jacket hijau untuk tim lapangan"),
    "IMG_6831.JPG": ("galeri/galeri-05.webp", "Jaket kerja abu-abu hasil produksi konveksi Bikinbaju"),
    "IMG_6890.JPG": ("galeri/galeri-06.webp", "Jaket institusi navy dengan aksen merah"),
    "_MG_6363.JPG": ("galeri/galeri-07.webp", "Jaket parasut olive untuk seragam tim"),
    "_MG_6401.JPG": ("galeri/galeri-08.webp", "Jaket varsity custom sablon belakang"),
    "_MG_6409.JPG": ("galeri/galeri-09.webp", "Jaket kerja hitam bordir logo perusahaan"),
    "_MG_6424.JPG": ("galeri/galeri-10.webp", "Jaket kerja navy dengan bordir logo dada"),
    "IMG_6802.JPG": ("galeri/galeri-11.webp", "Kemeja seragam kerja wanita navy berhijab"),
    "IMG_6808.JPG": ("galeri/galeri-12.webp", "Detail bordir logo di dada seragam kerja"),
}

total_before = total_after = 0
for src, (rel, _alt) in MAP.items():
    path = os.path.join(SRC, src)
    im = Image.open(path)
    im = ImageOps.exif_transpose(im).convert("RGB")
    before = os.path.getsize(path)
    im.thumbnail((MAX, MAX), Image.LANCZOS)
    out = os.path.join(DST, rel)
    os.makedirs(os.path.dirname(out), exist_ok=True)
    im.save(out, "WEBP", quality=Q, method=6)
    after = os.path.getsize(out)
    total_before += before
    total_after += after
    print(f"OK {rel:34s} {im.width}x{im.height}  {before//1024}KB -> {after//1024}KB")

print(f"\nTotal: {total_before//1024//1024}MB -> {total_after//1024//1024}MB ({100-total_after*100//total_before}% lebih kecil)")
