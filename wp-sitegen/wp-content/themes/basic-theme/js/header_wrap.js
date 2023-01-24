setTimeout(f, 1000);

function f(){
    let burger = document.querySelector('.header__burger');
    let menu = document.querySelector('.header__nav')

    burger.addEventListener('click', () => {
        burger.classList.toggle('header__burger--active');
        menu.classList.toggle('header__nav--active');
        menu.style.visibility = 'visible';
        document.body.classList.toggle('stop-scroll');
    })
}