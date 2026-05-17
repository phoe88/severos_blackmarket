const array = [
    { gun: "Desert Eagle 'Saint Edge'", rarity: "Epic", type: "Handgun", price: 6500 },
    { gun: "White Fang-465 'Artic Howl'", rarity: "Epic", type: "Assault Rifle", price: 142000 },
    { gun: "AR-73/223 'Urban Spectre'", rarity: "Rare", type: "Assault Rifle", price: 7900 },
    { gun: "L85A 'Divine Spectre'", rarity: "Epic", type: "Handgun", price: 6500 },
    { gun: "G11 'Caseless Edge'", rarity: "Epic", type: "Handgun", price: 6500 },
    { gun: "AK-15 'Guardian'", rarity: "Epic", type: "Assault Rifle", price: 100000 },
    { gun: "MG42 'Destroyer Mark II'", rarity: "Legendary", type: "Machine Gun", price: 1168000 },
    { gun: "VX-Raptor 'Sky Hunter'", rarity: "Epic", type: "Assault Rifle", price: 4500 },
];

const container = document.getElementById('container');

const rarityColors = {
    "Common": "#b0b0b0",
    "Rare": "#4a90d9",
    "Epic": "#9b59b6",
    "Legendary": "#f0a500",
};

function createCard(item) {
    const color = rarityColors[item.rarity] || "#fff";

    const carditem = document.createElement('div');
    carditem.className = 'carditem';
    carditem.innerHTML = `
        <div>
            <h1 style="color: ${color}">${item.gun}</h1>
            <p style="color: ${color}">${item.rarity}</p>
            <p>Type: ${item.type}</p>
            <p>Price: $${item.price.toLocaleString()}</p>
        </div>
    `;
    return carditem;
}

array.forEach(item => {
    container.appendChild(createCard(item));
});



const filter = document.querySelector('.filter-container');


function filterGet(item) {
    const filter_content = document.createElement('div');
    const filteritem = item.gun;
    filter_content.innerHTML =

        `<input type="checkbox" name="checkbox" id="checkbox-filter">${filteritem}`
    return filter_content;
}

array.forEach(item => {
    filter.appendChild(filterGet(item));
})


const filtercheck = document.getElementById('checkbox-filter');

filtercheck.addEventListener('click', function () {
    e.preventDefault();
    const search = document.getElementById('search');



})



