# AGENTS.md — Catatan Perubahan Proyek E-Commerce

## Informasi Proyek
- **Nama:** SegarBuah — E-Commerce Sayuran & Buah
- **Lokasi:** `laravel_app-ecomm`
- **Stack:** Laravel + Tailwind CSS v4 + Vite
- **CSS Framework:** Tailwind CSS (Bootstrap tidak digunakan)

---

## Fitur & Roadmap

### Fase 1 — Produk & Katalog ✅ (Selesai)
| Step | Status | Deskripsi |
|------|--------|-----------|
| Step 1 | ✅ Selesai | Install Laravel Breeze (auth) |
| Step 2 | ✅ Selesai | Rebrand layout SegarBuah tema hijau |
| Step 3 | ✅ Selesai | Update database — field khusus sayur/buah |
| Step 4 | ✅ Selesai | Update Model + Seeder (data sayur & buah asli) |
| Step 5 | ✅ Selesai | Halaman Shop/Katalog + filter + search |
| Step 6 | ✅ Selesai | Halaman Detail Produk |
| Step 7 | ✅ Selesai | Migrate fresh + seed + verifikasi |

### Fase 2 — Transaksi (Sedang Dikerjakan)
| Fitur | Detail |
|-------|--------|
| Keranjang Belanja | ✅ Add to cart, update qty, hitung otomatis |
| Checkout | ✅ Alamat pengiriman, catatan pembeli |
| Pembayaran | ✅ Transfer Bank, COD, QRIS (manual confirmation) |
| Manajemen Pesanan (Admin) | ✅ CRUD status pesanan, invoice |

### Fase 3 — Penyempurnaan
| Fitur | Detail |
|-------|--------|
| Notifikasi | ✅ Email / WhatsApp konfirmasi (database notification) |
| Review & Rating | ✅ Bintang + komentar per produk |
| Wishlist | ✅ Simpan produk favorit |
| Blog / Artikel | ✅ Tips sayur, resep, musim buah |
| Flash Sale / Promo | ✅ Diskon waktu terbatas |
| Dashboard Admin | ✅ Grafik penjualan, laporan |

---

## 2026-06-15 — Inisialisasi & Setup Awal

### Perubahan yang Dilakukan
- [x] Membuat `AGENTS.md` untuk mencatat seluruh perubahan
- [x] Verifikasi tidak ada dependensi Bootstrap — sudah clean
- [x] Menghapus `resources/views/welcome.blade.php` default Laravel
- [x] Membuat layout utama `resources/views/layouts/app.blade.php`
- [x] Membuat halaman home e-commerce `resources/views/pages/home.blade.php`
- [x] Update `routes/web.php` — route `/` mengarah ke `HomeController`
- [x] Membuat direktori: `layouts/`, `pages/`, `components/` di `resources/views/`
- [x] Setup model `Category` & `Product` dengan migration
- [x] Setup factory & seeder untuk data dummy (8 categories, 50 products)
- [x] Membuat `HomeController` dengan data dinamis (featured products, categories)
- [x] Verifikasi build Vite + Tailwind berhasil
- [x] Verifikasi migrate & seed berhasil di Docker container

### Keputusan Teknis
- **Tailwind CSS v4** dengan `@tailwindcss/vite` plugin (bukan PostCSS)
- Tidak menggunakan Bootstrap atau CSS framework lainnya
- Menggunakan Laravel Breeze / Jetstream opsional untuk auth (disesuaikan nanti)
- Struktur view: `layouts/`, `components/`, `pages/`
- Docker environment dengan Apache + PHP 8.2 + MySQL 8.0
- Build frontend via Vite dari host (npm), di-mount ke container

### Model & Database
- **Category:** id, name, slug (unique), description, image, is_active
- **Product:** id, category_id (FK), name, slug (unique), description, price, compare_price, stock, sku (unique), **unit** (kg/gram/ikat/buah/pack), **weight_in_grams**, **origin**, **is_organic**, **is_seasonal**, **storage_info**, **min_order**, image, images (JSON), is_active, is_featured

### Catatan
- Project menggunakan Tailwind CSS v4 (bukan v3) — konfigurasi via CSS, bukan `tailwind.config.js`
- Vite sebagai build tool, bukan Laravel Mix
- Semua artisan command dijalankan via `docker exec laravel_app-ecomm php artisan ...`
- Build frontend dijalankan dari host Windows (Node.js v22.20.0)

---

## 2026-06-15 — Fase 1: Step 1 - Laravel Breeze

### Perubahan
- [x] Install `laravel/breeze` via composer
- [x] Install Breeze Blade/Tailwind stack
- [x] Generate auth views (login, register, forgot-password, dll)
- [x] Generate profile management views
- [x] Generate layout components (navigation, guest layout, dll)
- [x] Run npm install + vite build sukses

---

## 2026-06-15 — Fase 1: Step 2 - Rebrand Layout SegarBuah

### Perubahan
- [x] Update `.env` — `APP_NAME` menjadi "SegarBuah"
- [x] Rewrite `layouts/app.blade.php` — tema hijau (emerald), footer lengkap, dukungan `$title`
- [x] Rewrite `layouts/guest.blade.php` — logo SegarBuah, tema hijau
- [x] Rewrite `layouts/navigation.blade.php` — nav e-commerce (Home, Shop, Categories, cart icon, user dropdown)
- [x] Rewrite `pages/home.blade.php` — konten sayur & buah, green gradient hero, featured products, kategori
- [x] Hapus `welcome.blade.php` (kosong tidak dipakai)
- [x] Update `routes/web.php` — restore `HomeController` untuk `/`, pertahankan route Breeze
- [x] Build Vite sukses

