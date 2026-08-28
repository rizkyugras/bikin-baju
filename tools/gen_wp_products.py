#!/usr/bin/env python3
"""Generate inc/product-data.php untuk theme WordPress dari tools/products.json"""
import json
import os

BASE = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DATA = os.path.join(BASE, "tools", "products.json")
OUT = os.path.join(BASE, "wp-theme", "bikinbaju", "inc", "product-data.json")

with open(DATA, encoding="utf-8") as f:
    data = json.load(f)

def php_str(s):
    return json.dumps(s, ensure_ascii=False)

products = []
for p in data["products"]:
    products.append({
        "slug": p["slug"],
        "name": p["name"],
        "h1": p["h1"],
        "price": p["price_label"],
        "tagline": p["tagline"],
        "intro": p["intro"],
        "intro2": p["intro2"],
        "image": "/assets/img/produk/" + (p.get("image", "/assets/img/produk/" + p["slug"] + ".svg").split("/")[-1]),
        "fabrics": p["fabrics"],
        "specs": p["specs"],
        "uses": p["uses"],
        "faqs": p["faqs"],
        "wa": p["wa_text"],
    })

with open(OUT, "w", encoding="utf-8") as f:
    json.dump(products, f, ensure_ascii=False, indent=2)
print("OK", os.path.relpath(OUT, BASE))