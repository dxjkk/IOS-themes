/* ============================================================
   LiquidGlass v3.0 — Application Core
   Typecho 1.3 Theme | Vanilla JS + GSAP
   ============================================================ */

const App = {
    init() {
        this._renderNav();
        this._bindEvents();
        this._initAnimations();
        this._updateWeather();
        this._loadTheme();
        this._initProgressBar();
        this._initHeaderScroll();
        this._initSidebarNav();
        this._initSidebarClock();
        this._initDockScroll();
    },

    /* ---- Render navigation from theme config ---- */
    _renderNav() {
        const cfg = window.LIQUIDGLASS || {};
        const navLinks = cfg.navLinks || [];
        const navLinksExtra = cfg.navLinksExtra || [];
        const allLinks = [...navLinks, ...navLinksExtra];

        const grid = document.getElementById("navGrid");
        if (grid && navLinks.length) {
            const visible = navLinks.slice(0, 7);
            grid.innerHTML =
                visible.map(l => `
                    <a href="${l.url || '#'}" class="nav-btn" target="_blank" rel="noopener">
                        <span class="nav-btn-icon">${l.icon || '<i class="fas fa-link"></i>'}</span>
                        <span class="nav-btn-label">${l.label || ''}</span>
                    </a>
                `).join("") +
                '<button class="nav-btn nav-btn-more" id="navMoreBtn" aria-label="展开导航">' +
                    '<span class="nav-btn-icon"><i class="fas fa-ellipsis-h"></i></span>' +
                    '<span class="nav-btn-label">更多</span>' +
                '</button>';

            grid.querySelector("#navMoreBtn")?.addEventListener("click", () => this._openNavExpand());
        }

        const expandGrid = document.getElementById("navExpandGrid");
        if (expandGrid) {
            if (allLinks.length) {
                expandGrid.innerHTML = allLinks.map(l => `
                    <a href="${l.url || '#'}" class="nav-btn" target="_blank" rel="noopener">
                        <span class="nav-btn-icon">${l.icon || '<i class="fas fa-link"></i>'}</span>
                        <span class="nav-btn-label">${l.label || ''}</span>
                    </a>
                `).join("");
            } else {
                expandGrid.innerHTML = '<p style="text-align:center;color:var(--text-tertiary);padding:24px;grid-column:1/-1;">暂无导航链接</p>';
            }
        }
    },

    /* ---- Reading progress bar ---- */
    _initProgressBar() {
        const bar = document.getElementById("readingProgress");
        if (!bar) return;
        const upd = () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight;
            const winHeight = window.innerHeight;
            const pct = docHeight > winHeight ? scrollTop / (docHeight - winHeight) : 0;
            bar.style.transform = `scaleX(${Math.min(1, Math.max(0, pct))})`;
        };
        window.addEventListener("scroll", upd, { passive: true });
        window.addEventListener("resize", upd, { passive: true });
        upd();
    },

    /* ---- Scroll-aware header opacity ---- */
    _initHeaderScroll() {
        const header = document.getElementById("header");
        if (!header) return;
        let lastY = window.scrollY;
        window.addEventListener("scroll", () => {
            const y = window.scrollY;
            const opacity = Math.max(0.6, 1 - y / 200);
            header.style.opacity = opacity;
            lastY = y;
        }, { passive: true });
    },

    /* ---- Sidebar clock ---- */
    _initSidebarClock() {
        const el = document.getElementById("sidebarTime");
        if (!el) return;
        const tick = () => {
            const now = new Date();
            el.textContent = now.toLocaleTimeString('zh-CN', { hour: '2-digit', minute: '2-digit' });
        };
        tick();
        setInterval(tick, 30000);
    },

    /* ---- Sidebar nav active tracking ---- */
    _initSidebarNav() {
        const items = document.querySelectorAll(".sidebar-nav-item");
        if (!items.length) return;
        const path = window.location.pathname;
        const host = window.LIQUIDGLASS?.siteUrl || '';
        const sitePath = host ? new URL(host).pathname.replace(/\/$/, '') : '';

        items.forEach(item => {
            const nav = item.dataset.nav;
            item.classList.remove("active");

            if (nav === "home" && (path === '/' || path === '/index.php' || path === sitePath || path === sitePath + '/')) {
                item.classList.add("active");
            } else if (nav === "categories" && path.includes('/category/')) {
                item.classList.add("active");
            }
        });
    },

    /* ---- Mobile dock show/hide on scroll ---- */
    _initDockScroll() {
        const dock = document.getElementById("mobileDock");
        if (!dock) return;
        let lastScroll = window.scrollY;
        let timeout;
        window.addEventListener("scroll", () => {
            const now = window.scrollY;
            if (now > lastScroll && now > 200) {
                dock.classList.add("hidden");
            } else {
                dock.classList.remove("hidden");
            }
            lastScroll = now;
            clearTimeout(timeout);
            timeout = setTimeout(() => dock.classList.remove("hidden"), 2000);
        }, { passive: true });
    },

    /* ---- Event bindings ---- */
    _bindEvents() {
        document.getElementById("themeToggle")?.addEventListener("click", () => this._toggleTheme());

        document.getElementById("searchTrigger")?.addEventListener("click", () => this._openSearch());
        document.querySelector(".search-backdrop")?.addEventListener("click", () => this._closeSearch());

        document.getElementById("navExpandClose")?.addEventListener("click", () => this._closeNavExpand());
        document.querySelector(".nav-expand-backdrop")?.addEventListener("click", () => this._closeNavExpand());

        document.getElementById("sheetBackdrop")?.addEventListener("click", () => MobileShell.close());

        document.querySelectorAll(".dock-item").forEach(item => {
            item.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelectorAll(".dock-item").forEach(d => d.classList.remove("active"));
                item.classList.add("active");
                this._onDockTap(item.dataset.dock);
            });
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this._closeSearch();
                this._closeNavExpand();
                MobileShell.close();
            }
            if ((e.metaKey || e.ctrlKey) && e.key === "k") {
                e.preventDefault();
                this._openSearch();
            }
        });

        document.querySelectorAll(".category-pill").forEach(pill => {
            pill.addEventListener("click", () => {
                const slug = pill.dataset.category;
                const id = parseInt(pill.dataset.id);
                const siteUrl = window.LIQUIDGLASS?.siteUrl || '/';

                if (slug === "all" || id === 0) {
                    window.location.href = siteUrl;
                    return;
                }
                const cat = (window.LIQUIDGLASS?.categories || []).find(c => c.id == id);
                window.location.href = siteUrl + 'category/' + (cat ? cat.slug : slug) + '/';
            });
        });

        this._highlightCategory();

        window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => {
            const stored = localStorage.getItem("liquidglass-theme");
            if (!stored) { this._applySystemTheme(); }
        });
    },

    /* ---- Highlight current category pill ---- */
    _highlightCategory() {
        const pills = document.querySelectorAll(".category-pill");
        const path = window.location.pathname;
        pills.forEach(p => {
            const slug = p.dataset.category;
            if ((slug === "all" || p.dataset.id === "0") &&
                (path === '/' || path === '/index.php' || path === '' || path.endsWith('/index.php/'))) {
                p.classList.add("active");
            } else if (slug !== "all" && path.includes('/category/' + slug)) {
                p.classList.add("active");
            }
        });
    },

    /* ---- GSAP Animations ---- */
    _initAnimations() {
        if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
            document.querySelectorAll(".reveal, .reveal-scale").forEach(el => {
                ScrollTrigger.create({
                    trigger: el,
                    start: "top 88%",
                    onEnter: () => el.classList.add("revealed"),
                    once: true,
                });
            });
            ScrollTrigger.refresh();
        }

        document.querySelectorAll(".article-card, .nav-btn").forEach(el => {
            if (typeof gsap !== "undefined") {
                const spring = { scale: 0.97, duration: 0.12, ease: "power2.in" };
                const release = { scale: 1, duration: 0.5, ease: "elastic.out(1,0.3)" };
                el.addEventListener("mousedown", () => gsap.to(el, spring));
                const up = () => gsap.to(el, release);
                el.addEventListener("mouseup", up);
                el.addEventListener("mouseleave", up);
            }
        });
    },

    /* ---- Weather (wttr.in free API) ---- */
    _updateWeather() {
        const cfg = window.LIQUIDGLASS?.weather;
        if (!cfg || !cfg.enable) return;

        const tempEl = document.getElementById("weatherTemp");
        if (!tempEl) return;

        fetch(`https://wttr.in/${encodeURIComponent(cfg.city || 'Beijing')}?format=j1`)
            .then(r => r.json())
            .then(d => {
                const c = d.current_condition[0];
                if (tempEl) tempEl.textContent = `${c.temp_C}°`;
                const iconEl = document.getElementById("weatherIcon");
                if (iconEl) iconEl.textContent = weatherEmoji(c.weatherCode);
                const descEl = document.getElementById("weatherDesc");
                if (descEl) {
                    const map = { 'Sunny':'晴朗','Clear':'晴朗','Partly cloudy':'多云',
                        'Cloudy':'阴天','Overcast':'阴','Mist':'薄雾','Fog':'雾',
                        'Light rain':'小雨','Moderate rain':'中雨','Heavy rain':'大雨',
                        'Light snow':'小雪','Moderate snow':'中雪' };
                    descEl.textContent = map[c.weatherDesc[0]?.value] || c.weatherDesc[0]?.value || '';
                }
                const locEl = document.getElementById("weatherLocation");
                if (locEl) {
                    const a = d.nearest_area[0];
                    locEl.textContent = [a.areaName?.[0]?.value, a.country?.[0]?.value].filter(Boolean).join(', ');
                }
            })
            .catch(() => { if (tempEl) tempEl.textContent = '--°'; });
    },

    /* ---- Theme Toggle ---- */
    _toggleTheme() {
        const isDark = document.body.classList.toggle("dark");
        if (!isDark) document.body.classList.add("light");

        localStorage.setItem("liquidglass-theme", isDark ? "dark" : "light");
        MobileShell.showIsland(
            isDark ? "深色模式" : "浅色模式",
            isDark ? "🌙" : "☀️"
        );
    },

    _loadTheme() {
        const saved = localStorage.getItem("liquidglass-theme");
        if (saved === "dark") {
            document.body.classList.add("dark");
            document.body.classList.remove("light");
        } else if (saved === "light") {
            document.body.classList.add("light");
            document.body.classList.remove("dark");
        }
    },

    _applySystemTheme() {
        const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
        if (prefersDark) {
            document.body.classList.add("dark");
            document.body.classList.remove("light");
        } else {
            document.body.classList.add("light");
            document.body.classList.remove("dark");
        }
    },

    /* ---- Search Overlay ---- */
    _openSearch() {
        const ov = document.getElementById("searchOverlay");
        ov?.classList.add("active");
        setTimeout(() => document.getElementById("searchInput")?.focus(), 100);
        document.body.style.overflow = "hidden";
    },
    _closeSearch() {
        document.getElementById("searchOverlay")?.classList.remove("active");
        document.body.style.overflow = "";
        const input = document.getElementById("searchInput");
        if (input) input.value = "";
        const results = document.getElementById("searchResults");
        if (results) results.innerHTML = '<p class="search-hint">输入关键词开始搜索...</p>';
    },

    /* ---- Nav Expand ---- */
    _openNavExpand() {
        document.getElementById("navExpandOverlay")?.classList.add("active");
        document.body.style.overflow = "hidden";
    },
    _closeNavExpand() {
        document.getElementById("navExpandOverlay")?.classList.remove("active");
        document.body.style.overflow = "";
    },

    /* ---- Mobile Dock ---- */
    _onDockTap(action) {
        const siteUrl = window.LIQUIDGLASS?.siteUrl || '/';
        switch (action) {
            case "home":
                window.location.href = siteUrl;
                break;
            case "categories":
                document.getElementById("categoryNav")?.scrollIntoView({ behavior: "smooth" });
                break;
            case "nav":
                this._openNavExpand();
                break;
            case "search":
                this._openSearch();
                break;
            case "more":
                MobileShell.open(`
                    <h4 style="margin-bottom:16px;font-weight:600;">更多</h4>
                    <div style="display:grid;gap:10px;">
                        <button class="nav-btn" style="width:100%;flex-direction:row;justify-content:flex-start;gap:12px;padding:12px 16px;height:auto;border-radius:var(--radius-md);"
                            onclick="App._toggleTheme();MobileShell.close()">
                            <span style="font-size:18px;">🌙</span><span>切换主题</span>
                        </button>
                        <a href="${siteUrl}" class="nav-btn" style="width:100%;flex-direction:row;justify-content:flex-start;gap:12px;padding:12px 16px;height:auto;border-radius:var(--radius-md);text-decoration:none;">
                            <span style="font-size:18px;">🏠</span><span>回到首页</span>
                        </a>
                    </div>
                `);
                break;
        }
    },
};

