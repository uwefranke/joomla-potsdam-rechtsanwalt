/**
 * Template JavaScript für Potsdam Rechtsanwalt
 * @version 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    
    if (backToTopBtn) {
        // Zeige/Verstecke Button beim Scrollen
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
        
        // Scroll nach oben bei Klick
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Mobile Navigation - Auto-close nach Link-Klick
    const navLinks = document.querySelectorAll('#mainNavigation a');
    const navCollapse = document.getElementById('mainNavigation');
    
    if (navCollapse) {
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });
    }
    
    console.log('Template JS geladen - Potsdam Rechtsanwalt');
});
