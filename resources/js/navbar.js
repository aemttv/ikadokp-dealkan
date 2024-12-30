// Function to add or remove background based on scroll position
function toggleBackgroundOnScroll() {
    const navBar = document.getElementById('navbar');

    // check current url
    const currentUrl = window.location.pathname;

    // condition to add or remove background
    if (currentUrl === '/property-baru/disewa' || currentUrl === '/property-baru/dijual' || currentUrl === '/kpr' || currentUrl === '/tentang' || currentUrl === '/login-page' || currentUrl.startsWith('/property-baru/secondary/')) {
        navBar.classList.add('bg-white', 'shadow-md'); // Pastikan background dan shadow selalu ada
    } else {
        if (window.scrollY > 50) { // if position is greater than 50
            navBar.classList.add('bg-white', 'shadow-md');
        } else {
            navBar.classList.remove('bg-white', 'shadow-md');
        }
    }
}




// Call the function on page load to check scroll position
window.addEventListener('load', function() {
    toggleBackgroundOnScroll(); // Cek posisi scroll saat halaman di-load
});

// Call the function on scroll event
window.addEventListener('scroll', function() {
    toggleBackgroundOnScroll(); // Tambahkan atau hilangkan background saat scroll
});
