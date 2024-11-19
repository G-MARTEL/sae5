document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('success-popup');

    if (popup) {
        console.log('Pop-up trouvée'); 
        popup.classList.add('show');

        setTimeout(() => {
            popup.classList.remove('show');
        }, 1500); 
    }
});

