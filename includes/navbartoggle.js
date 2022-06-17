//toggle navbar when resized

const hamburger = document.getElementById('hamburger');
const nav_ul = document.getElementById('menuitems');

hamburger.addEventListener('click', () => {
    nav_ul.classList.toggle('show');
});