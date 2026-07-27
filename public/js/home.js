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
  }, { threshold: 0.35, rootMargin: '0px 0px -40px 0px' });

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
