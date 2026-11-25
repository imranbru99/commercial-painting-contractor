# Ironspan Commercial Coatings — Laravel 13 + Filament 3 ERP

Production-ready website, ERP, and AI toolkit for a US commercial & industrial painting contractor (Houston, TX). Public marketing site, Filament admin for jobs/inventory/invoices, FAQ-trained chatbot, and knowledge base.

## ✨ Features
- 🏗️ Public marketing site with hero, services, about, ERP preview, and contact form
- 🎨 Service detail pages for warehouse, plant, facade, steel, epoxy prep, and occupied facilities
- 📰 Blog / insights with seeded commercial coating articles
- 📚 Knowledge base: common issues, guides, admin manual, troubleshooting
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🗂️ Filament ERP (`/admin`) with roles: Admin, Manager, Staff
- 👥 Users, customers, jobs/projects, coating inventory, invoices, payments, scheduling
- 📊 Dashboard widgets: stats, revenue chart, jobs-by-status chart
- ⚙️ Company settings page
- 🤖 AI Studio: blog drafts, descriptions, automation suggestions, troubleshooting
- 🌱 Realistic demo seeders for Gulf Coast industrial clients

## 🛠️ Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js
- Tailwind-friendly public CSS (custom industrial theme)
- SQLite (demo) / MySQL (production)
- OpenAI + Gemini HTTP fallbacks (optional keys)

## 🚀 Installation
```bash
composer install
copy .env.example .env   # Windows: copy .env.example .env
php artisan key:generate
# ensure database/database.sqlite exists for SQLite demo
php artisan migrate --seed
php artisan serve
```

Admin panel: `http://localhost:8000/admin`  
Public site: `http://localhost:8000`

**Default admin:** `admin@example.com` / `password`

Optional AI keys in `.env`:
```
OPENAI_API_KEY=
GEMINI_API_KEY=
```

## 📸 Screenshots / Visual Dashboard
![Warehouse coating operations](https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80)

![Industrial plant exterior](https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=1200&q=80)

![High-rise facade commercial tower](https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80)

![Structural steel coating work](https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and update this section with the live URL.

## 🔍 SEO-Optimized Repo Description
`Ironspan Commercial Coatings — Laravel 13 + Filament 3 website & ERP for US commercial/industrial painting contractors with AI chatbot, job tracking, inventory, and invoicing.`

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
