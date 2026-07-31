// ========== MOBILE HAMBURGER MENU ==========
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');
const headerExtra = document.getElementById('headerExtra');

function closeMobileMenu() {
  if (!hamburger || !navMenu) return;
  hamburger.classList.remove('active');
  navMenu.classList.remove('open');
  document.body.classList.remove('menu-open');
  hamburger.setAttribute('aria-expanded', 'false');
}

function closeExtraMenu() {
  if (!hamburger || !headerExtra) return;
  headerExtra.hidden = true;
  hamburger.classList.remove('active');
  hamburger.setAttribute('aria-expanded', 'false');
}

function openMobileMenu() {
  if (!hamburger || !navMenu) return;
  closeExtraMenu();
  hamburger.classList.add('active');
  navMenu.classList.add('open');
  document.body.classList.add('menu-open');
  hamburger.setAttribute('aria-expanded', 'true');
}

function openExtraMenu() {
  if (!hamburger || !headerExtra) return;
  closeMobileMenu();
  headerExtra.hidden = false;
  hamburger.classList.add('active');
  hamburger.setAttribute('aria-expanded', 'true');
}

if (hamburger && navMenu) {
  hamburger.addEventListener('click', (e) => {
    e.stopPropagation();
    if (window.innerWidth <= 1024) {
      if (navMenu.classList.contains('open')) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
      return;
    }

    if (headerExtra && !headerExtra.hidden) {
      closeExtraMenu();
    } else {
      openExtraMenu();
    }
  });

  document.querySelectorAll('.nav__link').forEach(link => {
    const megaParent = link.closest('.nav__item--mega');
    if (megaParent && window.innerWidth <= 1024) {
      link.addEventListener('click', (e) => {
        if (megaParent.querySelector('.mega-menu')) {
          e.preventDefault();
          megaParent.classList.toggle('is-open');
          const expanded = megaParent.classList.contains('is-open');
          link.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }
      });
      return;
    }
    link.addEventListener('click', closeMobileMenu);
  });

  document.querySelectorAll('.mega-menu__link').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
  });

  document.addEventListener('click', (e) => {
    if (headerExtra && !headerExtra.hidden && !e.target.closest('.header__right')) {
      closeExtraMenu();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeMobileMenu();
      closeExtraMenu();
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 1024) {
      closeMobileMenu();
    } else {
      closeExtraMenu();
    }
  });
}

// ========== ODOMETER NUMBER ANIMATION ==========
function initOdometer(container) {
  const track = container.querySelector('.stat__odometer-track');
  if (!track) return;
  const items = track.querySelectorAll('.stat__odometer-item');
  const count = items.length;
  if (count < 2) return;
  const itemHeight = items[0].offsetHeight;
  let currentIndex = 0;
  let isAnimating = false;
  let animId = null;

  function animateToTarget(targetIndex) {
    const startIndex = currentIndex;
    const startY = startIndex * itemHeight;
    const endY = targetIndex * itemHeight;
    const startTime = performance.now();
    const duration = 350;

    function frame(now) {
      const elapsed = now - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const currentY = startY + (endY - startY) * eased;
      track.style.transform = 'translateY(-' + currentY + 'px)';

      if (progress < 1) {
        animId = requestAnimationFrame(frame);
      } else {
        currentIndex = targetIndex;
        isAnimating = false;
        scheduleNext();
      }
    }

    animId = requestAnimationFrame(frame);
  }

  function scheduleNext() {
    if (isAnimating) return;
    if (currentIndex >= count - 1) {
      setTimeout(function () {
        track.style.transition = 'none';
        track.style.transform = 'translateY(0)';
        currentIndex = 0;
        void track.offsetHeight;
        track.style.transition = '';
        setTimeout(scheduleNext, 50);
      }, 2000);
      return;
    }
    isAnimating = true;
    animateToTarget(currentIndex + 1);
  }

  scheduleNext();

  return {
    destroy: function () {
      if (animId) cancelAnimationFrame(animId);
    }
  };
}