---

## 2026-06-15 — Fase 1: Step 3 - Update Database

### Perubahan
- [x] Migration baru: `add_produce_fields_to_products_table`
- [x] Tambah field: `unit` (kg/gram/ikat/buah/pack), `weight_in_grams`, `origin`, `is_organic`, `is_seasonal`, `storage_info`, `min_order`
- [x] Update `Product` model — tambah fillable + casts untuk field baru
- [x] Migrate sukses

---

## 2026-06-15 — Fase 1: Step 4 - Update Model & Seeder

### Perubahan
- [x] Update `CategoryFactory` — 8 kategori sayur & buah asli (Sayuran Daun, Umbi, Buah Lokal/Impor, dll)
- [x] Update `ProductFactory` — 50 produk sayur & buah asli (Bayam, Wortel, Mangga, Apel, dll) detail: unit, weight, origin, organic, seasonal, storage_info, min_order
- [x] Update seeder — data spesifik sayur & buah Indonesia
- [x] Migrate fresh + seed sukses (8 categories, 50 products)

---

## 2026-06-15 — Fase 1: Step 5 - Halaman Shop/Katalog

### Perubahan
- [x] Buat `ShopController` — index dengan filter, search, sort, pagination
- [x] Buat `pages/shop.blade.php` — grid produk, sidebar kategori, filter organik/musiman
- [x] Update `routes/web.php` — route `/shop` + name
- [x] Update `layouts/navigation.blade.php` — link Shop mengarah ke route
- [x] Update `pages/home.blade.php` — link "Shop Now" dan "View All" mengarah ke shop
- [x] Fix CSS — Tailwind v4 syntax (hapus postcss.config & tailwind.config dari Breeze)
- [x] Update pagination — Tailwind styled
- [x] Build Vite sukses

---

## 2026-06-16 — Perbaikan Tampilan & Desain Ulang

### Perubahan Besar
- [x] **Font** — Ganti dari Figtree ke **Inter** (Google Font)
- [x] **Dark Mode** — Implementasi penuh dark mode dengan toggle di navbar
- [x] **Ikon** — Ganti semua SVG ikon dengan **Phosphor Icons** (free, professional)
- [x] **Gambar Unsplash** — Hero section, kategori, dan produk menggunakan foto real dari Unsplash
- [x] **Animasi** — Scroll reveal animations (fade-in-up), hover effects, transisi halus
- [x] **Footer** — Footer lengkap: logo + deskripsi, sosial media, links, jam operasional, metode pembayaran
- [x] **Promo Section** — 3 promo card (Free Delivery, Weekly Deals, 100% Organic) di atas Home
- [x] **Navigation** — Sticky navbar, dark mode toggle, Phosphor icons, mobile responsive
- [x] **Home Page** — Hero dengan Unsplash background overlay, kategori dengan gambar, featured products dengan gambar
- [x] **Shop Page** — Dark mode, scroll animations, Phosphor icons, responsive grid
- [x] **Guest Layout** — Dark mode support, Phosphor icons
- [x] **Dropdown Components** — Dark mode support
- [x] **Pagination** — Dark mode, Phosphor icons
- [x] **Build Vite** — Sukses (CSS 22KB, JS 92KB)

### Bug Fix
- [x] **Tailwind CSS tidak jalan** — `vite.config.js` kehilangan plugin `@tailwindcss/vite` setelah install Breeze, ditambahkan kembali
- [x] **Alpine.js flash** — Ditambahkan `[x-cloak] { display: none !important; }` di CSS

---

## 2026-06-16 — Fase 1: Step 6 — Optimasi Performa & Detail Produk

### Perubahan
- [x] **Step 6: Halaman Detail Produk** — `resources/views/pages/product-detail.blade.php`
- [x] **Route baru** — `/product/{slug}` → `ShopController@show` (route name: `shop.show`)
- [x] **ShopController** — tambah method `show()`: ambil produk + related products (4 random dari kategori sama)
- [x] **Produk cards** — Semua card produk (home & shop) jadi `<a>` link ke detail produk
- [x] **Gambar produk home** — Link ke detail produk via `route('shop.show', $product->slug)`
- [x] **Gambar produk shop** — Link ke detail produk via `route('shop.show', $product->slug)`

### Optimasi Performa
- [x] **Phosphor Icons** — Hanya load 1 CSS `bold` saja (sebelumnya 3: regular + fill + bold) → hemat ~60KB
- [x] **Font Inter** — Hanya 400,500,600,700 (sebelumnya termasuk 800) → loading lebih cepat
- [x] **Quality gambar** — Semua gambar Unsplash `q=60` (dari `q=80`) → ukuran file ~25% lebih kecil
- [x] **Size gambar** — Gambar produk `w=400`, hero `w=1400` (dari `w=1920`) → resolusi lebih rendah
- [x] **Lazy loading** — Semua `<img>` pakai `loading="lazy"` (dari eager loading) → halaman awal lebih cepat
- [x] **Stagger animasi** — Hanya 4 levels (sebelumnya 8 levels) → aturan CSS lebih sedikit

### Bug Fix
- [x] **Gambar tidak terload** — Ganti Unsplash photo IDs yang mungkin broken dengan 10 ID terverifikasi
- [x] **Guest layout** — Hanya load Phosphor bold CSS (sinkron dengan app layout)
- [x] **Build Vite** — Sukses (CSS ~51KB, JS ~92KB)

