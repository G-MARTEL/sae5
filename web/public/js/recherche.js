document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const gridItems = document.querySelectorAll('.grid-item');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();

        gridItems.forEach(item => {
            const title = item.getAttribute('data-title').toLowerCase();

            if (title.includes(searchText)) {
                item.style.display = ''; 
            } else {
                item.style.display = 'none'; 
            }
        });
    });
});