// ========== TESTIMONIALS CAROUSEL ==========
(function () {
  var track = document.getElementById('testimonialsTrack');
  if (!track) return;

  var cards = track.querySelectorAll('.testimonial-card');
  var dotsContainer = document.querySelector('.testimonials__dots');
  var prevBtn = document.querySelector('.testimonials__arrow--prev');
  var nextBtn = document.querySelector('.testimonials__arrow--next');
  var cardCount = cards.length;
  if (cardCount === 0) return;

  var isDragging = false;
  var startX = 0;
  var scrollLeftStart = 0;
  var dragMoved = false;

  function getCardScrollLeft(index) {
    var card = cards[index];
    var trackRect = track.getBoundingClientRect();
    var cardRect = card.getBoundingClientRect();
    var gap = parseInt(getComputedStyle(track).gap) || 0;
    var paddingLeft = parseInt(getComputedStyle(track).paddingLeft) || 0;
    // Scroll so that the card aligns to the left padding
    return card.offsetLeft - paddingLeft;
  }

  function scrollToCard(index) {
    var target = getCardScrollLeft(index);
    track.scrollTo({ left: target, behavior: 'smooth' });
  }

  // Create dots
  for (var i = 0; i < cardCount; i++) {
    var dot = document.createElement('button');
    dot.className = 'testimonials__dot' + (i === 0 ? ' testimonials__dot--active' : '');
    dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
    dot.addEventListener('click', function (index) {
      return function () {
        scrollToCard(index);
      };
    }(i));
    dotsContainer.appendChild(dot);
  }

  function getActiveIndex() {
    var containerRect = track.getBoundingClientRect();
    var center = containerRect.left + containerRect.width / 2;
    var minDist = Infinity;
    var active = 0;
    for (var j = 0; j < cards.length; j++) {
      var rect = cards[j].getBoundingClientRect();
      var cardCenter = rect.left + rect.width / 2;
      var dist = Math.abs(cardCenter - center);
      if (dist < minDist) {
        minDist = dist;
        active = j;
      }
    }
    return active;
  }

  function updateDots() {
    var active = getActiveIndex();
    var dots = dotsContainer.querySelectorAll('.testimonials__dot');
    for (var k = 0; k < dots.length; k++) {
      dots[k].className = 'testimonials__dot' + (k === active ? ' testimonials__dot--active' : '');
    }
  }

  // Arrow buttons
  if (prevBtn) {
    prevBtn.addEventListener('click', function () {
      var active = getActiveIndex();
      var prev = (active - 1 + cardCount) % cardCount;
      scrollToCard(prev);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', function () {
      var active = getActiveIndex();
      var next = (active + 1) % cardCount;
      scrollToCard(next);
    });
  }

  // Scroll listener for dots only
  track.addEventListener('scroll', function () {
    updateDots();
  });

  // Mouse drag support
  track.addEventListener('mousedown', function (e) {
    isDragging = true;
    dragMoved = false;
    startX = e.pageX - track.offsetLeft;
    scrollLeftStart = track.scrollLeft;
    track.style.cursor = 'grabbing';
  });

  track.addEventListener('mousemove', function (e) {
    if (!isDragging) return;
    e.preventDefault();
    var x = e.pageX - track.offsetLeft;
    var walk = (x - startX) * 1.2;
    if (Math.abs(walk) > 3) dragMoved = true;
    track.scrollLeft = scrollLeftStart - walk;
  });

  document.addEventListener('mouseup', function () {
    if (!isDragging) return;
    isDragging = false;
    track.style.cursor = 'grab';
  });

  document.addEventListener('mouseleave', function () {
    if (isDragging) {
      isDragging = false;
      track.style.cursor = 'grab';
    }
  });

  // Touch support
  var touchStartX = 0;
  var touchScrollLeft = 0;

  track.addEventListener('touchstart', function (e) {
    touchStartX = e.touches[0].pageX - track.offsetLeft;
    touchScrollLeft = track.scrollLeft;
  }, { passive: true });

  track.addEventListener('touchmove', function (e) {
    var x = e.touches[0].pageX - track.offsetLeft;
    var walk = (x - touchStartX) * 1.2;
    track.scrollLeft = touchScrollLeft - walk;
  }, { passive: true });

  // Mouse wheel horizontal scroll
  track.addEventListener('wheel', function (e) {
    if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
      track.scrollLeft += e.deltaX;
    } else {
      track.scrollLeft += e.deltaY;
    }
    e.preventDefault();
  }, { passive: false });
})();

