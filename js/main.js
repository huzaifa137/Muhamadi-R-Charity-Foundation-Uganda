
document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const header = document.querySelector('.site-header');
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav-links');
  const progress = document.querySelector('.progress');
  const backtop = document.querySelector('.backtop');

  if (menuToggle && nav) {
    menuToggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      body.classList.toggle('menu-open', open);
      menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      nav.classList.remove('open');
      body.classList.remove('menu-open');
      menuToggle.setAttribute('aria-expanded', 'false');
    }));
  }

  const current = body.dataset.page;
  document.querySelectorAll('[data-page-link]').forEach(link => {
    if (link.dataset.pageLink === current) link.classList.add('active');
  });

  const onScroll = () => {
    const y = window.scrollY;
    if (header) header.classList.toggle('scrolled', y > 12);
    if (backtop) backtop.classList.toggle('show', y > 550);
    if (progress) {
      const doc = document.documentElement;
      const max = doc.scrollHeight - doc.clientHeight;
      progress.style.width = (max ? (y / max) * 100 : 0) + '%';
    }
  };
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();

  if (backtop) backtop.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

  const reveal = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, {threshold:.12});
    reveal.forEach(el => io.observe(el));
  } else reveal.forEach(el => el.classList.add('is-visible'));

  document.querySelectorAll('[data-counter]').forEach(el => {
    const target = Number(el.dataset.counter || 0);
    if (!target) return;
    let started = false;
    const animate = () => {
      if (started) return; started = true;
      const duration = 1100, start = performance.now();
      const tick = now => {
        const p = Math.min((now-start)/duration,1);
        const eased = 1-Math.pow(1-p,3);
        el.textContent = Math.round(target*eased).toLocaleString() + (el.dataset.suffix || '');
        if (p<1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    };
    if ('IntersectionObserver' in window) {
      const co = new IntersectionObserver(es => {
        if (es[0].isIntersecting) { animate(); co.disconnect(); }
      }, {threshold:.6});
      co.observe(el);
    } else animate();
  });

  // Gallery
  const gallery = document.querySelector('[data-gallery]');
  const lightbox = document.querySelector('.lightbox');
  if (gallery && lightbox && window.GALLERY_ITEMS) {
    let filtered = [...window.GALLERY_ITEMS];
    let currentIndex = 0;
    const grid = gallery;
    const render = () => {
      grid.innerHTML = filtered.map((item, i) => `
        <button class="gallery-item" type="button" data-index="${i}" aria-label="Open image ${i+1}">
          <img src="${item.src}" alt="${item.alt}" loading="lazy">
          <span class="gallery-overlay">${item.label}</span>
        </button>
      `).join('');
      grid.querySelectorAll('.gallery-item').forEach(btn => btn.addEventListener('click', () => openLightbox(Number(btn.dataset.index))));
    };
    const openLightbox = i => {
      currentIndex = i;
      const item = filtered[currentIndex];
      lightbox.querySelector('img').src = item.src;
      lightbox.querySelector('img').alt = item.alt;
      lightbox.querySelector('.lightbox-caption').textContent = item.label;
      lightbox.classList.add('open');
      document.body.classList.add('menu-open');
    };
    const close = () => {
      lightbox.classList.remove('open');
      document.body.classList.remove('menu-open');
    };
    const next = step => {
      if (!filtered.length) return;
      currentIndex = (currentIndex + step + filtered.length) % filtered.length;
      openLightbox(currentIndex);
    };
    lightbox.querySelector('[data-close]').addEventListener('click', close);
    lightbox.querySelector('[data-prev]').addEventListener('click', () => next(-1));
    lightbox.querySelector('[data-next]').addEventListener('click', () => next(1));
    lightbox.addEventListener('click', e => { if (e.target === lightbox) close(); });
    document.addEventListener('keydown', e => {
      if (!lightbox.classList.contains('open')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowRight') next(1);
      if (e.key === 'ArrowLeft') next(-1);
    });
    document.querySelectorAll('[data-filter]').forEach(btn => btn.addEventListener('click', () => {
      document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const f = btn.dataset.filter;
      filtered = f === 'all' ? [...window.GALLERY_ITEMS] : window.GALLERY_ITEMS.filter(x => x.category === f);
      render();
    }));
    render();
  }

  // Contact form — client-side validation only, no fake server submission.
  const form = document.querySelector('#contactForm');
  const toast = document.querySelector('.toast');
  if (form) {
    form.addEventListener('submit', e => {
      e.preventDefault();
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }
      if (toast) {
        toast.textContent = 'Your message is ready. Connect this form to your preferred email/backend service to send it.';
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 5000);
      }
      form.reset();
    });
  }

  document.querySelectorAll('[data-year]').forEach(el => el.textContent = new Date().getFullYear());
});
