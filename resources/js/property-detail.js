// Seleksi semua elemen dengan class 'openGalleryDesktop1' dan tambahkan event listener untuk membuka galeri
document.querySelectorAll('.openGalleryDesktop1').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('galleryModalDesktop').classList.remove('hidden');
    });
});

// Event listener untuk tombol 'Galeri Foto' di mobile (jika ada)
document.getElementById('openGalleryDesktop2').addEventListener('click', function() {
    document.getElementById('galleryModalDesktop').classList.remove('hidden');
});

// Event listener untuk tombol 'X' untuk menutup modal galeri
document.getElementById('closeGalleryDesktop').addEventListener('click', function() {
    document.getElementById('galleryModalDesktop').classList.add('hidden');
});

// Seleksi semua thumbnail di modal galeri
const thumbnails = document.querySelectorAll('#galleryModalDesktop .grid-cols-5 img');
const featuredImage = document.getElementById('featuredImage');

// Tambahkan event listener untuk setiap thumbnail
thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        // Ambil URL dari atribut src dan set sebagai gambar utama
        const newSrc = thumbnail.getAttribute('src');
        featuredImage.src = newSrc;
    });
});


// share property
// Ambil elemen-elemen yang diperlukan
const openSharePopup = document.getElementById('open-share-popup');
const closeSharePopup = document.getElementById('close-share-popup');
const sharePopup = document.getElementById('share-popup');
const copyLinkButton = document.getElementById('copy-link');

// Fungsi untuk membuka pop-up
openSharePopup.addEventListener('click', () => {
    sharePopup.classList.remove('hidden');
});

// Fungsi untuk menutup pop-up
closeSharePopup.addEventListener('click', () => {
    sharePopup.classList.add('hidden');
});

// Fungsi untuk menyalin link
copyLinkButton.addEventListener('click', () => {
    // Salin URL saat ini ke clipboard
    const link = "{{ url()->current() }}";
    navigator.clipboard.writeText(link)
        .then(() => {
            alert('Link telah disalin ke clipboard!');
        })
        .catch(err => {
            console.error('Gagal menyalin link:', err);
        });
});

// Menutup popup ketika mengklik di luar popup
window.addEventListener('click', (e) => {
    if (e.target === sharePopup) {
        sharePopup.classList.add('hidden');
    }
});
