window.addEventListener ('load', function() {
const delay = 1000;
const preloader = document.getElementById('preloader');


setTimeout (function() {
    const preloader = document.getElementById('preloader');

    preloader .style.opacity = '0';
    preloader .style.visibility = 'hidden';

    setTimeout(() => {
    preloader .remove();
},500);
},delay);
});
