document.addEventListener('DOMContentLoaded', () => {
    
    const burger = document.querySelector('#burger');
    const admin_aside = document.querySelector('.admin_aside');

    if(!burger) return;

    burger.addEventListener('click', () => {

        admin_aside.classList.toggle('burger_slide');

    });


});