const cards = document.querySelectorAll(
    '.playtime-card input[type="checkbox"]'
);
const rentButton = document.getElementById("rentButton");

cards.forEach((checkbox) => {
    checkbox.addEventListener("change", () => {
        const card = checkbox.closest(".playtime-card");

        if (checkbox.checked) {
            card.classList.add("selected");
        } else {
            card.classList.remove("selected");
        }

        // Enable Rent button if at least one checkbox is checked
        const anyChecked = Array.from(cards).some((c) => c.checked);
        rentButton.disabled = !anyChecked;
    });
});