### Detail Halaman
| Elemen | Keterangan |
|--------|-----------|
| Breadcrumb | Home > Shop > Nama Produk |
| Gambar | Large 600px, gradient fallback, badges (organic/seasonal/discount) |
| Info | Nama, kategori, origin, price/unit, discount |
| Info Grid | Weight, min order, stock, SKU |
| Storage | Info penyimpanan (blue info box) |
| Description | Deskripsi produk |
| Add to Cart | Quantity selector + button + wishlist button |
| Related | 4 produk dari kategori sama, random |

### Files Changed
- `app/Http/Controllers/ShopController.php` — tambah method `show()`
- `routes/web.php` — tambah route `shop.show`
- `resources/views/pages/product-detail.blade.php` — **new file** (halaman detail produk)
- `resources/views/pages/home.blade.php` — lazy loading, quality ↓, link ke detail, stagger 4 level
- `resources/views/pages/shop.blade.php` — lazy loading, quality ↓, link ke detail, stagger 4 level
- `resources/views/layouts/app.blade.php` — hanya 1 Phosphor CSS, font tanpa weight 800
- `resources/views/layouts/guest.blade.php` — hanya 1 Phosphor CSS (bold)
- `resources/css/app.css` — stagger 4 level (dari 8 level)

---

## 2026-06-16 — Fase 1: Step 7 — Migrate Fresh & Verifikasi

### Perubahan
- [x] **Migrate fresh + seed** — `php artisan migrate:fresh --seed` sukses
- [x] **8 categories** terverifikasi
- [x] **50 products** terverifikasi (slug pertama: `alpukat-mentega`)
- [x] **Route test** — Home (200), Shop (200), Detail (200), Login
- [x] **Build Vite** — Sukses (CSS ~51KB, JS ~92KB)

### Fase 1 Selesai
Semua item Fase 1 (Step 1–7) telah selesai. Siap melanjutkan ke **Fase 2 — Transaksi**.

---

## 2026-06-16 — Penyempurnaan Frontend

### Perbaikan Bug
- [x] **Dark mode** — Ganti Alpine `$dispatch` dengan `onclick` vanilla JS + inline script di `<head>` (sebelum render). Sistem juga detect prefers-color-scheme otomatis
- [x] **Gambar broken** — Ganti semua Unsplash photo ID dengan 4 ID terverifikasi: `1610348725531-843dff563e2c`, `1567306226416-28f0efdc88ce`, `1507003211169-0a1dd7228f2d`, `1553279768-865429fa0078`
- [x] **Gambar fallback** — Semua `<img>` pakai `onerror="this.remove()"` — jika gagal load, gradient background tampil
- [x] **Guest layout** — Tambah dark mode toggle + inline script (sama dengan app layout)

### Fitur Baru
- [x] **Loading Bar** — Progress bar hijau di atas halaman setiap navigasi (CSS animasi, 0.8s)
- [x] **Scroll to Top** — Tombol floating pojok kanan bawah, muncul setelah scroll >300px
- [x] **Cart Preview** — Dropdown cart di navbar (Alpine.js), tampil "Your cart is empty" untuk sekarang
- [x] **Mobile Nav Guest** — Navbar responsif di halaman login/register dengan toggle menu
- [x] **Mobile Filters** — Drawer filter dari bawah untuk halaman Shop di mobile (Alpine.js)
- [x] **Product Quick View** — Modal global untuk lihat produk cepat + qty selector + add to cart link
- [x] **Mobile Nav Desktop** — Navigasi desktop di guest layout (sama dengan app layout)
- [x] **Accessibility** — `aria-label`, `role`, `focus-visible:ring`, `aria-modal`, keyboard escape handlers

### Optimasi Loading
| Item | Sebelum | Sesudah |
|------|---------|---------|
| Unsplash photo IDs | 12 IDs (beberapa invalid) | 4 verified IDs |
| Image quality | `q=60-80` | `q=50` |
| Image size | `w=400-600` | `w=300-500` |
| Font weights | 400,500,600,700,800 | 400,500,600,700 |
| Phosphor CDN | 3 CSS (regular+fill+bold) | 1 CSS (bold) |
| preconnect | fonts.bunny.net | + images.unsplash.com, upload.wikimedia.org |
| Lazy loading | Tidak ada | Semua gambar `loading="lazy"` |
| Onerror fallback | Tidak ada | `onerror="this.remove()"` |
| Stagger levels | 8 | 4 |
| Reduced motion | Tidak ada | `@media (prefers-reduced-motion: reduce)` |

### Files Changed
- `resources/css/app.css` — loading-bar, scroll-top, modal, filter-drawer, skeleton, reduced-motion styles
- `resources/js/app.js` — Alpine data: cartPreview, quickView, mobileFilters; loading bar, scroll top, scroll-reveal observer
- `resources/views/layouts/app.blade.php` — inline dark mode script (head), preconnect Unsplash+Wiki, loading bar, scroll-top btn, global Quick View modal
- `resources/views/layouts/navigation.blade.php` — cart preview dropdown, aria-labels, focus-visible, mobile menu transitions
- `resources/views/layouts/guest.blade.php` — inline dark mode script, mobile nav, dark mode toggle
- `resources/views/pages/home.blade.php` — quick view button on featured products, aria attributes, card structure change
- `resources/views/pages/shop.blade.php` — mobile filter drawer, quick view button, aria attributes, focus-visible

---

## 2026-06-16 — Fase 2: Keranjang Belanja

