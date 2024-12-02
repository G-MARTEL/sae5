document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('editModal');

    // Vérifier si les éléments existent
    if (openModalBtn && closeModalBtn && modal) {
        openModalBtn.addEventListener('click', function() {
            modal.classList.add('active'); // Affiche la modale
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.remove('active'); // Cache la modale
        });

        // Fermer la modale si on clique en dehors de la modale
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('active'); // Cache la modale
            }
        });
    }
});
