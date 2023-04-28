// Code pour gérer l'ouverture et la fermeture du menu déroulant de la navbar sur mobile
document.addEventListener('DOMContentLoaded', function () {
    const openMobileMenu = document.getElementById('open-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu-2');
    const closeMobileMenu = document.getElementById('close-mobile-menu');
    const menuToggler = document.getElementById('menu-toggler');

    openMobileMenu.addEventListener('click', function () {
        mobileMenu.classList.remove('hidden');
        menuToggler.classList.add('fixed', 'inset-0', 'z-10');
        openMobileMenu.classList.add('hidden');
        closeMobileMenu.classList.remove('hidden');
    });

    closeMobileMenu.addEventListener('click', function () {
        mobileMenu.classList.add('hidden');
        menuToggler.classList.remove('fixed', 'inset-0', 'z-10');
        openMobileMenu.classList.remove('hidden');
        closeMobileMenu.classList.add('hidden');
    });
});




