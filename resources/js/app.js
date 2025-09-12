import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Transparency Page Enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Copy to clipboard function
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            toast.textContent = 'Link berhasil disalin!';
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    };

    // Enhanced search functionality
    const searchForm = document.querySelector('form[action*="transparency"]');
    if (searchForm) {
        const searchInput = searchForm.querySelector('input[name="search"]');
        const categorySelect = searchForm.querySelector('select[name="category"]');
        const typeSelect = searchForm.querySelector('select[name="type"]');
        const yearSelect = searchForm.querySelector('select[name="year"]');
        
        // Auto-submit on filter change
        [categorySelect, typeSelect, yearSelect].forEach(select => {
            if (select) {
                select.addEventListener('change', function() {
                    searchForm.submit();
                });
            }
        });
        
        // Search suggestions (if needed)
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                // Add debounced search suggestions here if needed
            });
        }
    }

    // Animate statistics cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
                
                // Animate numbers
                const numberElement = entry.target.querySelector('[data-count]');
                if (numberElement) {
                    animateNumber(numberElement);
                }
            }
        });
    }, observerOptions);

    // Observe statistics cards
    document.querySelectorAll('.stats-card, .bg-white.rounded-xl.shadow-lg').forEach(card => {
        observer.observe(card);
    });

    // Number animation function
    function animateNumber(element) {
        const target = parseInt(element.getAttribute('data-count') || element.textContent.replace(/[^0-9]/g, ''));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format number with commas
            element.textContent = Math.floor(current).toLocaleString('id-ID');
        }, 16);
    }

    // Enhanced mobile dropdown functionality
    document.querySelectorAll('.mobile-dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            if (dropdown) {
                dropdown.classList.toggle('hidden');
                
                // Rotate arrow icon
                const arrow = this.querySelector('svg:last-child');
                if (arrow) {
                    arrow.classList.toggle('rotate-180');
                }
            }
        });
    });

    // Add loading states for form submissions
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    });

    // Enhanced card hover effects
    document.querySelectorAll('.group').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Add custom CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: scale(1.02);
    }
    
    .loading-spinner {
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