### Perubahan
- [x] **CartService** — `app/Services/CartService.php`, session-based cart management (add, update, remove, clear, getTotal, getCount, hasItem)
- [x] **CartController** — `app/Http/Controllers/CartController.php`, index, store (AJAX), update, destroy
- [x] **CartComposer** — `app/View/Composers/CartComposer.php`, share `cartItems`, `cartCount`, `cartTotal` ke semua view
- [x] **AppServiceProvider** — Register CartService sebagai singleton + CartComposer global
- [x] **Cart Routes** — GET `/cart`, POST `/cart`, PATCH `/cart/{id}`, DELETE `/cart/{id}`
- [x] **Cart Page** — `resources/views/pages/cart.blade.php`, full cart page dengan list items + order summary + empty state
- [x] **Navigation Cart Preview** — Menampilkan real cart items, total, link ke cart page
- [x] **Add to Cart (Detail)** — Halaman detail produk: qty selector min_order-based, AJAX add to cart, button state (adding/added)
- [x] **Add to Cart (Quick View)** — Modal quick view: AJAX add to cart, toast notification, badge update live
- [x] **Toast Notification** — Floating toast (hijau) muncul setiap kali item ditambahkan ke cart
- [x] **Cart Badge** — Badge jumlah item di navbar terupdate otomatis via JS

### Files Changed
- `app/Services/CartService.php` — **new file** (session-based cart)
- `app/Http/Controllers/CartController.php` — **new file**
- `app/View/Composers/CartComposer.php` — **new file**
- `app/Providers/AppServiceProvider.php` — register singleton View::composer
- `routes/web.php` — 4 routes cart
- `resources/views/pages/cart.blade.php` — **new file** (halaman cart)
- `resources/views/layouts/navigation.blade.php` — real cart preview items + badge
- `resources/views/pages/product-detail.blade.php` — functional add to cart (AJAX)
- `resources/views/layouts/app.blade.php` — quick view add to cart AJAX + toast
- `resources/js/app.js` — addToCartFromQuick, updateCartBadge, showToast functions

---

## 2026-06-16 — Fase 2: Checkout

### Perubahan
- [x] **Migration orders** — `create_orders_table` (user_id, order_number, status, subtotal, shipping_cost, total, alamat, payment)
- [x] **Migration order_items** — `create_order_items_table` (order_id, product_id, product_name, product_price, quantity, subtotal)
- [x] **Order model** — fillable, relasi items() & user()
- [x] **OrderItem model** — fillable, relasi order() & product()
- [x] **CheckoutController** — index (form), store (validasi + simpan), success (konfirmasi)
- [x] **Checkout page** — Form alamat (name, phone, address, city, postal_code), notes, payment method (bank_transfer/cod/qris)
- [x] **Checkout success page** — Ringkasan order, detail item, alamat kirim, instruksi pembayaran per metode
- [x] **Routes** — GET `/checkout`, POST `/checkout`, GET `/checkout/success/{order}`
- [x] **Free shipping** — Otomatis gratis jika total >= Rp 100.000
- [x] **Cart → Checkout** — Link "Proceed to Checkout" di cart page terhubung
- [x] **Migrate fresh** — Semua tabel + seed berhasil

### Files Changed
- `database/migrations/*_create_orders_table.php` — **new file**
- `database/migrations/*_create_order_items_table.php` — **new file**
- `app/Models/Order.php` — **new file**
- `app/Models/OrderItem.php` — **new file**
- `app/Http/Controllers/CheckoutController.php` — **new file**
- `resources/views/pages/checkout.blade.php` — **new file** (form checkout)
- `resources/views/pages/checkout-success.blade.php` — **new file** (halaman sukses)
- `routes/web.php` — 3 routes checkout
- `resources/views/pages/cart.blade.php` — link ke checkout

---

## 2026-06-16 — Fase 3: Notifikasi

### Perubahan
- [x] **OrderStatusNotification** — Database notification, triggered saat admin update status/payment
- [x] **NotificationController** — Index + markAsRead + readAll
- [x] **Notification Bell** — Dropdown di navbar (5 notif terakhir), badge unread count
- [x] **Notifications Page** — `/notifications` dengan list, mark read, link ke order
- [x] **Admin OrderController** — Kirim notifikasi ke user saat status/payment diupdate
- [x] **Routes** — 3 notification routes

---

## 2026-06-16 — Fase 3: Blog

### Perubahan
- [x] **BlogPost Model + Migration** — title, slug, excerpt, content, image, is_published, published_at, user_id
- [x] **Admin/BlogPostController** — CRUD penuh (index, create, store, edit, update, destroy)
- [x] **BlogPostController** — Public index (paginated) + show (with recent posts)
- [x] **Admin views** — blog/index.blade.php (table) + blog/form.blade.php (create/edit)
- [x] **Public views** — blog/index.blade.php (grid cards) + blog/show.blade.php (full article + recent)
- [x] **Navigation** — Navbar "Blog" link, admin "Manage Blog" dropdown
- [x] **Routes** — 2 public + 7 admin (resource)

---

## 2026-06-16 — Fase 3: Wishlist

### Perubahan
- [x] **Wishlist Migration** — Pivot table (user_id, product_id) with unique constraint
- [x] **User Model** — wishlist() belongsToMany relation
- [x] **Product Model** — wishlistedBy() belongsToMany relation
- [x] **WishlistController** — index + toggle (AJAX-ready JSON response)
- [x] **Wishlist Page** — `/wishlist` grid produk + remove button + add to cart
- [x] **Wishlist Button** — Home (featured), Shop (cards), Detail (product detail)
- [x] **Wishlist Badge** — Heart icon di navbar dengan count badge
- [x] **Navigation** — Wishlist link di user dropdown + mobile menu
- [x] **Routes** — 2 wishlist routes (index, toggle)

---

## 2026-06-16 — Fase 2: Pembayaran & Manajemen Pesanan

