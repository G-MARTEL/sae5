const items = document.querySelectorAll('.carousel-item');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;

function showItem(index) {
    // Masquer tous les items et désactiver les points
    items.forEach(item => item.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    // Afficher l'élément correspondant et activer le point
    items[index].classList.add('active');
    dots[index].classList.add('active');
}

document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? items.length - 1 : currentIndex - 1;
    showItem(currentIndex);
});

document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex === items.length - 1) ? 0 : currentIndex + 1;
    showItem(currentIndex);
});

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentIndex = index;
        showItem(currentIndex);
    });
});

// Afficher le premier élément au démarrage
showItem(currentIndex);