// ========== GLOBAL PRESENCE SCROLL REVEAL ==========
(function () {
  var globalSection = document.getElementById('global');
  if (!globalSection) return;

  globalSection.classList.add('global--enhanced');

  if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    globalSection.classList.add('global--visible');
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('global--visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.25, rootMargin: '0px 0px -40px 0px' });

  observer.observe(globalSection);
})();

// ========== WHY CHOOSE SCROLL REVEAL ==========
(function () {
  var section = document.querySelector('.why-choose');
  if (!section) return;

  var heading = section.querySelector('.why-choose__heading');
  if (heading && !heading.querySelector('.why-choose__word')) {
    var text = heading.textContent.trim();
    heading.setAttribute('aria-label', text);
    heading.innerHTML = text.split(/\s+/).map(function (word, i) {
      return '<span class="why-choose__word" style="transition-delay:' + (0.18 + i * 0.035) + 's">' + word + '</span>';
    }).join(' ');
  }

  if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    section.classList.add('is-visible');
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2, rootMargin: '0px 0px -10% 0px' });

  observer.observe(section);
})();

// ========== FEATURES SCROLL REVEAL ==========
(function () {
  var section = document.querySelector('.features');
  if (!section) return;

  if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    section.classList.add('is-visible');
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

  observer.observe(section);
})();

// ========== HERO PAPERS SHUFFLE ==========
(function () {
  var stack = document.querySelector('.js-papers-stack');
  if (!stack) return;

  var papers = Array.prototype.slice.call(stack.querySelectorAll('.paper[data-pos]'));
  if (papers.length < 2) return;

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var busy = false;
  var intervalMs = 3200;

  function shuffle() {
    if (busy || document.hidden) return;
    busy = true;

    var front = papers.find(function (p) {
      return p.getAttribute('data-pos') === '0';
    });

    if (front) {
      front.classList.add('is-shuffling-out');
    }

    window.setTimeout(function () {
      papers.forEach(function (paper) {
        var pos = parseInt(paper.getAttribute('data-pos'), 10);
        var next = (pos - 1 + papers.length) % papers.length;
        paper.setAttribute('data-pos', String(next));
      });

      if (front) {
        // Let the new position transition settle, then clear lift class
        window.requestAnimationFrame(function () {
          front.classList.remove('is-shuffling-out');
        });
      }

      window.setTimeout(function () {
        busy = false;
      }, 780);
    }, 420);
  }

  var timer = window.setInterval(shuffle, intervalMs);

  stack.addEventListener('mouseenter', function () {
    window.clearInterval(timer);
  });

  stack.addEventListener('mouseleave', function () {
    timer = window.setInterval(shuffle, intervalMs);
  });

  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      window.clearInterval(timer);
    } else {
      window.clearInterval(timer);
      timer = window.setInterval(shuffle, intervalMs);
    }
  });
})();

