import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categorySelect');
    const newCategoryInput = document.getElementById('newCategoryInput');

    if (categorySelect && newCategoryInput) {
        categorySelect.addEventListener('change', function () {
            if (this.value === '__new') {
                newCategoryInput.classList.remove('hidden');
                newCategoryInput.focus();
            } else {
                newCategoryInput.classList.add('hidden');
                newCategoryInput.value = '';
            }
        });
    }
});
