let nav = document.querySelector('nav');
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
 
 
window.addEventListener('scroll', () => {
    nav.classList.toggle('shadow', window.scrollY > 0);
});
 
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}
window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
}
const sr = ScrollReveal ({
    distance: '30px',
    duration: 2500,
    delay: 400,
    reset: true
})

sr.reveal('.carousel-inner , .about',
{
    delay: 200,
    origin:'top', 
    reset: true
})

// Green Mode
let greenmode = document.querySelector('#greenmode');
 
greenmode.onclick = () => {
    if(greenmode.classList.contains('bx-moon')){
        greenmode.classList.replace('bx-moon','bx-sun');
        document.body.classList.add('active');
    }else{
        greenmode.classList.replace('bx-sun','bx-moon');
        document.body.classList.remove('active');
    }
}


