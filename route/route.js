// Fungsi untuk memuat konten halaman berdasarkan URL
async function loadPage(url) {
    const contentDiv = document.getElementById('content'); // Pastikan ada elemen dengan id 'content' di index.html
    let file = '';

    switch(url) {
        case '/home':
        case '/':
            file = 'index.html';
            break;
        case '/about':
            file = 'about.html';
            break;
        case '/contact':
            file = 'contact.html';
            break;
        case '/service':
            file = 'service.html';
            break;
        case '/project':
            file = 'project.html';
            break;
        case '/team':
            file = 'team.html';
            break;
        case '/game':
            file = 'game.html';
            break;
        case '/testimonial':
            file = 'testimonial.html';
            break;
        default:
            file = '404.html'; // Halaman 404 jika rute tidak ditemukan
            break;
    }

    try {
        const response = await fetch(file);
        if (!response.ok) throw new Error('File tidak ditemukan');
        const htmlContent = await response.text();
        contentDiv.innerHTML = htmlContent;
    } catch (error) {
        contentDiv.innerHTML = `
            <h1>Error</h1>
            <p>Terjadi masalah saat memuat halaman.</p>
        `;
    }
}

// Fungsi untuk menangani navigasi
function navigateTo(url) {
    history.pushState(null, null, url);
    loadPage(url);
}

// Menangani tombol "back" dan "forward" di browser
window.onpopstate = () => {
    loadPage(window.location.pathname);
};

// Menambahkan event listener ke semua link dengan atribut data-link
document.querySelectorAll('a[data-link]').forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const url = event.target.getAttribute('data-link');
        navigateTo(url);
    });
});

// Memuat halaman berdasarkan URL saat halaman pertama kali dibuka
document.addEventListener('DOMContentLoaded', () => {
    loadPage(window.location.pathname);
});