### Perubahan
- [x] **Migration is_admin** — Kolom `is_admin` (boolean, default false) ke tabel `users`
- [x] **Migration payment_proof** — Kolom `payment_proof` (nullable string) ke tabel `orders`
- [x] **AdminMiddleware** — Middleware baru `admin` (abort 404 jika bukan admin)
- [x] **OrderController (User)** — Index (daftar pesanan), Show (detail + confirm payment), Confirm (ubah payment_status jadi paid)
- [x] **Admin\OrderController** — Index (semua pesanan), Show (detail + form status), UpdateStatus (pending→confirmed→processing→shipped→delivered→cancelled), UpdatePayment (pending→paid→failed→refunded)
- [x] **User views** — `pages/orders/index.blade.php` (list pesanan dengan status badge) + `pages/orders/show.blade.php` (detail + tombol konfirmasi bayar)
- [x] **Admin views** — `admin/orders/index.blade.php` (tabel responsive) + `admin/orders/show.blade.php` (grid layout: items + alamat + form status + form payment + customer info)
- [x] **Navigation** — Dropdown user: "My Orders" link, "Manage Orders" (admin only)
- [x] **Seeder** — Update DatabaseSeeder: user admin (admin@segarbuah.com / password), user biasa (user@segarbuah.com / password)
- [x] **Routes** — 3 user order routes + 4 admin order routes (prefix admin, middleware auth+admin)
- [x] **Migrate fresh + seed** — Semua tabel + data berhasil

### Alur Pembayaran
| Metode | Alur |
|--------|------|
| **Bank Transfer** | User checkout → lihat instruksi transfer → transfer → klik "I've Transferred" → payment_status jadi "paid" → Admin verifikasi → update status pesanan |
| **COD** | User checkout → bayar saat terima → Admin update payment_status + status |
| **QRIS** | User checkout → scan QR (manual) → Admin verifikasi |

### Admin Credentials
- Email: `admin@segarbuah.com`
- Password: `password`

### User Credentials
- Email: `user@segarbuah.com`
- Password: `password`

---

## 2026-06-16 — Fase 3: Dashboard Admin

### Perubahan
- [x] **Admin/DashboardController** — Statistik: total orders, revenue, pending, products, categories, users
- [x] **Dashboard View** — Cards statistik (6), grafik bar monthly revenue, pie chart orders by status, tabel recent orders, top products, quick links
- [x] **Route** — GET `/admin` → `admin.dashboard` (middleware auth + admin)
- [x] **Navigation** — Dropdown admin: Dashboard + Manage Orders, Mobile nav link
- [x] **Build Vite** — Sukses

### Ringkasan Dashboard
| Elemen | Detail |
|--------|--------|
| Stat Cards | Total Orders, Revenue, Pending, Products, Categories, Users |
| Monthly Revenue | Bar chart per bulan (year to date) |
| Orders by Status | Progress bar per status (pending → cancelled) |
| Recent Orders | Tabel 10 order terakhir |
| Top Products | 5 produk terlaris (qty + revenue) |
| Quick Links | Orders, Products, Categories, Users |

---

## 2026-06-16 — Fase 3: Flash Sale / Promo

### Perubahan
- [x] **Migration** — `sale_price`, `sale_starts_at`, `sale_ends_at` ke tabel `products`
- [x] **Product Model** — fillable + casts + scope `activeSale()`
- [x] **Seeder** — 4 produk pertama mendapat flash sale 30% off (8 jam)
- [x] **Home Page** — Flash Sale section dengan countdown timer (Alpine.js), 4 produk sale, background gradient merah
- [x] **Shop Page** — Sale price + original strikethrough + "SALE" badge, filter `?sale=1`
- [x] **Detail Page** — Sale price merah dengan discount badge
- [x] **Admin Flash Sale** — `/admin/flash-sale` tabel semua produk + modal form (Alpine) set sale price, start, end
- [x] **Navigation** — Admin dropdown + mobile menu "Flash Sale" link
- [x] **Build + migrate** — Sukses

### Files Changed
- `database/migrations/*_add_flash_sale_fields_to_products_table.php` — **new file**
- `app/Models/Product.php` — add sale fields fills + casts + scope
- `app/Http/Controllers/Admin/FlashSaleController.php` — **new file**
- `app/Http/Controllers/HomeController.php` — load flash sales
- `app/Http/Controllers/ShopController.php` — sale filter
- `resources/views/admin/flash-sale.blade.php` — **new file** (tabel + modal)
- `resources/views/pages/home.blade.php` — Flash Sale section + countdown Alpine script
- `resources/views/pages/shop.blade.php` — sale price display
- `resources/views/pages/product-detail.blade.php` — sale price + badge
- `resources/views/admin/dashboard.blade.php` — quick link Flash Sale
- `resources/views/layouts/navigation.blade.php` — Flash Sale admin links
- `routes/web.php` — 2 flash sale admin routes
- `database/seeders/ProductSeeder.php` — demo flash sale data

---

## 2026-06-16 — Fase 3: Review & Rating

### Perubahan
- [x] **Migration** — `reviews` table (user_id, product_id, rating, comment, unique constraint)
- [x] **Review Model** — fillable, casts, relasi user() & product()
- [x] **Product Model** — reviews() hasMany, averageRating(), reviewsCount()
- [x] **ReviewController** — store (create/update), destroy, validasi must purchase
- [x] **Detail Page** — rating stars header, review form (create/update/delete), review list + pagination
- [x] **Shop Page** — rating stars pada setiap produk card
- [x] **Home Page** — rating stars pada featured products
- [x] **Routes** — 2 review routes (store, destroy)
- [x] **Build + migrate** — Sukses

### Validasi
- User hanya bisa review produk yang sudah dibeli (status delivered/shipped/processing)
- Satu review per user per produk (update instead of duplicate)
- Rating 1-5, comment opsional

