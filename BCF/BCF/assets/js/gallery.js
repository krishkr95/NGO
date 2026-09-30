/**
 * Bhopal Cares Forum (BCF) - Gallery & Stories Engine
 * FR-5: Instagram-style Story Highlights & Filterable Masonry Lightbox
 */

(function () {
  'use strict';

  /* ==========================================================================
     1. Instagram Highlight Stories Engine (FR-5.1 & FR-5.2)
     ========================================================================== */
  const storiesData = [
    {
      id: 'bts',
      title: 'BCF-BTS',
      author: 'BCF Core Team',
      time: 'Sunday Behind the Scenes',
      avatar: 'assets/images/bcf_logo.jpeg',
      slides: [
        {
          img: 'assets/images/drives/team-hero-sunset.jpg',
          caption: 'Early morning prep at VIP Road Upper Lake. Volunteers loading safety gloves, jute bags, and sorting bins.'
        },
        {
          img: 'assets/images/drives/lake-cleanup-hero.jpg',
          caption: 'Misty sunrise clean-up in full swing! Segregating PET bottles, styrofoam, and microplastics.'
        }
      ]
    },
    {
      id: 'mvp',
      title: 'MVP',
      author: 'Priya Sharma',
      time: 'Volunteer of the Month',
      slides: [
        {
          img: 'assets/images/drives/volunteer-priya-mvp.jpg',
          caption: 'Meet Priya! 24 consecutive Sunday clean-up drives, spearheading our indigenous nursery initiative.'
        },
        {
          img: 'assets/images/drives/tree-plantation-miyawaki.jpg',
          caption: 'Priya teaching first-time student volunteers how to create organic compost circles around young saplings.'
        }
      ]
    },
    {
      id: 'upharam',
      title: 'Upharam',
      author: 'Project Upharam',
      time: 'Community Joy Drive',
      slides: [
        {
          img: 'assets/images/drives/upharam-donation.jpg',
          caption: 'Project Upharam in action: distributing 1,100+ warm winter sweaters, school bags, and stationery kits.'
        },
        {
          img: 'assets/images/drives/team-hero-sunset.jpg',
          caption: 'Empowering children and creating smiles across informal settlements near Bhopal peripheral areas.'
        }
      ]
    },
    {
      id: 'seedballs',
      title: 'Seed Balls',
      author: 'Afforestation Wing',
      time: 'Monsoon Green Belt',
      slides: [
        {
          img: 'assets/images/drives/seed-balls-ridges.jpg',
          caption: 'Rolling 4,495 clay seed balls infused with native neem, peepal, and amaltas seeds ready for rocky ridge throwing.'
        },
        {
          img: 'assets/images/drives/tree-plantation-miyawaki.jpg',
          caption: 'Miyawaki urban forest thriving with 92% survival rate after 18 months of rigorous care.'
        }
      ]
    }
  ];

  let currentStoryIndex = 0;
  let currentSlideIndex = 0;
  let storyTimer = null;
  const SLIDE_DURATION = 4500; // 4.5s per slide

  const storyModal = document.getElementById('storyModal');
  const storyProgressContainer = document.getElementById('storyProgressBar');
  const storyAuthorAvatar = document.getElementById('storyAuthorAvatar');
  const storyAuthorName = document.getElementById('storyAuthorName');
  const storyAuthorTime = document.getElementById('storyAuthorTime');
  const storyMediaImg = document.getElementById('storyMediaImg');
  const storyCaptionText = document.getElementById('storyCaptionText');
  const storyCloseBtn = document.getElementById('storyCloseBtn');
  const storyTapPrev = document.getElementById('storyTapPrev');
  const storyTapNext = document.getElementById('storyTapNext');

  function openStory(storyId) {
    const idx = storiesData.findIndex(s => s.id === storyId);
    if (idx === -1) return;

    currentStoryIndex = idx;
    currentSlideIndex = 0;

    // Mark bubble as viewed
    const bubble = document.querySelector(`[data-story-id="${storyId}"]`);
    if (bubble) bubble.classList.add('viewed');

    if (storyModal) {
      storyModal.classList.add('active');
      document.body.style.overflow = 'hidden';
      renderCurrentSlide();
    }
  }

  function closeStory() {
    if (storyTimer) clearTimeout(storyTimer);
    if (storyModal) {
      storyModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function renderCurrentSlide() {
    if (storyTimer) clearTimeout(storyTimer);

    const story = storiesData[currentStoryIndex];
    if (!story) return closeStory();

    const slide = story.slides[currentSlideIndex];
    if (!slide) return closeStory();

    // Render progress indicators
    if (storyProgressContainer) {
      storyProgressContainer.innerHTML = '';
      story.slides.forEach((_, idx) => {
        const seg = document.createElement('div');
        seg.className = 'story-progress-segment';
        if (idx < currentSlideIndex) {
          seg.classList.add('completed');
        } else if (idx === currentSlideIndex) {
          seg.classList.add('active');
        }
        const fill = document.createElement('div');
        fill.className = 'story-progress-fill';
        if (idx === currentSlideIndex) {
          fill.style.transition = `width ${SLIDE_DURATION}ms linear`;
          setTimeout(() => { fill.style.width = '100%'; }, 20);
        }
        seg.appendChild(fill);
        storyProgressContainer.appendChild(seg);
      });
    }

    // Set content
    if (storyAuthorName) storyAuthorName.textContent = story.author;
    if (storyAuthorTime) storyAuthorTime.textContent = story.time;
    if (storyAuthorAvatar) storyAuthorAvatar.src = story.avatar || slide.img;
    if (storyMediaImg) {
      storyMediaImg.src = slide.img;
      storyMediaImg.alt = slide.caption;
    }
    if (storyCaptionText) storyCaptionText.textContent = slide.caption;

    // Auto advance
    storyTimer = setTimeout(() => {
      nextStorySlide();
    }, SLIDE_DURATION);
  }

  function nextStorySlide() {
    const story = storiesData[currentStoryIndex];
    if (currentSlideIndex < story.slides.length - 1) {
      currentSlideIndex++;
      renderCurrentSlide();
    } else {
      // Go to next story or close
      if (currentStoryIndex < storiesData.length - 1) {
        currentStoryIndex++;
        currentSlideIndex = 0;
        renderCurrentSlide();
      } else {
        closeStory();
      }
    }
  }

  function prevStorySlide() {
    if (currentSlideIndex > 0) {
      currentSlideIndex--;
      renderCurrentSlide();
    } else {
      if (currentStoryIndex > 0) {
        currentStoryIndex--;
        currentSlideIndex = storiesData[currentStoryIndex].slides.length - 1;
        renderCurrentSlide();
      }
    }
  }

  function initStories() {
    const storyBubbles = document.querySelectorAll('[data-story-id]');
    storyBubbles.forEach(bubble => {
      bubble.addEventListener('click', () => {
        const storyId = bubble.getAttribute('data-story-id');
        openStory(storyId);
      });
    });

    if (storyCloseBtn) storyCloseBtn.addEventListener('click', closeStory);
    if (storyTapPrev) storyTapPrev.addEventListener('click', prevStorySlide);
    if (storyTapNext) storyTapNext.addEventListener('click', nextStorySlide);

    if (storyModal) {
      storyModal.addEventListener('click', (e) => {
        if (e.target === storyModal) closeStory();
      });
    }
  }

  /* ==========================================================================
     2. Filterable Masonry Gallery & Lightbox (FR-5.3)
     ========================================================================== */
  const galleryItemsData = [
    {
      img: 'assets/images/drives/lake-cleanup-hero.jpg',
      category: 'cleanups',
      title: 'Upper Lake Waterfront Cleanup',
      location: 'VIP Road, Bhopal',
      date: 'Weekend Drive #154'
    },
    {
      img: 'assets/images/drives/tree-plantation-miyawaki.jpg',
      category: 'afforestation',
      title: 'Dense Miyawaki Plantation',
      location: 'Arera Urban Patch',
      date: 'Native Saplings Drive'
    },
    {
      img: 'assets/images/drives/seed-balls-ridges.jpg',
      category: 'afforestation',
      title: '4,495 Clay Seed Balls Throwing',
      location: 'Tekri Ridge Slopes',
      date: 'Pre-Monsoon Drive'
    },
    {
      img: 'assets/images/drives/upharam-donation.jpg',
      category: 'drives',
      title: 'Project Upharam Distribution',
      location: 'Govt School Bhopal',
      date: 'Winter Warmth & Study Kits'
    },
    {
      img: 'assets/images/drives/team-hero-sunset.jpg',
      category: 'drives',
      title: 'Sunday Morning Volunteer Squad',
      location: 'Upper Lake Pier',
      date: '920+ Grassroots Members'
    },
    {
      img: 'assets/images/drives/volunteer-priya-mvp.jpg',
      category: 'cleanups',
      title: 'Volunteer of the Month Recognition',
      location: 'Bhopal Lakes Sanctuary',
      date: 'Community Leadership'
    }
  ];

  let currentLightboxIndex = 0;
  let activeFilterList = [...galleryItemsData];

  const lightboxModal = document.getElementById('lightboxModal');
  const lightboxImg = document.getElementById('lightboxImg');
  const lightboxCaption = document.getElementById('lightboxCaption');
  const lightboxCloseBtn = document.getElementById('lightboxCloseBtn');
  const lightboxPrevBtn = document.getElementById('lightboxPrevBtn');
  const lightboxNextBtn = document.getElementById('lightboxNextBtn');

  function openLightbox(index) {
    currentLightboxIndex = index;
    const item = activeFilterList[currentLightboxIndex];
    if (!item || !lightboxModal) return;

    lightboxImg.src = item.img;
    lightboxImg.alt = item.title;
    lightboxCaption.innerHTML = `<strong>${item.title}</strong> — ${item.location} (${item.date})`;
    lightboxModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    if (lightboxModal) {
      lightboxModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function nextLightbox() {
    currentLightboxIndex = (currentLightboxIndex + 1) % activeFilterList.length;
    openLightbox(currentLightboxIndex);
  }

  function prevLightbox() {
    currentLightboxIndex = (currentLightboxIndex - 1 + activeFilterList.length) % activeFilterList.length;
    openLightbox(currentLightboxIndex);
  }

  function initGalleryFilter() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        filterTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const filter = tab.getAttribute('data-filter');

        galleryItems.forEach(item => {
          const itemCat = item.getAttribute('data-category');
          if (filter === 'all' || itemCat === filter) {
            item.style.display = 'block';
            setTimeout(() => {
              item.style.opacity = '1';
              item.style.transform = 'scale(1)';
            }, 50);
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.95)';
            setTimeout(() => {
              item.style.display = 'none';
            }, 250);
          }
        });

        // Recompute active lightbox list
        if (filter === 'all') {
          activeFilterList = [...galleryItemsData];
        } else {
          activeFilterList = galleryItemsData.filter(d => d.category === filter);
        }
      });
    });

    // Lightbox triggers on gallery items
    galleryItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        const itemImgSrc = item.querySelector('img').getAttribute('src');
        const matchIdx = activeFilterList.findIndex(d => d.img === itemImgSrc);
        openLightbox(matchIdx !== -1 ? matchIdx : 0);
      });
    });

    if (lightboxCloseBtn) lightboxCloseBtn.addEventListener('click', closeLightbox);
    if (lightboxPrevBtn) lightboxPrevBtn.addEventListener('click', prevLightbox);
    if (lightboxNextBtn) lightboxNextBtn.addEventListener('click', nextLightbox);

    if (lightboxModal) {
      lightboxModal.addEventListener('click', (e) => {
        if (e.target === lightboxModal || e.target.classList.contains('lightbox-container')) {
          closeLightbox();
        }
      });
    }

    // Global keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeStory();
        closeLightbox();
      }
      if (lightboxModal && lightboxModal.classList.contains('active')) {
        if (e.key === 'ArrowRight') nextLightbox();
        if (e.key === 'ArrowLeft') prevLightbox();
      }
    });
  }

  function init() {
    initStories();
    initGalleryFilter();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  window.BCFGallery = { openStory, closeStory, openLightbox, closeLightbox };
})();
