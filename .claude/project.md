# PolicyLink Nexus - Drupal 11 CMS Project

## Project Overview
PolicyLink Nexus is a Drupal 11-based public consultation portal with a custom theme implementation. The site showcases policy information gathered from community voices.

## Current Status
- **Branch:** main (merged from policynexus feature branch)
- **Theme:** policynexus_theme (custom Drupal 11 theme based on Starterkit)
- **Latest Work:** Header implementation, page hero section, CSS design system

## Key Features Completed

### 1. Page Hero Section (Full-Width)
- Custom `node--page.html.twig` template
- Hero extends edge-to-edge with `width: 100vw`
- Fields: eyebrow, header_text, featured_image, body, cta
- Located at: `web/themes/custom/policynexus_theme/templates/node--page.html.twig`

### 2. Header Component (Separate Template)
- Logo: P icon + "PolicyLink Nexus" / "CONSULTANCY" branding
- Navigation: Primary menu (currently showing "faq" item)
- Layout: Horizontal flexbox (logo left, nav right)
- Located at: `web/themes/custom/policynexus_theme/templates/header.html.twig`

### 3. Design System (CSS)
- **Colors:** Navy (#10243c), Gold (#c8a24a), Light BG (#f4f2ed)
- **Typography:** 
  - Serif: Libre Baskerville (headings)
  - Sans: Source Sans 3 (body)
  - Mono: IBM Plex Mono (labels)
- **Breakpoints:** 320px, 768px, 1024px
- Located at: `web/themes/custom/policynexus_theme/css/global.css`

### 4. Configuration Exports
- Field definitions for all content types
- Block placements
- System performance settings (CSS/JS preprocessing disabled)
- Located at: `web/sites/default/files/sync/`

## Content Types
1. **Page** - Custom hero section with CTA
2. **Research Post** - With publication date, author, featured image
3. **Policy** - With effective date, official source
4. **Community Story** - With storyteller info, outcome
5. **FAQ** - With category, related policies
6. **Team Member** - With contact info, social links

## Project Files Structure
```
web/themes/custom/policynexus_theme/
├── templates/
│   ├── html.html.twig (custom page structure)
│   ├── page.html.twig (includes header.html.twig)
│   ├── header.html.twig (NEW - logo + nav)
│   ├── node--page.html.twig (hero section)
│   ├── node--research-post.html.twig
│   ├── node--policy.html.twig
│   └── ...other node templates
├── css/
│   ├── global.css (design system colors, typography, spacing)
│   ├── layouts.css (container widths, grid layouts)
│   └── components/
│       ├── header.css (logo, nav styling)
│       ├── page.css (hero section)
│       ├── button.css
│       ├── card.css
│       └── ...other components
└── policynexus_theme.libraries.yml (CSS/JS dependencies)
```

## Recent Commits (Merged to Main)
1. `9438a795` - Update header CSS for horizontal logo and navigation layout
2. `1f66c954` - Fix header template include path using theme namespace
3. `7aa0adff` - Create separate header template with PolicyLink Nexus branding
4. `3719d7ea` - CSS styling fixes and Drupal configuration exports
5. `fd4ea670` - Log Decision 009: Page hero layout restructure

## Known Issues / In Progress
- **Menu items:** Need to add through Drupal admin at `/admin/structure/menu/manage/main`
  - Home
  - Community Voices
  - Get Involved
  - Community
  - SHARE YOUR VOICE (CTA button)

- **CSS Styling:** All design system CSS is in place, colors and typography ready
- **Header Display:** Template includes working, layout CSS updated for horizontal display

## Development Environment
- **DDEV:** Docker-based local Drupal environment
- **Theme Base:** Drupal core Starterkit with custom overrides
- **Dependencies:** Installed via Composer (drupal/recommended-project)

## Next Steps
1. Add menu items via Drupal admin interface
2. Create/import content for different content types
3. Test responsive design across breakpoints
4. Add SHARE YOUR VOICE CTA button styling
5. Deploy to staging/production when ready

## Commands
```bash
# Clear Drupal cache
ddev drush cr

# Rebuild theme CSS
ddev drush theme:compile

# Export config
ddev drush config:export

# Check status
ddev drush status
```

## Theme Conventions (per CLAUDE.md)
- Drupal 11, PHP 8.3+
- Core Starterkit + Single Directory Components
- Config as YAML in `web/sites/default/files/sync/`
- All work via `ddev` containerization
- No secrets/DB dumps in repo

## Contact & Context
- User: Elkeno Jones (elkenojones@gmail.com)
- Git remote: local DDEV environment
- Status: Ready for content creation and menu configuration