### Files Changed
- `database/migrations/*_create_reviews_table.php` — **new file**
- `app/Models/Review.php` — **new file**
- `app/Models/Product.php` — reviews() relation + avg + count
- `app/Http/Controllers/ReviewController.php` — **new file**
- `app/Http/Controllers/ShopController.php` — loadAvg, review data, hasPurchased check
- `app/Http/Controllers/HomeController.php` — loadAvg on featured/flash
- `resources/views/pages/product-detail.blade.php` — rating stars + review form + review list
- `resources/views/pages/shop.blade.php` — rating stars on cards
- `resources/views/pages/home.blade.php` — rating stars on cards
- `routes/web.php` — 2 review routes

---

## 2026-06-16 — Perbaikan Layout Kartu Produk (Shop & Home)

### Perubahan
- [x] **Shop cards** — Ubah struktur kartu jadi `flex flex-col`, image di luar `<a>`, info produk + harga + tombol Add to Cart + Quick View rata bawah pakai `mt-auto`
- [x] **Home cards** — Sama dengan shop: `flex flex-col`, tombol Add to Cart (AJAX) + Quick View di setiap kartu, sale price support
- [x] **Add to Cart AJAX** — Tombol "Cart" di setiap kartu produk (home & shop) via fetch API, update badge + toast
- [x] **Build Vite** — Sukses

### Files Changed
- `resources/views/pages/shop.blade.php` — restruktur kartu produk
- `resources/views/pages/home.blade.php` — restruktur kartu produk

---

## 2026-06-16 — Eksekusi Seluruh Task Pending

### Perubahan
- [x] **Fix dark mode** — Tambah `dark:text-gray-500` di 8 tempat: `/unit` di related products (`product-detail.blade.php:288`), qty `x{n}` di `cart.blade.php`, `checkout.blade.php`, `checkout-success.blade.php`, `admin/orders/show.blade.php`, wishlist compare price (`wishlist.blade.php:44`), dan 3 span di `admin/flash-sale.blade.php`
- [x] **Fix card height** — Tambah `<span class="invisible block text-xs">&nbsp;</span>` di price section shop & home agar tombol Add to Cart + Quick View tidak naik saat tanpa compare_price
- [x] **Fix dark mode global** — Tambah `@custom-variant dark (&:where(.dark, .dark *));` di `app.css`. Tailwind v4 default pakai `@media prefers-color-scheme`, sekarang pakai class-based `.dark` di `<html>`
- [x] **Admin Manage Products** — `Admin/ProductController` CRUD + `admin/products/index.blade.php` (table) + `admin/products/form.blade.php` (create/edit dengan semua field)
- [x] **Admin Manage Categories** — `Admin/CategoryController` CRUD + `admin/categories/index.blade.php` + `admin/categories/form.blade.php`, proteksi hapus jika masih punya products
- [x] **Navigation** — Dropdown admin & mobile menu: Manage Products + Manage Categories
- [x] **Dashboard** — Quick links Products & Categories sudah mengarah ke route yang benar
- [x] **Build Vite** — Sukses (CSS ~82KB, JS ~94KB)
- [x] **Migrate fresh + seed** — Sukses (semua tabel + data seed)

### Files Changed
- `app/Http/Controllers/Admin/ProductController.php` — **new file** (CRUD produk)
- `app/Http/Controllers/Admin/CategoryController.php` — **new file** (CRUD kategori)
- `resources/views/admin/products/index.blade.php` — **new file**
- `resources/views/admin/products/form.blade.php` — **new file**
- `resources/views/admin/categories/index.blade.php` — **new file**
- `resources/views/admin/categories/form.blade.php` — **new file**
- `routes/web.php` — tambah import + resource routes products & categories
- `resources/views/layouts/navigation.blade.php` — tambah link Manage Products & Manage Categories
- `resources/views/admin/dashboard.blade.php` — update quick links Products & Categories
- `resources/views/pages/product-detail.blade.php` — fix dark mode `/unit`
- `resources/views/pages/wishlist.blade.php` — fix dark mode compare price
- `resources/views/pages/cart.blade.php` — fix dark mode qty
- `resources/views/pages/checkout.blade.php` — fix dark mode qty
- `resources/views/pages/checkout-success.blade.php` — fix dark mode qty
- `resources/views/admin/orders/show.blade.php` — fix dark mode qty
- `resources/views/admin/flash-sale.blade.php` — fix dark mode sale/placeholder spans
- `resources/views/pages/shop.blade.php` — fix card height (invisible placeholder)
- `resources/views/pages/home.blade.php` — fix card height (invisible placeholder)
- `resources/css/app.css` — tambah `@custom-variant dark` untuk class-based dark mode
- `resources/views/admin/products/form.blade.php` — redesign form dengan section cards (Basic Info, Inventory, Media, Flags)
- `resources/views/admin/products/form.blade.php` — fix konsistensi input: `px-4 py-2.5` seragam, hapus inline "Rp" prefix (ganti placeholder), tambah `pr-8` di weight untuk "g" suffix, standarisasi error messages & label classes via variabel PHP
- `resources/views/admin/categories/form.blade.php` — fix konsistensi input dengan pola yang sama
- `resources/views/components/text-input.blade.php` — standarisasi: tambah `px-4 py-2.5 text-sm placeholder-gray-400 dark:placeholder-gray-500` ke component dasar
- `resources/views/admin/blog/form.blade.php` — standarisasi input + `resize-y` textareas + `shrink-0` checkbox
- `resources/views/admin/flash-sale.blade.php` — standarisasi input modal (sale_price, starts_at, ends_at)
- `resources/views/admin/orders/show.blade.php` — standarisasi select status & payment_status
- `resources/views/pages/product-detail.blade.php` — standarisasi textarea review
- `resources/views/pages/shop.blade.php` — ganti `dark:bg-gray-900` → `dark:bg-gray-800` di search & sort
- `resources/views/pages/checkout.blade.php` — tambah `placeholder-gray-400 dark:placeholder-gray-500` di semua field
- `resources/views/auth/login.blade.php` — standarisasi checkbox (hapus `shadow-sm`, tambah `shrink-0`)

