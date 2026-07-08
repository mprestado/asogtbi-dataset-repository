---
version: alpha
name: "ASOG TBI Dark Navy & Gold"
description: "ASOG TBI presents a dark-navy-dominant hero with a warm off-white body, anchored by a gold accent system and a sky-blue CTA. The design pairs DM Serif Display for editorial headings with DM Sans for all UI and body text, creating a credible institutional tone. The hero uses a deep navy gradient background with subtle circuit-board imagery, while content sections shift to a warm off-white (#f8f6f2) surface. Gold (#f8af21) is used consistently as a brand accent for labels, decorative rules, and highlights. The layout is structured with a centered max-width container, clear typographic hierarchy, and minimal use of shadows or elevation."
colors:
  gold-dark: "#d69a2a"
  off-white: "#f8f6f2"
  sky-blue: "#43a7db"
  white: "#ffffff"
  deep-dark: "#020d18"
  gold: "#f8af21"
  navy: "#03558c"
  dark-navy-mid: "#0f3f62"
  warm-border: "#e5e2dc"
typography:
  hero-heading:
    fontFamily: "DM Serif Display"
    fontSize: "35.84px"
    fontWeight: "400"
    lineHeight: "42.29px"
  section-heading:
    fontFamily: "DM Serif Display"
    fontSize: "33.6px"
    fontWeight: "400"
    lineHeight: "37.63px"
  subheading-serif:
    fontFamily: "DM Serif Display"
    fontSize: "16.8px"
    fontWeight: "400"
    lineHeight: "23.1px"
  body:
    fontFamily: "DM Sans"
    fontSize: "16px"
    fontWeight: "400"
    lineHeight: "24px"
  category-label:
    fontFamily: "DM Sans"
    fontSize: "9.92px"
    fontWeight: "700"
    lineHeight: "14.88px"
    letterSpacing: "1.984px"
  nav-link:
    fontFamily: "DM Sans"
    fontSize: "10.88px"
    fontWeight: "500"
    lineHeight: "16.32px"
    letterSpacing: "0.9792px"
  small-label:
    fontFamily: "DM Sans"
    fontSize: "9.28px"
    fontWeight: "600"
    lineHeight: "13.92px"
    letterSpacing: "1.856px"
  body-light:
    fontFamily: "DM Sans"
    fontSize: "12.8px"
    fontWeight: "300"
    lineHeight: "21.76px"
  dropdown-item:
    fontFamily: "DM Sans"
    fontSize: "9.92px"
    fontWeight: "400"
    lineHeight: "14.88px"
    letterSpacing: "0.992px"
rounded:
  sm: "4px"
  md: "8px"
  lg: "16px"
  pill: "999px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "12px"
  base: "16px"
  lg: "20px"
  xl: "28px"
  2xl: "40px"
  3xl: "48px"
  4xl: "56px"
  5xl: "96px"
---

## Overview

