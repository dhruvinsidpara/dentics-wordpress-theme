"""Take full-page screenshots of the local site (desktop, tablet, mobile).

Usage: python3 screenshot.py   (site must be running on http://127.0.0.1:9400)
"""
from playwright.sync_api import sync_playwright

URL = "http://127.0.0.1:9400/"
SIZES = [("desktop", 1512, 900), ("tablet", 820, 1180), ("mobile", 390, 844)]
HIDE_ADMIN_BAR = "#wpadminbar{display:none!important} html{margin-top:0!important}"

with sync_playwright() as p:
    browser = p.chromium.launch()
    for name, w, h in SIZES:
        page = browser.new_page(viewport={"width": w, "height": h})
        page.goto(URL, wait_until="networkidle", timeout=90000)
        page.add_style_tag(content=HIDE_ADMIN_BAR)
        # Scroll through the page so lazy-loaded images load.
        height = page.evaluate("document.documentElement.scrollHeight")
        for y in range(0, height, h // 2):
            page.evaluate(f"window.scrollTo(0, {y})")
            page.wait_for_timeout(120)
        page.evaluate("window.scrollTo(0, 0)")
        page.wait_for_timeout(800)
        page.screenshot(path=f"screenshots/{name}-full.png", full_page=True)
        overflow = page.evaluate("document.documentElement.scrollWidth > window.innerWidth")
        print(name, page.evaluate("document.documentElement.scrollHeight"), "px tall, horizontal overflow:", overflow)
    browser.close()