// ========== STAT COUNT-UP (continuous, all pages) ==========
(function () {
  var cards = Array.prototype.slice.call(document.querySelectorAll('.js-stats-card'));
  if (!cards.length) {
    cards = Array.prototype.slice.call(document.querySelectorAll('.js-count-up')).map(function (el) {
      return el.closest('.js-stats-card') || el.parentElement;
    }).filter(Boolean);
  }
  if (!cards.length) return;

  // Unique parents
  cards = cards.filter(function (card, i, arr) {
    return arr.indexOf(card) === i;
  });

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var HOLD_MS = 1800;
  var activeLoops = new WeakMap();

  function formatValue(value, decimals) {
    if (decimals > 0) return value.toFixed(decimals);
    return String(Math.round(value));
  }

  function runOnce(el, onDone, delay) {
    var target = parseFloat(el.getAttribute('data-count') || '0');
    var suffix = el.getAttribute('data-suffix') || '';
    var decimals = (String(el.getAttribute('data-count') || '').split('.')[1] || '').length;
    var duration = Math.min(2400, 1000 + Math.max(target, 1) * 0.6);

    function start() {
      if (reduceMotion || !('requestAnimationFrame' in window) || target <= 0) {
        el.classList.add('is-sliding');
        el.textContent = formatValue(target, decimals) + suffix;
        if (onDone) onDone();
        return;
      }

      // Reset slide, then animate up with count
      el.classList.remove('is-sliding');
      void el.offsetWidth;
      el.textContent = formatValue(0, decimals) + suffix;
      el.classList.add('is-sliding');

      var startTime = null;

      function tick(now) {
        if (startTime === null) startTime = now;
        var progress = Math.min((now - startTime) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = formatValue(target * eased, decimals) + suffix;
        if (progress < 1) {
          window.requestAnimationFrame(tick);
        } else {
          el.textContent = formatValue(target, decimals) + suffix;
          if (onDone) onDone();
        }
      }

      window.requestAnimationFrame(tick);
    }

    if (delay) {
      window.setTimeout(start, delay);
    } else {
      start();
    }
  }

  function startLoop(card) {
    if (activeLoops.get(card)) return;
    var counters = Array.prototype.slice.call(card.querySelectorAll('.js-count-up'));
    if (!counters.length) return;

    var state = { running: true, timer: null };
    activeLoops.set(card, state);
    card.classList.add('is-inview');

    function cycle() {
      if (!state.running || document.hidden) return;

      var pending = counters.length;
      counters.forEach(function (el, index) {
        runOnce(el, function () {
          pending -= 1;
          if (pending === 0 && state.running) {
            state.timer = window.setTimeout(function () {
              if (!state.running) return;
              // Drop down briefly before next loop
              counters.forEach(function (c) {
                c.classList.remove('is-sliding');
              });
              state.timer = window.setTimeout(cycle, 220);
            }, HOLD_MS);
          }
        }, index * 120);
      });
    }

    cycle();
  }

  function stopLoop(card) {
    var state = activeLoops.get(card);
    if (!state) return;
    state.running = false;
    if (state.timer) window.clearTimeout(state.timer);
    activeLoops.delete(card);
    card.classList.remove('is-inview');
    card.querySelectorAll('.js-count-up').forEach(function (el) {
      el.classList.remove('is-sliding');
    });
  }

  if (reduceMotion) {
    cards.forEach(function (card) {
      card.querySelectorAll('.js-count-up').forEach(function (el) {
        var target = el.getAttribute('data-count') || '0';
        var suffix = el.getAttribute('data-suffix') || '';
        el.textContent = target + suffix;
      });
    });
    return;
  }

  if (!('IntersectionObserver' in window)) {
    cards.forEach(startLoop);
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        startLoop(entry.target);
      } else {
        stopLoop(entry.target);
      }
    });
  }, { threshold: 0.25 });

  cards.forEach(function (card) {
    observer.observe(card);
  });

  document.addEventListener('visibilitychange', function () {
    cards.forEach(function (card) {
      if (document.hidden) {
        stopLoop(card);
        return;
      }
      var rect = card.getBoundingClientRect();
      var inView = rect.top < window.innerHeight && rect.bottom > 0;
      if (inView) startLoop(card);
    });
  });
})();

