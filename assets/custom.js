document.addEventListener('DOMContentLoaded', function () {
    var sleeveMenuButton = document.getElementById('sleeve-menu-button');
    var sleeveOptionsMenu = document.getElementById('sleeve-options-menu');
    var sleeveOptionItems = document.getElementsByClassName('sleeve-option-item');
    var selectedSleeveOption = document.getElementById('selected-sleeve-option');
    var selectedSleeveThumbnail = document.getElementById('selected-sleeve-thumbnail');
    var clearSleeveSelectionButton = document.getElementById('clear-sleeve-selection');

    sleeveMenuButton.addEventListener('click', function () {
        sleeveOptionsMenu.classList.toggle('hidden');
    });

    for (var i = 0; i < sleeveOptionItems.length; i++) {
        sleeveOptionItems[i].addEventListener('click', function (event) {
            var selectedOption = event.target;
            var imageUrl = selectedOption.getAttribute('data-img-src');

            // Mettre à jour la source de l'image et afficher la vignette
            selectedSleeveThumbnail.src = imageUrl;
            selectedSleeveThumbnail.style.display = 'inline-block';

            selectedSleeveOption.textContent = selectedOption.textContent;
            sleeveOptionsMenu.classList.add('hidden');
        });
    }

    clearSleeveSelectionButton.addEventListener('click', function () {
        selectedSleeveOption.textContent = '-- Sélectionnez une option de manche --';
        selectedSleeveThumbnail.src = '';
        selectedSleeveThumbnail.style.display = 'none';
    });

    // Fermer le menu déroulant lorsque l'utilisateur clique en dehors du menu
    document.addEventListener('click', function (event) {
        if (!sleeveMenuButton.contains(event.target) && !sleeveOptionsMenu.contains(event.target)) {
            sleeveOptionsMenu.classList.add('hidden');
        }
    });

    var buttonWidth = sleeveMenuButton.getBoundingClientRect().width;
    sleeveOptionsMenu.style.width = buttonWidth + 'px';
});

























