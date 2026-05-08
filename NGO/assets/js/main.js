// Navigation Scroll Effect
window.addEventListener('scroll', function () {
    const nav = document.getElementById('main-nav');
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
});

// Mobile Menu Toggle (To be implemented)
const mobileToggle = document.querySelector('.mobile-menu-toggle');
if (mobileToggle) {
    mobileToggle.addEventListener('click', () => {
        // Implementation for mobile menu
    });
}

// Newsletter Form Submission (Mockup)
const newsletterForm = document.getElementById('newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const email = this.querySelector('input').value;
        alert('Thank you for subscribing with: ' + email);
        this.reset();
    });
}

// Animation on Scroll (Basic implementation)
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Select elements to animate
// document.querySelectorAll('.program-card, .stat-item').forEach(el => {
//     el.style.opacity = '0';
//     el.style.transform = 'translateY(20px)';
//     el.style.transition = 'all 0.6s ease-out';
//     observer.observe(el);
// });