ASOG TBI presents a dark-navy-dominant hero with a warm off-white body, anchored by a gold accent system and a sky-blue CTA. The design pairs DM Serif Display for editorial headings with DM Sans for all UI and body text, creating a credible institutional tone. The hero uses a deep navy gradient background with subtle circuit-board imagery, while content sections shift to a warm off-white (#f8f6f2) surface. Gold (#f8af21) is used consistently as a brand accent for labels, decorative rules, and highlights. The layout is structured with a centered max-width container, clear typographic hierarchy, and minimal use of shadows or elevation.

**Signature traits:**
- Dual typeface system: Pairs DM Serif Display and DM Sans across the type hierarchy.
- Soft, rounded geometry: Generous corner rounding up to 999px.
- Layered elevation: Depth comes from 2 validated shadow tokens.

## Colors

The palette uses 9 validated color tokens across 1 theme profile. Semantic roles stay attached to observed usage so generation agents can choose accents without inventing new color meaning.

**Semantic naming:**
- **surface-background** maps to `off-white`: Role "background" is grounded by usage context "Primary page and section background, hero text, heading text on dark surfaces".
- **surface-text** maps to `navy`: Role "text" is grounded by usage context "Primary brand color, footer background, dark surface fills, nav elements".
- **content-text** maps to `gold`: Role "text" is grounded by usage context "Brand accent for labels, decorative horizontal rules, carousel indicators, star icons, highlights".
- **action-background** maps to `sky-blue`: Role "background" is grounded by usage context "Primary CTA button 'Be an Incubatee', interactive link highlights".

### Text Scale
- **Deep Dark** (#020d18): Darkest text, hero overlay background base, deep navy gradient stops. Role: text. {authored: rgb(2, 13, 24), space: rgb, alpha: 0.4}
- **Gold** (#f8af21): Brand accent for labels, decorative horizontal rules, carousel indicators, star icons, highlights. Role: text. {authored: rgb(248, 175, 33), space: rgb, alpha: 0.32}
- **Navy** (#03558c): Primary brand color, footer background, dark surface fills, nav elements. Role: text. {authored: rgb(3, 85, 140), space: rgb}

### Interactive
- **Dark Navy Mid** (#0f3f62): Subtle borders, dividers, secondary surface tones in dark sections. Role: border. {authored: rgb(15, 63, 98), space: rgb, alpha: 0.18}
- **Warm Border** (#e5e2dc): Subtle borders and dividers on off-white surfaces. Role: border. {authored: rgb(229, 226, 220), space: rgb}

### Surface & Shadows
- **Gold Dark** (#d69a2a): Hover state or darker variant of gold accent. Role: background. {authored: rgb(214, 154, 42), space: rgb}
- **Off White** (#f8f6f2): Primary page and section background, hero text, heading text on dark surfaces. Role: background. {authored: rgb(248, 246, 242), space: rgb}
- **Sky Blue** (#43a7db): Primary CTA button 'Be an Incubatee', interactive link highlights. Role: background. {authored: rgb(67, 167, 219), space: rgb}
- **White** (#ffffff): Card surfaces, modal backgrounds, icon fills on dark backgrounds. Role: background. {authored: rgb(255, 255, 255), space: rgb, alpha: 0.1}

## Typography

Typography uses DM Serif Display, DM Sans across extracted hierarchy roles. Keep hierarchy mapped to these token rows before adding decorative type styles.

Mixes DM Serif Display and DM Sans for visual contrast. Weight range spans regular, bold, medium, semi-bold, light. Sizes range from 9.28px to 35.84px.

### Font Roles
- **Headline Font**: DM Serif Display
- **Body Font**: DM Serif Display

### Type Scale Evidence
| Role | Font | Size | Weight | Line Height | Letter Spacing | Stack / Features | Notes |
|------|------|------|--------|-------------|----------------|------------------|-------|
| Primary hero and section headings | DM Serif Display | 35.84px | 400 | 42.29px | normal | DM Serif Display, serif | Extracted token |
| Secondary section headings and article titles | DM Serif Display | 33.6px | 400 | 37.63px | normal | DM Serif Display, serif | Extracted token |
| Card headings and smaller editorial titles | DM Serif Display | 16.8px | 400 | 23.1px | normal | DM Serif Display, serif | Extracted token |
| Primary body text, nav items, dropdown content | DM Sans | 16px | 400 | 24px | normal | DM Sans, sans-serif | Extracted token |
| Uppercase category labels, section identifiers like 'FEATURED STORY' | DM Sans | 9.92px | 700 | 14.88px | 1.984px | DM Sans, sans-serif | Extracted token |
| Navigation link items | DM Sans | 10.88px | 500 | 16.32px | 0.9792px | DM Sans, sans-serif | Extracted token |
| Small uppercase labels and tags | DM Sans | 9.28px | 600 | 13.92px | 1.856px | DM Sans, sans-serif | Extracted token |
| Secondary body text, captions, supporting copy | DM Sans | 12.8px | 300 | 21.76px | normal | DM Sans, sans-serif | Extracted token |
| Dropdown menu items | DM Sans | 9.92px | 400 | 14.88px | 0.992px | DM Sans, sans-serif | Extracted token |

## Layout

Responsive system uses 3 breakpoint tier(s): mobile, tablet, desktop.

This system uses a 4px base grid with scale values 2, 4, 6, 8, 10, 12, 16, 20, 24, 28, 40, 48, 56, 80, 96.

### Responsive Strategy
- **mobile (<= 640px)**: Constrain layout for small viewports and prioritize vertical stacking.
- **tablet (>= 640px)**: Increase spacing and column structure for medium-width viewports.
- **desktop (>= 1024px)**: Expand layout density and horizontal composition for wide viewports.

### Spacing System
| Token | Value | Px | Notes |
|------|-------|----|-------|
| xs | 4px | 4 | Extracted spacing token |
| sm | 8px | 8 | Extracted spacing token |
| md | 12px | 12 | Extracted spacing token |
| base | 16px | 16 | Extracted spacing token |
| lg | 20px | 20 | Extracted spacing token |
| xl | 28px | 28 | Extracted spacing token |
| 2xl | 40px | 40 | Extracted spacing token |
| 3xl | 48px | 48 | Extracted spacing token |
| 4xl | 56px | 56 | Extracted spacing token |
| 5xl | 96px | 96 | Extracted spacing token |

## Elevation & Depth

Keep depth flat unless validated shadow or interaction evidence appears in the extraction payload. Do not invent shadows beyond this evidence boundary.

### Shadow Evidence
| Shadow Token | Layers | Details |
|--------------|--------|---------|
| ring-white | 1 | 0px 0px 0px 0.75px rgba(255, 255, 255, 0.2) |
| card-lift | 1 | 0px 26px 40px -30px rgba(12, 36, 58, 0.45) |

### Interaction Signals
| Theme | Signal | Evidence |
|-------|--------|----------|
| Light | backdrop-filter | blur(16px) |
| Light | outline-color | rgb(248, 246, 242) ; rgba(255, 255, 255, 0.72) ; rgb(248, 175, 33) |
| Light | outline-width | 3px |
| Light | outline-offset | 0px |
| Light | transform | matrix(1, 0, 0, 1, 0, 22) ; matrix(1, 0, 0, 1, 0, 20) ; matrix(1, 0, 0, 1, 0, 0) |

## Shapes

Shape language maps directly to rounded tokens. Keep component corners consistent with the role mapping below before introducing bespoke geometry.

### Radius Roles
| Token | Value | Px | Role Mapping |
|------|-------|----|--------------|
| sm | 4px | 4 | Subtle corner |
| md | 8px | 8 | Control corner |
| lg | 16px | 16 | Card corner |
| pill | 999px | 999 | Large surface corner |

### Geometry Evidence
| Radius Token | Shape | Units |
|--------------|-------|-------|
| sm | 4px | px |
| md | 8px | px |
| lg | 16px | px |
| pill | 999px | px |

## Components

(none detected)

## Do's and Don'ts

Guardrails protect Dual typeface system, Soft, rounded geometry, Layered elevation without adding unsupported visual claims.

| Do | Don't |
|----|---------|
| Do maintain consistent spacing using the base grid | Don't make unsupported claims about absent visual features |
| Do maintain WCAG AA contrast ratios (4.5:1 for normal text) | Don't mix rounded and sharp corners in the same view |
| Do use the primary color only for the single most important action per screen |  |
| Do verify evidence before writing new design-system guidance |  |

## Responsive Evidence

### Breakpoints
| Name | Width | Key Changes |
|------|-------|-------------|
| Mobile | <= 639px | (max-width: 639px) |
| Mobile | <= 640px | (max-width: 640px) |
| Mobile | >= 640px | (min-width: 640px) |
| Tablet | >= 768px | (min-width: 768px) |
| Desktop | >= 1024px | (min-width: 1024px) |
| Breakpoint 6 | Unknown | (max-width: 63.99rem) |

## Agent Prompt Guide

### Example Component Prompts
- Create button component using validated primary color role and spacing tokens.
- Create card component with mapped radius role and evidence-backed elevation.
- Create form input component using inferred typography hierarchy and border roles.

### Iteration Guide
1. Start with extracted palette and typography roles only.
2. Map spacing and radius directly from token tables before visual polish.
3. Apply component patterns one section at a time and compare against source intent.
4. Keep elevation claims tied to explicit evidence in output.
5. Iterate with smallest diffs and re-check section hierarchy after each change.