// ========== CONSULT FORM: country code + states ==========
(function () {
  function parseCountries(form) {
    var raw = form.getAttribute('data-countries') || form.dataset.countries || '{}';
    try {
      var parsed = JSON.parse(raw);
      return parsed && typeof parsed === 'object' ? parsed : {};
    } catch (e) {
      console.warn('Whizseed: failed to parse countries data', e);
      return {};
    }
  }

  function fillStates(select, states, preferred, placeholderText) {
    if (!select) return;
    var current = preferred || '';
    select.innerHTML = '';
    var placeholder = document.createElement('option');
    placeholder.value = '';
    placeholder.textContent = placeholderText || 'Select State / Region';
    select.appendChild(placeholder);

    (states || []).forEach(function (name) {
      var opt = document.createElement('option');
      opt.value = name;
      opt.textContent = name;
      if (name === current) opt.selected = true;
      select.appendChild(opt);
    });

    if (!select.value) {
      select.selectedIndex = 0;
    }
  }

  function syncCountry(form, resetState) {
    var countrySelect = form.querySelector('.js-country-select');
    var dialInput = form.querySelector('.js-country-dial');
    var stateSelect = form.querySelector('.js-state-select');
    var mobileInput = form.querySelector('.js-mobile-input');
    if (!countrySelect) return;

    var countries = parseCountries(form);
    var iso = countrySelect.value;
    var meta = countries[iso] || {};
    var selectedOption = countrySelect.options[countrySelect.selectedIndex];
    var dial = meta.dial != null
      ? String(meta.dial)
      : (selectedOption ? (selectedOption.getAttribute('data-dial') || '') : '');

    if (dialInput) dialInput.value = dial;

    var preferredState = resetState ? '' : (stateSelect ? stateSelect.value : '');
    var states = Array.isArray(meta.states) && meta.states.length
      ? meta.states
      : ['Nationwide / Other'];
    fillStates(stateSelect, states, preferredState, form.getAttribute('data-state-placeholder'));

    if (mobileInput) {
      if (iso === 'IN') {
        mobileInput.setAttribute('maxlength', '10');
        mobileInput.setAttribute('pattern', '[0-9]{10}');
        mobileInput.placeholder = '10-digit Mobile Number';
      } else {
        mobileInput.setAttribute('maxlength', '15');
        mobileInput.setAttribute('pattern', '[0-9]{6,15}');
        mobileInput.placeholder = 'Mobile Number';
      }
    }
  }

  function bindConsultForms(root) {
    (root || document).querySelectorAll('.js-consult-form').forEach(function (form) {
      if (form.dataset.countryBound === '1') return;
      var countrySelect = form.querySelector('.js-country-select');
      if (!countrySelect) return;

      form.dataset.countryBound = '1';
      syncCountry(form, false);

      countrySelect.addEventListener('change', function () {
        syncCountry(form, true);
      });
    });
  }

  bindConsultForms(document);

  // Re-bind when consult modal opens (in case form was injected later)
  document.addEventListener('click', function (e) {
    if (e.target.closest('.js-open-consult')) {
      setTimeout(function () { bindConsultForms(document); }, 0);
    }
  });

  window.WhizConsultCountry = { bind: bindConsultForms, sync: syncCountry };
})();

// ========== CONSULT POPUP (Get Started) ==========
(function () {
  var modal = document.getElementById('consultModal');
  if (!modal) return;

  var dialog = modal.querySelector('.consult-modal__dialog');
  var slugInput = modal.querySelector('.js-modal-service-slug');
  var lastFocus = null;

  function openModal(opts) {
    opts = opts || {};
    lastFocus = document.activeElement;
    if (slugInput) {
      slugInput.value = opts.serviceSlug || '';
    }
    modal.hidden = false;
    document.body.classList.add('consult-modal-open');
    var focusEl = modal.querySelector('input[name="name"]');
    if (focusEl) focusEl.focus();
  }

  function closeModal() {
    modal.hidden = true;
    document.body.classList.remove('consult-modal-open');
    if (lastFocus && typeof lastFocus.focus === 'function') {
      lastFocus.focus();
    }
  }

  document.addEventListener('click', function (e) {
    var trigger = e.target.closest('.js-open-consult');
    if (trigger) {
      e.preventDefault();
      openModal({
        serviceSlug: trigger.getAttribute('data-service') || ''
      });
      return;
    }

    if (e.target.closest('.js-consult-close')) {
      e.preventDefault();
      closeModal();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.hidden) {
      closeModal();
    }
  });

  // Re-open after validation errors / success from popup submit
  if (modal.getAttribute('data-auto-open') === '1' || window.location.hash === '#consult') {
    openModal();
  }

  window.WhizConsultModal = { open: openModal, close: closeModal };
})();

