const rarityColors = {
    "Common": "#b0b0b0",
    "Rare": "#4a90d9",
    "Epic": "#9b59b6",
    "Legendary": "#f0a500",
};

const marketCards = document.querySelectorAll('.market-card');
marketCards.forEach((card) => {
    const detailLink = card.querySelector('a[href]');
    if (!detailLink) return;
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-4px)';
        card.style.transition = 'transform 0.2s ease';
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});

const priceRange = document.getElementById('max_price');
const priceValue = document.getElementById('price-value');
if (priceRange && priceValue) {
    priceRange.addEventListener('input', () => {
        priceValue.textContent = Number(priceRange.value).toLocaleString();
    });
}
