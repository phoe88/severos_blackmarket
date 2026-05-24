const rarityColors = {
    "Common": "#b0b0b0",
    "Rare": "#4a90d9",
    "Epic": "#9b59b6",
    "Legendary": "#f0a500",
};

document.querySelectorAll('.carditem').forEach(function (carditem) {
    const rarity = carditem.dataset.rarity;
    const color = rarityColors[rarity] || "#fff";

    const gun = carditem.dataset.gun;
    const price = parseInt(carditem.dataset.price);

    carditem.addEventListener('mouseenter', function () {
        carditem.style.transform = 'scale(1.1)';
        carditem.style.transition = 'transform 0.3s ease';
        carditem.style.cursor = 'pointer';
    });

    carditem.addEventListener('mouseleave', function () {
        carditem.style.transform = 'scale(1)';
        carditem.style.transition = 'transform 0.3s ease';
        carditem.style.cursor = 'default';
    });

    carditem.addEventListener('click', function () {
        const existing = document.getElementById('black-background');
        if (existing) existing.remove();

        const confirmPurchase = document.createElement('div');
        confirmPurchase.innerHTML = `
            <div id="black-background">
                <div class="confirm-purchase">
                    <h1 id="confirm-title">Are you sure you want to purchase?</h1>
                    <span><h1 id="gun-name" style="color: ${color}">${gun}</h1></span>
                    <span id="confirm-text">for price</span>
                    <span id="gun-price">$${price.toLocaleString()}</span>
                    <div class="confirm-btns">
                        <button id="cancel-btn">Cancel</button>
                        <button id="confirm-btn">Confirm</button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(confirmPurchase);

        confirmPurchase.querySelector('#confirm-btn').addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = 'transaction.php';
        });

        confirmPurchase.querySelector('#cancel-btn').addEventListener('click', function (e) {
            e.preventDefault();
            confirmPurchase.remove();
        });
    });
});

// Filter checkbox
const filterCheckboxes = document.querySelectorAll('.checkbox-filter');

filterCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const checkedGuns = Array.from(filterCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.parentElement.textContent.trim());

        document.querySelectorAll('.carditem').forEach((card) => {
            const cardGun = card.dataset.gun;
            if (checkedGuns.length === 0 || checkedGuns.includes(cardGun)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});