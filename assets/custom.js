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
});

function changeMainImage(imageElement) {
    console.log('changeMainImage called with', imageElement);
    const mainImageElement = document.getElementById('main-product-image');
    mainImageElement.src = imageElement.dataset.largeImage;
}

