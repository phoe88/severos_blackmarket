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

const container = document.querySelector('.containercard');

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
        <div style="cursor: pointer;">
            <h1 style="color: ${color}">${item.gun}</h1>
            <p style="color: ${color}">${item.rarity}</p>
            <p>Type: ${item.type}</p>
            <p>Price: $${item.price.toLocaleString()}</p>
        </div>
    `;
    carditem.addEventListener('mouseenter', function () {
        carditem.style.transform = 'scale(1.05)';
        carditem.style.transition = 'transform 0.3s ease';
    });

    carditem.addEventListener('mouseleave', function () {
        carditem.style.transform = 'scale(1)';
        carditem.style.transition = 'transform 0.3s ease';
    });

    carditem.addEventListener('click', function () {
        const confirmPuchase = document.createElement('div');
        const background = document.querySelector('body');
        confirmPuchase.innerHTML = `
        <div id="black-background">
            <div class="confirm-purchase">
                <h1 id="confirm-title">Are you sure you want to purchase ?</h1>
                <span><h1 id="gun-name" style="color: ${color}">${item.gun}</h1></span> 
                <span id="confirm-text">for price</span>
                <span id="gun-price">$${item.price.toLocaleString()}</span>
                <div class="confirm-btns">
                    <button id="cancel-btn">Cancel</button>
                    <button id="confirm-btn">Confirm</button>
                </div>
            </div>
        </div>
        `;


        background.appendChild(confirmPuchase);
        background.style.position = 'relative';

        const confirmbtn = document.querySelector('#confirm-btn');
        const cancelbtn = document.querySelector('#cancel-btn');
        confirmbtn.addEventListener('click', function (e) {
            if (e.target.id === 'confirm-btn') {
                alert(`You have purchased ${item.gun} for $${item.price.toLocaleString()}!`);
                background.removeChild(confirmPuchase);
            }
        });
        cancelbtn.addEventListener('click', function (e) {
            if (e.target.id === 'cancel-btn') {
                background.removeChild(confirmPuchase);
            }
        });




    })


    return carditem;
}
array.forEach(item => {
    container.appendChild(createCard(item));
});










const filter = document.querySelector('.filtercontainer');


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
    const search_element = document.createElement('div');
    search_element.innerHTML = `
    
    `



})


const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slider img');
let currentIndex = 0;
let autoScrollInterval;

function scrollToSlide(index) {
    currentIndex = (index + slides.length) % slides.length;
    slides[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
}

function startAutoScroll(delay = 1000) {
    autoScrollInterval = setInterval(() => {
        scrollToSlide(currentIndex + 1);
    }, delay);
}

function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}

slider.addEventListener('mouseenter', stopAutoScroll);
slider.addEventListener('mouseleave', () => startAutoScroll());

startAutoScroll();


const dots = document.querySelectorAll('.slider-nav a');

function scrollToSlide(index) {
    currentIndex = (index + slides.length) % slides.length;
    slides[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });


    dots.forEach((dot, i) => {
        dot.style.opacity = i === currentIndex ? '1' : '0.75';
    });
}


dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
        stopAutoScroll();
        scrollToSlide(i);
        startAutoScroll();
    });
});


