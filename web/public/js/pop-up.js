document.addEventListener('DOMContentLoaded', () => {
    // Références aux éléments
    const openPopupBtn = document.getElementById('open-popup-btn');
    const popup = document.getElementById('pop-up');
    const closePopupBtn = document.getElementById('close-popup-btn');

    // Ouvrir la popup
    openPopupBtn.addEventListener('click', () => {
        popup.style.display = 'flex';
    });

    // Fermer la popup
    closePopupBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    // Fermer la popup lorsqu'on clique en dehors de son contenu
    window.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
});
