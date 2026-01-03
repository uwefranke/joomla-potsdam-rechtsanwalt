/**
 * Template JavaScript für Potsdam Rechtsanwalt
 * @version 2.0.0
 * Modernes JavaScript mit erweiterten Funktionen
 */

(function() {
    'use strict';

    // DOM Ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        initBackToTop();
        initMobileNavigation();
        initSmoothScrolling();
        initHeaderScroll();
        initFormValidation();
        initAnimations();
        initExternalLinks();
        
        console.log('Template JS geladen - Potsdam Rechtsanwalt v2.0');
    }

    /**
     * Back to Top Button Funktionalität
     */
    function initBackToTop() {
        const backToTopBtn = document.getElementById('backToTop');
        
        if (!backToTopBtn) return;
        
        // Zeige/Verstecke Button beim Scrollen
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.display = 'block';
                    backToTopBtn.style.opacity = '1';
                } else {
                    backToTopBtn.style.opacity = '0';
                    setTimeout(function() {
                        if (window.pageYOffset <= 300) {
                            backToTopBtn.style.display = 'none';
                        }
                    }, 300);
                }
            }, 100);
        }, { passive: true });
        
        // Scroll nach oben bei Klick
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Mobile Navigation Enhancement
     */
    function initMobileNavigation() {
        const navLinks = document.querySelectorAll('#mainNavigation a');
        const navCollapse = document.getElementById('mainNavigation');
        const navToggler = document.querySelector('.navbar-toggler');
        
        if (!navCollapse || !navToggler) return;
        
        // Prüfe ob Bootstrap verfügbar ist
        const hasBootstrap = typeof bootstrap !== 'undefined' && bootstrap.Collapse;
        
        // Initialisiere Bootstrap Collapse wenn verfügbar
        if (hasBootstrap) {
            new bootstrap.Collapse(navCollapse, {
                toggle: false
            });
        }
        
        // Fallback Toggle-Funktionalität
        if (!hasBootstrap) {
            navToggler.addEventListener('click', function(e) {
                e.preventDefault();
                navCollapse.classList.toggle('show');
                const isExpanded = navCollapse.classList.contains('show');
                navToggler.setAttribute('aria-expanded', isExpanded);
            });
        }
        
        // Auto-close nach Link-Klick auf Mobile
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768 && navCollapse.classList.contains('show')) {
                    if (hasBootstrap) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    } else {
                        // Fallback: manuell schließen
                        navCollapse.classList.remove('show');
                        navToggler.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        // Schließe Navigation beim Klick außerhalb
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                const isClickInsideNav = navCollapse.contains(event.target);
                const isClickOnToggler = navToggler.contains(event.target);
                
                if (!isClickInsideNav && !isClickOnToggler && navCollapse.classList.contains('show')) {
                    if (hasBootstrap) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    } else {
                        // Fallback: manuell schließen
                        navCollapse.classList.remove('show');
                        navToggler.setAttribute('aria-expanded', 'false');
                    }
                }
            }
        });
    };
                    }
                }
            }
        });
    }

    /**
     * Smooth Scrolling für alle internen Links
     */
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Ignoriere leere Hashes und Bootstrap-Elemente
                if (href === '#' || href.startsWith('#collapse') || href.startsWith('#modal')) {
                    return;
                }
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerOffset = 100;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Header Scroll Effect - Schatten beim Scrollen
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;
        let scrollTimeout;

        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                const currentScroll = window.pageYOffset;
                
                // Füge Schatten hinzu bei Scroll
                if (currentScroll > 50) {
                    header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                } else {
                    header.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
                }
                
                lastScroll = currentScroll;
            }, 50);
        }, { passive: true });
    }

    /**
     * Formular-Validierung Enhancement
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('form.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Scroll zum ersten fehlerhaften Feld
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
                
                form.classList.add('was-validated');
            }, false);
        });

        // Live-Validierung für E-Mail-Felder
        const emailInputs = document.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateEmail(this);
            });
        });

        // Live-Validierung für Telefon-Felder
        const telInputs = document.querySelectorAll('input[type="tel"]');
        telInputs.forEach(input => {
            input.addEventListener('input', function() {
                // Formatiere Telefonnummer während der Eingabe
                let value = this.value.replace(/\D/g, '');
                if (value.length > 0) {
                    this.value = formatPhoneNumber(value);
                }
            });
        });
    }

    /**
     * E-Mail Validierung
     */
    function validateEmail(input) {
        const email = input.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            input.setCustomValidity('Bitte geben Sie eine gültige E-Mail-Adresse ein.');
            input.classList.add('is-invalid');
        } else {
            input.setCustomValidity('');
            input.classList.remove('is-invalid');
        }
    }

    /**
     * Telefonnummer-Formatierung
     */
    function formatPhoneNumber(value) {
        // Einfache deutsche Telefonnummer-Formatierung
        if (value.length <= 3) return value;
        if (value.length <= 6) return value.slice(0, 3) + ' ' + value.slice(3);
        if (value.length <= 8) return value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
        return value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6, 8) + ' ' + value.slice(8, 10);
    }

    /**
     * Scroll-Animationen für Elemente
     */
    function initAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Beobachte Cards und Artikel
        const animatedElements = document.querySelectorAll('.card, article, .sidebar');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }

    /**
     * Externe Links in neuem Tab öffnen
     */
    function initExternalLinks() {
        const links = document.querySelectorAll('a[href^="http"]');
        const currentDomain = window.location.hostname;
        
        links.forEach(link => {
            const linkDomain = new URL(link.href).hostname;
            
            if (linkDomain !== currentDomain) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
                
                // Füge Icon für externe Links hinzu (optional)
                if (!link.querySelector('.external-icon')) {
                    const icon = document.createElement('i');
                    icon.className = 'bi bi-box-arrow-up-right ms-1 external-icon';
                    icon.style.fontSize = '0.8em';
                    link.appendChild(icon);
                }
            }
        });
    }

    // CSS für Animationen dynamisch hinzufügen
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

})();
