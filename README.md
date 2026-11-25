# Clearhaven Bio Response — Laravel 13 + Filament 3 Website, ERP & AI

Production-ready SME platform for a Central Ohio **biohazard cleanup** company: public marketing site, Filament admin ERP, knowledge base, and AI assistants for chat, content, automation ideas, and troubleshooting. Brand: **Clearhaven Bio Response**.

## Features
- 🏠 Premium public site (hero, services, about, dashboard preview, contact)
- 🧪 Service detail pages for trauma, bloodborne pathogens, infectious disinfection, hoarding biohazards, vehicles & medical waste
- 📰 Blog / knowledge content with seeded posts
- 📬 Contact form that stores leads in the database
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🗂️ Filament ERP at `/admin` (customers, jobs, inventory, invoices, payments, appointments)
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats + charts
- ⚙️ Settings page for company phone, WhatsApp, tax rate, and more
- 🤖 Admin AI Studio (blog/descriptions, automation suggestions, troubleshooting)
- 📚 Knowledge base: common issues, guides, admin manual, troubleshooting
- 🌱 Realistic demo seeders for a full walkthrough

## Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js
- Tailwind-friendly public CSS (custom Clearhaven theme)
- MySQL or SQLite
- Spatie Laravel Permission
- OpenAI API with Gemini fallback keys (demo FAQ mode when keys are empty)

## Installation
```bash
git clone https://github.com/imranbru99/biohazard-cleanup.git
cd biohazard-cleanup
composer install
cp .env.example .env
php artisan key:generate
# SQLite demo (default): ensure database/database.sqlite exists
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Admin: `http://localhost:8000/admin` — `admin@example.com` / `password`

Optional AI keys in `.env`: `OPENAI_API_KEY` or `GEMINI_API_KEY`.

## Screenshots / Visual Dashboard
![Professional disinfection supplies](https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=1400&q=80)
![Cleanup team at work](https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1400&q=80)
![PPE and medical gloves](https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1400&q=80)
![Sanitizer and infection control](https://images.unsplash.com/photo-1631549916768-4119b2e5f926?auto=format&fit=crop&w=1400&q=80)

## Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and update this section with the public URL.

## SEO-optimized repo description
```
Clearhaven Bio Response — Laravel 13 + Filament 3 website, ERP & AI for Central Ohio biohazard cleanup (trauma, bloodborne pathogens, invoices, chatbot).
```

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
