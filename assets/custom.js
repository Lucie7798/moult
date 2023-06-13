document.addEventListener('DOMContentLoaded', function () {
    const sleeveMenuButton = document.getElementById('sleeve-menu-button');
    const sleeveOptionsMenu = document.getElementById('sleeve-options-menu');
    const selectedSleeveOption = document.getElementById('selected-sleeve-option');
    const selectedSleeveThumbnail = document.getElementById('selected-sleeve-thumbnail');
    const clearSleeveSelectionButton = document.getElementById('clear-sleeve-selection');

    if (sleeveMenuButton && sleeveOptionsMenu && selectedSleeveOption && selectedSleeveThumbnail && clearSleeveSelectionButton) {
        sleeveMenuButton.addEventListener('click', () => sleeveOptionsMenu.classList.toggle('invisible'));

        sleeveOptionsMenu.addEventListener('click', event => {
            if (event.target.classList.contains('sleeve-option-item')) {
                const selectedOption = event.target;
                const imageUrl = selectedOption.dataset.imgSrc;

                selectedSleeveThumbnail.src = imageUrl;
                selectedSleeveThumbnail.style.display = 'inline-block';

                selectedSleeveOption.textContent = selectedOption.textContent;
                sleeveOptionsMenu.classList.add('invisible');
            }
        });

        clearSleeveSelectionButton.addEventListener('click', () => {
            selectedSleeveOption.textContent = '-- Sélectionnez une option de manche --';
            selectedSleeveThumbnail.src = '';
            selectedSleeveThumbnail.style.display = 'none';
        });

        document.addEventListener('click', event => {
            if (!sleeveMenuButton.contains(event.target) && !sleeveOptionsMenu.contains(event.target)) {
                sleeveOptionsMenu.classList.add('invisible');
            }
        });
    }

    const thumbnailImagesContainer = document.getElementById('thumbnail-images-container');
    if (thumbnailImagesContainer) {
        thumbnailImagesContainer.addEventListener('click', event => {
            if (event.target.classList.contains('product-thumbnail')) {
                changeMainImage(event.target);
            }
        });
    }

    const colorPicker = document.getElementById('color-picker');
    const colorPreview = document.getElementById('color-preview');

    if (colorPicker && colorPreview) {
        // Écouter les changements de couleur sélectionnée
        colorPicker.addEventListener('input', function () {
            const selectedColor = colorPicker.value;
            colorPreview.style.backgroundColor = selectedColor;
        });

        // Initialiser la couleur prévisualisée
        const initialColor = colorPicker.value;
        colorPreview.style.backgroundColor = initialColor;
    }
});

function changeMainImage(imageElement) {
    console.log('changeMainImage called with', imageElement);
    const mainImageElement = document.getElementById('main-product-image');
    mainImageElement.src = imageElement.dataset.largeImage;
}

// Fonction de changement de couleur principale
function changeMainColor(color) {
    console.log('changeMainColor called with', color);
    // Le reste du code pour changer la couleur principale du site
}
