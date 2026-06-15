import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('cartPreview', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    },
}));

Alpine.data('quickView', () => ({
    open: false,
    product: null,
    qty: 1,
    adding: false,
    added: false,
    show(product) {
        this.product = product;
        this.qty = 1;
        this.adding = false;
        this.added = false;
        this.open = true;
    },
    close() {
        this.open = false;
        this.product = null;
        this.added = false;
    },
    inc() {
        this.qty++;
    },
    dec() {
        if (this.qty > 1) this.qty--;
    },
    addToCartFromQuick(productId, qty) {
        this.adding = true;
        fetch('/cart', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId, quantity: qty }),
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                this.added = true;
                this.adding = false;
                this.updateCartBadge(d.count);
                this.showToast(d.message);
                setTimeout(() => { this.added = false; }, 2000);
            }
        });
    },
    showToast(msg) {
        let t = document.getElementById('cart-toast');
        if (!t) {
            t = document.createElement('div');
            t.id = 'cart-toast';
            t.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium transition-all duration-300 opacity-0 translate-y-4 pointer-events-none';
            document.body.appendChild(t);
        }
        t.textContent = msg;
        t.classList.remove('opacity-0', 'translate-y-4');
        t.classList.add('opacity-100', 'translate-y-0');
        clearTimeout(t._timer);
        t._timer = setTimeout(() => {
            t.classList.remove('opacity-100', 'translate-y-0');
            t.classList.add('opacity-0', 'translate-y-4');
        }, 2500);
    },
    updateCartBadge(count) {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    },
}));

Alpine.data('mobileFilters', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    },
}));

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

    const loadingBar = document.getElementById('loading-bar');
    if (loadingBar) {
        loadingBar.classList.add('active');
        window.addEventListener('load', () => {
            setTimeout(() => loadingBar.classList.remove('active'), 400);
        });
    }

    const scrollTop = document.getElementById('scroll-top');
    if (scrollTop) {
        window.addEventListener('scroll', () => {
            scrollTop.classList.toggle('visible', window.scrollY > 300);
        }, { passive: true });
        scrollTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});