---

## 2026-06-16 — Optimasi Performa & Admin Dashboard Sidebar

### Perubahan

#### 🔥 Optimasi Performa (Tuning Kecepatan)

**1. Database Indexing** — Migration baru `add_performance_indexes`
| Tabel | Indexes |
|-------|---------|
| `products` | `is_active`, `is_featured`, `is_organic`, `is_seasonal`, composite `[category_id, is_active]` |
| `orders` | `status`, `payment_status`, composite `[user_id, status]`, `created_at` |
| `order_items` | `product_id` |
| `reviews` | `product_id`, `user_id` |

**2. Application Caching** — `app/Services/CacheService.php`
| Cache Key | TTL | Data |
|-----------|-----|------|
| `categories.active` | 1 jam | Semua kategori aktif |
| `products.featured` | 10 menit | 8 featured products (dengan category + avg rating) |
| `products.flash_sales` | 5 menit | 4 flash sale products |
| `admin.dashboard.*` | 5 menit | Stats, recent orders, monthly revenue, orders by status, top products |
| `user.{id}.wishlist_count` | 1 menit | Jumlah wishlist user |
| `user.{id}.unread_notifications` | 1 menit | Jumlah notifikasi belum dibaca |
| `user.{id}.recent_notifications` | 1 menit | 5 notifikasi terbaru |

**3. Cache Flush on Data Change**
| Event | Cache Flush |
|-------|------------|
| Product create/update/delete | `products.featured`, `products.flash_sales` |
| Category create/update/delete | `categories.active` |
| Flash sale update | `products.flash_sales`, `products.featured` |
| Order status/payment update | `admin.dashboard.*` |

**4. Navigation Query Optimization**
- Pindahkan semua `@php` inline queries (wishlist count, notification count, recent notifications) ke `CartComposer` → di-cache & hanya di-load sekali per page
- Hapus 3 query manual di `navigation.blade.php`

**5. Eager Loading**
- `ShopController` — tambah `with('category')` + `withAvg()` di query awal
- `HomeController` — gunakan cache service dengan eager loading built-in

### Files Changed (Performa)
- `database/migrations/2026_06_16_210000_add_performance_indexes.php` — **new file** (13 indexes)
- `app/Services/CacheService.php` — **new file** (cache management service)
- `app/Providers/AppServiceProvider.php` — register `CacheService` singleton
- `app/View/Composers/CartComposer.php` — tambah wishlist + notification cache
- `app/Http/Controllers/HomeController.php` — gunakan cache service
- `app/Http/Controllers/ShopController.php` — gunakan cache untuk categories
- `app/Http/Controllers/Admin/DashboardController.php` — dashboard stats caching
- `app/Http/Controllers/Admin/ProductController.php` — flush cache on CRUD
- `app/Http/Controllers/Admin/CategoryController.php` — flush cache on CRUD
- `app/Http/Controllers/Admin/FlashSaleController.php` — flush cache on update
- `app/Http/Controllers/Admin/OrderController.php` — flush dashboard cache
- `resources/views/layouts/navigation.blade.php` — hapus inline queries, pakai composer-shared vars

#### 🎨 Admin Dashboard — Left Sidebar

**Desain Baru:**
```
Desktop (lg+):      Tablet (md-lg):     Mobile (< md):
┌──────┬──────────┐ ┌─────┬───────────┐ ┌──────────────┐
│Nav   │ Content  │ │Nav  │ Content   │ │ [Menu] Title │
│w-64  │ flex-1   │ │w-56 │ flex-1    │ ├──────────────┤
│      │          │ │     │           │ │   Content    │
│•Dashboard      │ │•Dashboard       │ │   (full width)│
│•Orders (badge) │ │•Orders (badge)  │ │              │
│•Products       │ │•Products        │ │              │
│•Categories     │ │•Categories      │ │              │
│•Blog           │ │•Blog            │ │              │
│•Flash Sale     │ │•Flash Sale      │ │              │
│[View Store]    │ │[View Store]     │ │              │
└──────┴──────────┘ └─────┴───────────┘ └──────────────┘
```

**Fitur Sidebar:**
- Sticky di laptop (`sticky top-24`)
- Badge pending orders count
- Counter products & categories
- Active route highlighting (emerald bg)
- "View Store" link dengan icon external
- Responsive: sidebar di lg+, content full-width di mobile

### Files Changed (Dashboard Sidebar)
- `resources/views/admin/dashboard.blade.php` — **redesigned** (sidebar + content layout)

#### 🔄 Sidebar ke Semua Halaman Admin
Dibuat komponen reusable `components/admin-sidebar.blade.php` dengan cache mandiri, lalu diterapkan ke SEMUA halaman admin:

| Halaman | Status |
|---------|--------|
| Dashboard | ✅ Pakai `x-admin-sidebar` |
| Orders Index | ✅ Pakai `x-admin-sidebar` |
| Orders Show | ✅ Pakai `x-admin-sidebar` |
| Products Index | ✅ Pakai `x-admin-sidebar` |
| Products Form | ✅ Pakai `x-admin-sidebar` |
| Categories Index | ✅ Pakai `x-admin-sidebar` |
| Categories Form | ✅ Pakai `x-admin-sidebar` |
| Blog Index | ✅ Pakai `x-admin-sidebar` |
| Blog Form | ✅ Pakai `x-admin-sidebar` |
| Flash Sale | ✅ Pakai `x-admin-sidebar` |

