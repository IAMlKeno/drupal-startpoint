# PolicyLink Nexus — Project Brief

**Date:** 2026-09-27  
**Orchestrator:** Claude Haiku 4.5

## Project Goals

PolicyLink Nexus connects community voices with policymaking through dialogue, research, and policy analysis.

### Primary Site Goals
- Community engagement: surveys, perspectives, community voices
- Policy research & insights hub: publish analysis, briefs, evidence-based recommendations
- Service sales funnel: direct clients to research, consulting, policy analysis services

### Primary Audiences
- Immigrants and those seeking to better understand policies
- Residents / community members
- Policymakers / government
- Partner organizations (NGOs, consulting clients)

**Traffic Expectations:** Light (< 1K monthly users initially, gradual growth)  
**Timeline:** Flexible / no hard deadline

## Technical Stack

| Requirement | Decision |
|---|---|
| Drupal Version | 11.2+ (latest stable) |
| PHP | 8.3+ |
| Hosting | Undecided / flexible (explore during build) |
| Environments | Two: stage + prod (dev local via DDEV) |
| Database | MariaDB 11.8 (Drupal 11 standard; PostgreSQL not in core) |
| Cloud Infrastructure | Google Cloud (suggested) |
| Payment | Stripe (for service transactions) |
| Git Host | GitHub |
| Branching | Simple (main + feature branches) |
| Constraints | None / standard Drupal 11 best practices |

## Content & Editorial

| Requirement | Decision |
|---|---|
| Editorial Model | Single editor (user), no approval workflow |
| Languages | English + French |
| Accessibility | WCAG 2.2 AA |
| SEO & Analytics | Google Analytics 4, meta tags/sitemap/schema, email newsletter |

## Design

**Visual Direction (from PDF):**
- Deep navy/blue: trust, government, professionalism
- Inclusive imagery: young and old adults from diverse backgrounds
- Professional + approachable tone

**Reference Themes:** Advocate Zymphonies, YG Law Firm (governance/policy aesthetic)

## Approvals

- Single sign-off: User (Elkeno Jones)
- Project is ready to proceed

## Theme & Design

**Aesthetic:** Modern professional (deep navy/blue, clean, trust-focused)  
**Layout:** Narrow reading column for long-form policy content and research  
**Navigation:** Primary nav (top) + footer mega-menu with resource links  
**Imagery:** Diverse, multi-generational (young & old adults from varied backgrounds)

## Content Types (Launch Critical)

- **Page** — Static content (Home, About, generic sections)
- **Research Post** — Policy analysis, briefs, research papers (with author, date, category)
- **Community Story** — Testimonials, case studies, outcome narratives
- **Policy** — Policy description + threaded comments for registered users

## User Roles & Access

- **Public (Anonymous)** — View published content, browse research
- **Registered Community** — Create accounts, submit voices, comment on policies
- **Editor** — Create/edit/publish content
- **Admin** — Full access (content + users + settings)

## Must-Have Features

### Core
- User registration (email signup + **third-party login: Google & Apple**)
- Comments/discussion on Policy posts (registered users only)
- Email newsletter subscription + signup form
- Stripe payment integration (service sales)
- Full multilingual workflow (EN/FR content translation)

### Future / Optional
- Survey/form embeds (Google Forms)
- Advanced workflow approvals
- Analytics dashboards

## Handoff Notes

- All agents read this brief before proposing
- Theme agent builds mock-ups for user approval
- Content-type and module agents propose in parallel
- User reviews and accepts/rejects/modifies each proposal
- All decisions logged in `decisions/` directory
