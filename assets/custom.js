document.addEventListener('DOMContentLoaded', function () {
    const sleeveOptionsDropdownButton = document.getElementById('sleeveOptionsDropdownButton');
    const sleeveOptionsDropdownMenu = document.getElementById('sleeveOptionsDropdownMenu');

    if (sleeveOptionsDropdownButton && sleeveOptionsDropdownMenu) {
        sleeveOptionsDropdownButton.addEventListener('click', function () {
            sleeveOptionsDropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!sleeveOptionsDropdownButton.contains(event.target) && !sleeveOptionsDropdownMenu.contains(event.target)) {
                sleeveOptionsDropdownMenu.classList.add('hidden');
            }
        });
    }
});









