document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const header = document.querySelector('.site-header');
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav-links');
  const progress = document.querySelector('.progress');
  const backtop = document.querySelector('.backtop');

  /* =========================================================
     MOBILE NAVIGATION
     ========================================================= */

  if (menuToggle && nav) {
    menuToggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');

      body.classList.toggle('menu-open', open);
      menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    nav.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        nav.classList.remove('open');
        body.classList.remove('menu-open');
        menuToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }


  /* =========================================================
     ACTIVE NAVIGATION LINK
     ========================================================= */

  const current = body.dataset.page;

  document.querySelectorAll('[data-page-link]').forEach(link => {
    if (link.dataset.pageLink === current) {
      link.classList.add('active');
    }
  });


  /* =========================================================
     SCROLL / HEADER / PROGRESS
     ========================================================= */

  const onScroll = () => {
    const y = window.scrollY;

    if (header) {
      header.classList.toggle('scrolled', y > 12);
    }

    if (backtop) {
      backtop.classList.toggle('show', y > 550);
    }

    if (progress) {
      const doc = document.documentElement;
      const max = doc.scrollHeight - doc.clientHeight;

      progress.style.width =
        (max ? (y / max) * 100 : 0) + '%';
    }
  };

  window.addEventListener('scroll', onScroll, {
    passive: true
  });

  onScroll();


  /* =========================================================
     BACK TO TOP
     ========================================================= */

  if (backtop) {
    backtop.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }


  /* =========================================================
     SCROLL REVEAL
     ========================================================= */

  const reveal = document.querySelectorAll('.reveal');

  if ('IntersectionObserver' in window) {

    const io = new IntersectionObserver(entries => {

      entries.forEach(entry => {

        if (entry.isIntersecting) {

          entry.target.classList.add('is-visible');

          io.unobserve(entry.target);
        }

      });

    }, {
      threshold: 0.12
    });

    reveal.forEach(el => io.observe(el));

  } else {

    reveal.forEach(el => {
      el.classList.add('is-visible');
    });

  }


  /* =========================================================
     ANIMATED COUNTERS
     ========================================================= */

  document.querySelectorAll('[data-counter]').forEach(el => {

    const target = Number(el.dataset.counter || 0);

    if (!target) return;

    let started = false;

    const animate = () => {

      if (started) return;

      started = true;

      const duration = 1100;
      const start = performance.now();

      const tick = now => {

        const p = Math.min(
          (now - start) / duration,
          1
        );

        const eased = 1 - Math.pow(1 - p, 3);

        el.textContent =
          Math.round(target * eased).toLocaleString() +
          (el.dataset.suffix || '');

        if (p < 1) {
          requestAnimationFrame(tick);
        }

      };

      requestAnimationFrame(tick);
    };


    if ('IntersectionObserver' in window) {

      const co = new IntersectionObserver(entries => {

        if (entries[0].isIntersecting) {

          animate();

          co.disconnect();
        }

      }, {
        threshold: 0.6
      });

      co.observe(el);

    } else {

      animate();

    }

  });


  /* =========================================================
     HOMEPAGE IMAGE CAROUSEL
     ========================================================= */

  const carousel = document.querySelector('[data-carousel]');

  if (carousel) {

    const slides = [
      ...carousel.querySelectorAll('.carousel-slide')
    ];

    const dots = [
      ...carousel.querySelectorAll('.carousel-dot')
    ];

    const prev = carousel.querySelector('.carousel-prev');
    const next = carousel.querySelector('.carousel-next');

    let index = 0;
    let timer = null;
    let paused = false;


    /* ---------------------------------------------------------
       SHOW SLIDE
       --------------------------------------------------------- */

    const showSlide = (nextIndex) => {

      if (!slides.length) return;

      index =
        (nextIndex + slides.length) %
        slides.length;


      slides.forEach((slide, i) => {

        const active = i === index;

        slide.classList.toggle(
          'is-active',
          active
        );

        slide.setAttribute(
          'aria-hidden',
          active ? 'false' : 'true'
        );

      });


      dots.forEach((dot, i) => {

        const active = i === index;

        dot.classList.toggle(
          'is-active',
          active
        );

        if (active) {

          dot.setAttribute(
            'aria-current',
            'true'
          );

        } else {

          dot.removeAttribute(
            'aria-current'
          );

        }

      });

    };


    /* ---------------------------------------------------------
       START AUTOMATIC SLIDESHOW
       --------------------------------------------------------- */

    const start = () => {

      clearInterval(timer);

      /*
       Respect the user's reduced-motion preference.
      */

      if (
        window.matchMedia(
          '(prefers-reduced-motion: reduce)'
        ).matches
      ) {
        return;
      }


      timer = setInterval(() => {

        if (
          !paused &&
          !document.hidden
        ) {

          showSlide(index + 1);

        }

      }, 5200);

    };


    /* ---------------------------------------------------------
       RESTART TIMER
       --------------------------------------------------------- */

    const restart = () => {
      start();
    };


    /* ---------------------------------------------------------
       PREVIOUS BUTTON
       --------------------------------------------------------- */

    if (prev) {

      prev.addEventListener('click', () => {

        showSlide(index - 1);

        restart();

      });

    }


    /* ---------------------------------------------------------
       NEXT BUTTON
       --------------------------------------------------------- */

    if (next) {

      next.addEventListener('click', () => {

        showSlide(index + 1);

        restart();

      });

    }


    /* ---------------------------------------------------------
       CAROUSEL DOTS
       --------------------------------------------------------- */

    dots.forEach((dot, i) => {

      dot.addEventListener('click', () => {

        showSlide(i);

        restart();

      });

    });


    /* ---------------------------------------------------------
       PAUSE WHEN MOUSE IS OVER CAROUSEL
       --------------------------------------------------------- */

    carousel.addEventListener(
      'mouseenter',
      () => {
        paused = true;
      }
    );

    carousel.addEventListener(
      'mouseleave',
      () => {
        paused = false;
      }
    );


    /* ---------------------------------------------------------
       PAUSE WHEN CAROUSEL HAS KEYBOARD FOCUS
       --------------------------------------------------------- */

    carousel.addEventListener(
      'focusin',
      () => {
        paused = true;
      }
    );

    carousel.addEventListener(
      'focusout',
      () => {
        paused = false;
      }
    );


    /* ---------------------------------------------------------
       KEYBOARD CONTROLS
       --------------------------------------------------------- */

    carousel.addEventListener(
      'keydown',
      e => {

        if (e.key === 'ArrowLeft') {

          e.preventDefault();

          showSlide(index - 1);

          restart();

        }

        if (e.key === 'ArrowRight') {

          e.preventDefault();

          showSlide(index + 1);

          restart();

        }

      }
    );


    /* ---------------------------------------------------------
       MOBILE SWIPE SUPPORT
       --------------------------------------------------------- */

    let touchStartX = 0;

    carousel.addEventListener(
      'touchstart',
      e => {

        touchStartX =
          e.changedTouches[0].screenX;

      },
      {
        passive: true
      }
    );


    carousel.addEventListener(
      'touchend',
      e => {

        const touchEndX =
          e.changedTouches[0].screenX;

        const distance =
          touchEndX - touchStartX;


        /*
         Ignore tiny movements.
        */

        if (Math.abs(distance) < 45) {
          return;
        }


        /*
         Swipe left = next slide
         Swipe right = previous slide
        */

        if (distance < 0) {

          showSlide(index + 1);

        } else {

          showSlide(index - 1);

        }

        restart();

      },
      {
        passive: true
      }
    );


    /* ---------------------------------------------------------
       INITIALIZE CAROUSEL
       --------------------------------------------------------- */

    showSlide(0);

    start();

  }


  /* =========================================================
     GALLERY / LIGHTBOX
     ========================================================= */

  const gallery =
    document.querySelector('[data-gallery]');

  const lightbox =
    document.querySelector('.lightbox');


  if (
    gallery &&
    lightbox &&
    window.GALLERY_ITEMS
  ) {

    let filtered = [
      ...window.GALLERY_ITEMS
    ];

    let currentIndex = 0;

    const grid = gallery;


    /* ---------------------------------------------------------
       RENDER GALLERY
       --------------------------------------------------------- */

    const render = () => {

      grid.innerHTML = filtered.map(
        (item, i) => `
          <button
            class="gallery-item"
            type="button"
            data-index="${i}"
            aria-label="Open image ${i + 1}"
          >

            <img
              src="${item.src}"
              alt="${item.alt}"
              loading="lazy"
            >

            <span class="gallery-overlay">
              ${item.label}
            </span>

          </button>
        `
      ).join('');


      grid
        .querySelectorAll('.gallery-item')
        .forEach(btn => {

          btn.addEventListener(
            'click',
            () => {
              openLightbox(
                Number(btn.dataset.index)
              );
            }
          );

        });

    };


    /* ---------------------------------------------------------
       OPEN LIGHTBOX
       --------------------------------------------------------- */

    const openLightbox = i => {

      currentIndex = i;

      const item =
        filtered[currentIndex];


      lightbox
        .querySelector('img')
        .src = item.src;


      lightbox
        .querySelector('img')
        .alt = item.alt;


      lightbox
        .querySelector('.lightbox-caption')
        .textContent = item.label;


      lightbox.classList.add('open');

      document.body.classList.add(
        'menu-open'
      );

    };


    /* ---------------------------------------------------------
       CLOSE LIGHTBOX
       --------------------------------------------------------- */

    const close = () => {

      lightbox.classList.remove('open');

      document.body.classList.remove(
        'menu-open'
      );

    };


    /* ---------------------------------------------------------
       LIGHTBOX NEXT / PREVIOUS
       --------------------------------------------------------- */

    const lightboxNext = step => {

      if (!filtered.length) return;

      currentIndex =
        (
          currentIndex +
          step +
          filtered.length
        ) %
        filtered.length;


      openLightbox(currentIndex);

    };


    /* ---------------------------------------------------------
       LIGHTBOX BUTTONS
       --------------------------------------------------------- */

    const closeButton =
      lightbox.querySelector('[data-close]');

    const prevButton =
      lightbox.querySelector('[data-prev]');

    const nextButton =
      lightbox.querySelector('[data-next]');


    if (closeButton) {
      closeButton.addEventListener(
        'click',
        close
      );
    }

    if (prevButton) {
      prevButton.addEventListener(
        'click',
        () => lightboxNext(-1)
      );
    }

    if (nextButton) {
      nextButton.addEventListener(
        'click',
        () => lightboxNext(1)
      );
    }


    /* ---------------------------------------------------------
       CLOSE LIGHTBOX WHEN CLICKING BACKDROP
       --------------------------------------------------------- */

    lightbox.addEventListener(
      'click',
      e => {

        if (e.target === lightbox) {
          close();
        }

      }
    );


    /* ---------------------------------------------------------
       LIGHTBOX KEYBOARD CONTROLS
       --------------------------------------------------------- */

    document.addEventListener(
      'keydown',
      e => {

        if (
          !lightbox.classList.contains(
            'open'
          )
        ) {
          return;
        }


        if (e.key === 'Escape') {
          close();
        }

        if (e.key === 'ArrowRight') {
          lightboxNext(1);
        }

        if (e.key === 'ArrowLeft') {
          lightboxNext(-1);
        }

      }
    );


    /* ---------------------------------------------------------
       GALLERY FILTERS
       --------------------------------------------------------- */

    document
      .querySelectorAll('[data-filter]')
      .forEach(btn => {

        btn.addEventListener(
          'click',
          () => {

            document
              .querySelectorAll('[data-filter]')
              .forEach(b => {
                b.classList.remove(
                  'active'
                );
              });


            btn.classList.add('active');


            const filter =
              btn.dataset.filter;


            filtered =
              filter === 'all'
                ? [...window.GALLERY_ITEMS]
                : window.GALLERY_ITEMS.filter(
                    x => x.category === filter
                  );


            render();

          }
        );

      });


    render();

  }


  /* =========================================================
     CONTACT FORM
     ========================================================= */

  const form =
    document.querySelector('#contactForm');

  const toast =
    document.querySelector('.toast');


  if (form) {

    form.addEventListener(
      'submit',
      e => {

        e.preventDefault();


        if (!form.checkValidity()) {

          form.reportValidity();

          return;

        }


        if (toast) {

          toast.textContent =
            'Your message is ready. Connect this form to your preferred email/backend service to send it.';

          toast.classList.add('show');


          setTimeout(
            () => {
              toast.classList.remove(
                'show'
              );
            },
            5000
          );

        }


        form.reset();

      }
    );

  }


  /* =========================================================
     CURRENT YEAR
     ========================================================= */

  document
    .querySelectorAll('[data-year]')
    .forEach(
      el => {
        el.textContent =
          new Date().getFullYear();
      }
    );

});