document.querySelector('.menu-toggle').addEventListener('click', function() {
    document.querySelector('.navitems').classList.add('show-items');
    document.querySelector('.menu-toggle').classList.add('hide-toggle');
    document.querySelector('.close-toggle').classList.remove('hide-toggle');
});

document.querySelector('.close-toggle').addEventListener('click', function() {
    document.querySelector('.navitems').classList.remove('show-items');
    document.querySelector('.menu-toggle').classList.remove('hide-toggle');
    document.querySelector('.close-toggle').classList.add('hide-toggle');
});
