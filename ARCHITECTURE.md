# Industrial Compressor Platform - Architecture Plan

## 1. Complete Folder Architecture
We will follow a **Modular Domain-Driven Design (DDD)** approach to ensure enterprise-grade scalability.

```text
app/
├── Core/               # Shared infrastructure (Base classes, Traits, Helpers)
├── Domains/            # Business Logic grouped by Domain
│   ├── Product/
│   │   ├── Actions/    # Single responsibility logic (e.g., CreateProduct)
│   │   ├── Models/     # Eloquent models
│   │   ├── Services/   # Complex domain logic
│   │   ├── DTOs/       # Data Transfer Objects
│   │   └── Repositories/
│   ├── RFQ/            # Request for Quote Logic
│   ├── AI/             # OpenAI Integration Logic
│   ├── CMS/            # Content Management Logic
│   └── Analytics/      # Tracking Logic
├── Http/
│   ├── Controllers/
│   │   ├── Admin/      # Dashboard controllers
│   │   ├── Api/        # REST API controllers (v1)
│   │   └── Web/        # Public facing controllers
│   ├── Middleware/
│   └── Resources/      # API Transformers
├── View/
│   ├── Components/     # Blade components
│   └── ViewModels/     # Data preparation for complex views
resources/
├── js/
│   ├── app.js          # Main entry
│   ├── modules/
│   │   ├── animations.js # GSAP logic
│   │   ├── viewer3d.js   # Three.js logic
│   │   └── chatbot.js    # Alpine.js chat logic
├── css/
│   └── app.css         # Tailwind directives + custom industrial styles
└── views/
    ├── admin/          # Admin blade templates
    ├── components/     # Reusable UI components
    ├── layouts/        # App layouts (Main, Admin, Auth)
    └── web/            # Frontend pages
```

## 2. Recommended Laravel Architecture
- **Laravel 12 + PHP 8.3**: Leveraging Property Hooks, Readonly classes, and typed constants.
- **Action Pattern**: Instead of bloated controllers or services, we use `Action` classes (e.g., `SubmitRFQAction`).
- **Repository Pattern**: To decouple domain logic from Eloquent (optional but recommended for enterprise).
- **Service Layer**: For third-party integrations (OpenAI, Analytics).
- **View Models**: To keep controllers slim; specific classes to prepare data for Blade templates.

## 3. Database Planning
### Core Entities:
- **`users`**: Roles (Admin, Sales, Customer).
- **`products`**: Basic info, SKU, base price (hidden), status.
- **`categories`**: Nested hierarchy (Screw, Piston, Portable, etc.).
- **`product_attributes`**: Dynamic specs (Pressure, Flow rate, Power).
- **`product_comparisons`**: Pivot for user-saved comparisons.
- **`rfqs`**: Main request, status (Pending, Quoted, Closed).
- **`rfq_items`**: Products linked to an RFQ.
- **`ai_chat_logs`**: History for OpenAI context training and analytics.
- **`pages` & `posts`**: CMS content for SEO.
- **`analytics_hits`**: Internal event tracking.

## 4. Modules Breakdown
1.  **Product Engine**: Catalog, filtering, dynamic specifications.
2.  **Comparison Engine**: Side-by-side technical data comparison logic.
3.  **RFQ System**: Multi-step quote request form with document attachment support.
4.  **AI Intelligence**: RAG (Retrieval-Augmented Generation) system using product docs to answer technical queries via OpenAI.
5.  **Industrial CMS**: SEO-ready blog and dynamic page builder.
6.  **Analytics Hub**: Real-time dashboard for lead conversion and product popularity.

## 5. Route Structure
- **Web (Public)**: `/`, `/products/{slug}`, `/compare`, `/rfq`, `/about`, `/blog`.
- **Admin (Protected)**: `/admin/dashboard`, `/admin/products`, `/admin/rfqs`, `/admin/settings`.
- **API (v1)**: `/api/v1/products`, `/api/v1/chat`, `/api/v1/analytics/track`.

## 6. Middleware Strategy
- **`Authenticate`**: standard Laravel auth.
- **`RoleMiddleware`**: For `admin` and `sales` access levels.
- **`Localization`**: For international enterprise clients.
- **`SecurityHeaders`**: Custom middleware to inject CSP, X-Frame-Options.
- **`Sitemap`**: Automatic sitemap generator for SEO.

## 7. Security Strategy
- **Role-Based Access Control (RBAC)**: Using Spatie Laravel Permission.
- **Sanctum**: For secure API token management.
- **Rate Limiting**: Specifically for the RFQ form and AI Chatbot to prevent abuse.
- **Input Sanitization**: Strict validation using FormRequests.
- **Audit Logging**: Tracking every change in the Admin panel.

## 8. API Architecture
- **RESTful Design**: JSON:API compliant responses.
- **API Versioning**: URL-based (`/v1/`).
- **OpenAPI/Swagger**: Documentation generated via `l5-swagger`.
- **Transformers**: Laravel API Resources for clean output.

## 9. Admin Architecture
- **Dashboard UI**: Custom industrial-themed dashboard (Dark Mode preferred).
- **Livewire/Alpine Integration**: For real-time updates in the RFQ management list.
- **Chart.js**: For the Analytics module visualizations.
- **File Management**: Spatie Media Library for product technical PDFs and images.

## 10. Frontend Architecture (Premium Industrial UX)
- **Styling**: Tailwind CSS with custom `industrial` color palette (Grays, Deep Blues, Warning Oranges).
- **Micro-interactions**: **GSAP** for parallax, scroll-triggered reveals, and smooth transitions.
- **3D Visualization**: **Three.js** to render 3D models of compressors on product detail pages (interactable).
- **Reactivity**: **Alpine.js** for the Chatbot UI and Comparison tool logic.
- **SEO**: Meta tags, JSON-LD schema (Product, Organization), and SSR-friendly Blade templates.
