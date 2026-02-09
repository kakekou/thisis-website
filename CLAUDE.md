# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Single-page website for ThisIs株式会社 (cleaning company based in Shibuya, Tokyo). The entire site is a single `index.html` file with inline CSS and JavaScript — no build tools, no frameworks, no package manager.

## Architecture

- **Single file**: `index.html` contains all HTML, CSS (`<style>` tag), and JS (`<script>` tag)
- **No build step**: Open the file directly in a browser or serve with any static file server
- **External CDN dependencies**: Google Fonts (Shippori Mincho, Cormorant Garamond, Noto Sans JP), Font Awesome 6.5.1
- **No backend**: Forms are front-end only (submit handlers show toast notifications)

## Design System

- **Color palette**: Dark navy `#0a1628` (primary), Gold `#c8a96e` (accent), Off-white `#f8f6f3` (background)
- **Typography**: Shippori Mincho (JP headings), Cormorant Garamond (EN headings), Noto Sans JP (body)
- **CSS custom properties** are defined in `:root` — modify these for global style changes

## Page Sections (in order)

Navigation → Hero → Concept → (wave divider) → Service/Pricing → (wave divider) → Parallax Quote → About Us (with Google Maps embed) → (wave divider) → Contact Form → Reservation Form → Footer

## Key JS Features

- **Intersection Observer** for scroll-reveal animations (classes: `.reveal`, `.reveal-left`, `.reveal-right`, `.reveal-scale`)
- **Parallax** on elements with `[data-parallax]` attribute
- **Particle system** generated dynamically in `#particles` container
- **Sticky nav** changes background on scroll via `.scrolled` class
- **Mobile menu** toggled via `#hamburger` / `#mobileMenu`

## Responsive Breakpoints

- `768px`: Grid collapse to single column, hamburger menu activates, table reformats
- `480px`: Further typography and table layout adjustments for small screens
