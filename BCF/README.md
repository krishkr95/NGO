# Bhopal Cares Forum (BCF) — Official Web Platform

> **Target Delivery:** Responsive Static Web App (Semantic HTML5, Modular CSS3, Vanilla ES6+ JS)  
> **Audience:** Bhopal college students, grassroots volunteers, local environmentalists, and CSR partners.  
> **Aesthetic Philosophy:** Bespoke, anti-AI visual aesthetic featuring dark forest greens, paper textures, responsive bento cards, and editorial typography.

---

## 🌿 Project Overview

Bhopal Cares Forum (BCF) is a civic and environmental volunteer movement founded in 2019. This platform replaces fragmented Instagram bio links and Google Forms with a unified, high-performance web experience featuring:

1. **Live Impact Bento Grid:** Animated counters (`IntersectionObserver`) with verifiable impact numbers (4,260+ kg waste cleaned, 2,356+ native trees planted, 4,495 seed balls dispersed, 1,100+ articles donated).
2. **Four Action Pillars:** Detailed breakdowns for **Clean** (Lake Aqua), **Plant** (Deep Foliage Green), **Care** (Seed Amber), and **Upharam** (Warm Coral) with interactive accordions.
3. **Instagram Story Reel:** Highlight bubbles (`BCF-BTS`, `MVP`, `Upharam`, `Appreciation`) with full-screen timed slide viewer.
4. **Filterable Photo Wall:** Masonry grid with category tabs and keyboard-accessible fullscreen lightbox.
5. **Interactive Drive Schedule & Map:** Next drive countdown timer, assembly point landmarks, GPS coordinates, and Google Maps routing.
6. **3-Step Volunteer Intake Engine:** Indian phone validation (`/^[6-9]\d{9}$/`), locality selector, activity choice cards, t-shirt sizing, and instant WhatsApp community onboarding.
7. **CSR & Community Sponsorship:** Proof of execution, downloadable audit reports, and direct UPI channel (`bhopalcares@upi`).

---

## 📁 Directory Structure

```text
BCF/
├── index.html                 # Semantic single-page application entry
├── README.md                  # Project overview & deployment notes
├── assets/
│   ├── css/
│   │   ├── reset.css          # Modern box-sizing & margin reset
│   │   ├── variables.css      # Design tokens, color system, font stacks
│   │   ├── components.css     # Buttons, cards, modals, form inputs, stories
│   │   └── style.css          # Main responsive layout and page sections
│   ├── js/
│   │   ├── app.js             # Navigation toggle, countdown timer, map selector, modals
│   │   ├── counters.js        # IntersectionObserver number animations with easing
│   │   ├── gallery.js         # Tab filtering, lightbox, and Instagram story reel
│   │   └── volunteer-form.js  # 3-step intake validation & WhatsApp community handler
│   └── images/
│       ├── brand/             # SVG logo, favicon, open-graph banners
│       └── drives/            # Documentary photographs of cleanups, saplings, and drives
```

---

## 🚀 Running Locally

Because this project is built on **pure HTML5, CSS3, and ES6+**, it requires zero build steps, npm installs, or node dependencies.

### Option 1: Python Simple Server
```bash
python -m http.server 8000
```
Then visit `http://localhost:8000` in your browser.

### Option 2: Node.js (npx serve or http-server)
```bash
npx -y serve .
```

### Option 3: VS Code Live Server / Direct Double Click
Open [index.html](file:///d:/New%20folder/Website/New%20folder/BCF/index.html) directly in any modern browser.

---

## 🔍 Quality & Standards

- **Zero External JS/CSS Frameworks:** No React, Vue, jQuery, Tailwind, or Bootstrap bloat.
- **Accessibility:** WCAG 2.1 AA compliant, semantic markup (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`), keyboard trap management, and contrast-checked typography.
- **Performance:** Lightweight SVG brand assets and optimized imagery.
- **SEO & Social Cards:** Comprehensive OpenGraph & Twitter Card metadata ready for WhatsApp, Instagram, and LinkedIn link unfurls.