// -----------------------------------------------------------
// MobileShell
// -----------------------------------------------------------
const MobileShell = {
    isOpen: false,

    open(content) {
        const sheet = document.getElementById("bottomSheet");
        const container = document.getElementById("sheetContent");
        if (!sheet || !container) return;
        container.innerHTML = content;
        sheet.classList.add("active");
        this.isOpen = true;
    },
    close() {
        document.getElementById("bottomSheet")?.classList.remove("active");
        this.isOpen = false;
    },
    showIsland(msg, icon = "✨") {
        const pill = document.getElementById("dynamicIslandPill");
        if (!pill) return;
        pill.querySelector(".island-icon").textContent = icon;
        pill.querySelector(".island-text").textContent = msg;
        pill.classList.add("visible");
        clearTimeout(this._timer);
        this._timer = setTimeout(() => pill.classList.remove("visible"), 2000);
    },
};

// Weather emoji helper
function weatherEmoji(code) {
    if (code >= 200 && code < 300) return '⛈️';
    if (code >= 300 && code < 400) return '🌦️';
    if (code >= 500 && code < 600) return '🌧️';
    if (code >= 600 && code < 700) return '🌨️';
    if (code >= 700 && code < 800) return '🌫️';
    if (code === 800) return '☀️';
    if (code >= 801 && code < 804) return '⛅';
    if (code === 804) return '☁️';
    return '🌤️';
}

// Boot
document.addEventListener("DOMContentLoaded", () => App.init());