### Files Changed (Sidebar Component)
- `resources/views/components/admin-sidebar.blade.php` — **new file** (sidebar component with self-contained cached queries)
- `resources/views/admin/dashboard.blade.php` — ganti sidebar inline dengan `<x-admin-sidebar />`
- `resources/views/admin/orders/index.blade.php` — tambah sidebar
- `resources/views/admin/orders/show.blade.php` — tambah sidebar
- `resources/views/admin/products/index.blade.php` — tambah sidebar
- `resources/views/admin/products/form.blade.php` — tambah sidebar
- `resources/views/admin/categories/index.blade.php` — tambah sidebar
- `resources/views/admin/categories/form.blade.php` — tambah sidebar
- `resources/views/admin/blog/index.blade.php` — tambah sidebar
- `resources/views/admin/blog/form.blade.php` — tambah sidebar
- `resources/views/admin/flash-sale.blade.php` — tambah sidebar

### Build
- CSS: ~86KB | JS: ~94KB
- Migrate fresh + seed: Sukses

### ✅ Selesai
| # | Task | Keterangan |
|---|------|-----------|
| 1 | **Card produk: tambah button Add to Cart langsung** | Tombol Cart (AJAX) di setiap kartu shop & home, update badge + toast |
| 2 | **Image card di luar `<a>`** | Image tidak lagi dibungkus link, hanya teks info yang clickable |
| 3 | **Fix dark mode: warna tulisan tidak terbaca** | Tambah `dark:text-gray-500` di: related products `/unit`, qty `x{n}` di cart/checkout/success/admin, wishlist compare price, admin flash-sale |
| 4 | **Fix card produk: button quick view naik jika tanpa compare_price** | Tambah invisible placeholder `<span class="invisible block text-xs">&nbsp;</span>` di price section agar height konsisten |
| 5 | **Buat manage produk & kategori di admin panel** | Admin/ProductController + Admin/CategoryController + views + routes + navigation |
| 6 | **Build + migrate + update AGENTS.md** | Build sukses, migrate fresh + seed sukses, dokumentasi diperbarui |
| 7 | **Optimasi performa: database indexing** | 13 indexes baru di products, orders, order_items, reviews |
| 8 | **Optimasi performa: application caching** | Cache untuk categories, featured, flash sales, dashboard, wishlist, notifikasi |
| 9 | **Optimasi performa: navigation queries** | Pindahkan 3 inline @php queries ke CartComposer dengan cache |
| 10 | **Admin dashboard left sidebar redesign** | Sidebar sticky dengan nav items, badge, counter, responsive layout |
| 11 | **Sidebar di semua halaman admin** | Komponen `x-admin-sidebar` diterapkan ke 10 halaman admin (orders, products, categories, blog, flash-sale) |

### ❌ Belum Dikerjakan
| # | Task | Detail | Prioritas |
|---|------|--------|-----------|
| 1 | **Mass Delete** | Tambah checkbox centang di tabel admin (products, orders, categories, blog) + tombol "Delete Selected" untuk hapus massal | High |
| 2 | **Flash Sale CRUD** | Bisa tambah produk baru ke flash sale (bukan edit per-produk) dan hapus produk dari flash sale sekaligus | High |

---

## 2026-06-16 — Railway Deployment Setup

### File Baru
| File | Fungsi |
|------|--------|
| `Dockerfile` | Build image PHP 8.2 + Apache + Composer + Node.js, compile asset, auto migrate |
| `docker-entrypoint.sh` | Entrypoint: storage link, cache config/routes, migrate, lalu jalankan Apache |
| `.env.example` | Update production vars dengan Railway MySQL variables |

### Step-by-Step Deploy ke Railway.app

**1. Push ke GitHub**

Buat repo baru di GitHub (misal `segarbuah`), lalu:

```bash
cd laravel_app-ecomm
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/USERNAME/segarbuah.git
git push -u origin main
```

**2. Setup Railway**

1. Buka [railway.app](https://railway.app) → Login with GitHub
2. Klik **New Project** → **Deploy from GitHub repo**
3. Pilih repo `segarbuah`
4. Railway auto-detect `Dockerfile` dan mulai build

**3. Add MySQL Database**

1. Di dashboard project Railway, klik **+ New**
2. Pilih **Database** → **MySQL** (versi 8)
3. Tunggu provisioning selesai
4. Railway otomatis inject environment variables: `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, `MYSQLPASSWORD`

**4. Environment Variables**

Set di Railway dashboard → Variables tab:

| Variable | Value | Keterangan |
|----------|-------|-----------|
| `APP_KEY` | `base64:...` | `php artisan key:generate --show` |
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `false` | |
| `APP_URL` | `https://segarbuah.railway.app` | Ganti sesuai domain nanti |

**5. Custom Domain (Opsional)**

Di Railway → Settings → Domains → Generate Domain atau Custom Domain.

**6. Redeploy**

Setiap push ke GitHub auto-deploy. Untuk manual: klik **Deploy** di dashboard.

### Catatan Penting
- **Storage tidak persisten** — Setiap deploy ulang, file upload (bukti pembayaran) akan hilang. Solusi: pakai S3 atau Cloud Storage.
- **Queue worker** — Railway bisa jalanin background worker dengan `railway run php artisan queue:work` via cronjob.
- **Session** — Pakai `database` driver, aman di Railway karena MySQL persisten.
- **Caching** — Pakai `database` cache store, sementara hingga setup Redis.