// ========== LANGUAGE SELECTOR ==========
(function () {
  var root = document.querySelector('.js-lang-selector');
  if (!root) return;

  var btn = root.querySelector('.lang-selector__btn');
  var menu = root.querySelector('.lang-selector__menu');
  if (!btn || !menu) return;

  function closeMenu() {
    menu.hidden = true;
    root.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
  }

  function openMenu() {
    menu.hidden = false;
    root.classList.add('is-open');
    btn.setAttribute('aria-expanded', 'true');
  }

  function setGoogTransCookie(locale) {
    var value = locale === 'hi' ? '/en/hi' : '/en/en';
    var maxAge = 60 * 60 * 24 * 365;
    // Clear then set (Google may use host-prefixed cookies)
    document.cookie = 'googtrans=;path=/;max-age=0';
    document.cookie = 'googtrans=;path=/;domain=' + location.hostname + ';max-age=0';
    document.cookie = 'googtrans=;path=/;domain=.' + location.hostname + ';max-age=0';
    if (locale === 'hi') {
      document.cookie = 'googtrans=' + value + ';path=/;max-age=' + maxAge;
      try {
        document.cookie = 'googtrans=' + value + ';path=/;domain=.' + location.hostname + ';max-age=' + maxAge;
      } catch (e) {}
    }
  }

  btn.addEventListener('click', function (e) {
    e.stopPropagation();
    if (menu.hidden) openMenu();
    else closeMenu();
  });

  menu.querySelectorAll('a[data-locale]').forEach(function (link) {
    link.addEventListener('click', function () {
      setGoogTransCookie(link.getAttribute('data-locale'));
    });
  });

  document.addEventListener('click', function (e) {
    if (!root.contains(e.target)) closeMenu();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeMenu();
  });
})();

// ========== SERVICES SECTION IMAGE HOVER ==========
(function () {
  var imagesWrap = document.querySelector('.js-services-images');
  var list = document.querySelector('.js-services-list');
  if (!imagesWrap || !list) return;

  var images = Array.prototype.slice.call(imagesWrap.querySelectorAll('img[data-key]'));
  var items = Array.prototype.slice.call(list.querySelectorAll('.services__item[data-image]'));
  if (!images.length || !items.length) return;

  function showImage(key) {
    var targetKey = key || 'default';
    var found = false;
    images.forEach(function (img) {
      var active = img.getAttribute('data-key') === targetKey;
      img.classList.toggle('is-active', active);
      if (active) found = true;
    });
    if (!found) {
      images.forEach(function (img) {
        img.classList.toggle('is-active', img.getAttribute('data-key') === 'default');
      });
    }
  }

  items.forEach(function (item) {
    item.addEventListener('mouseenter', function () {
      items.forEach(function (el) { el.classList.remove('is-active'); });
      item.classList.add('is-active');
      showImage(item.getAttribute('data-image'));
    });

    item.addEventListener('focus', function () {
      items.forEach(function (el) { el.classList.remove('is-active'); });
      item.classList.add('is-active');
      showImage(item.getAttribute('data-image'));
    });
  });

  list.addEventListener('mouseleave', function () {
    items.forEach(function (el) { el.classList.remove('is-active'); });
    showImage('default');
  });
})();
