let prevScrollPos = window.pageYOffset;
const navbar = document.querySelector(".navbar");

window.onscroll = function () {
    let currentScrollPos = window.pageYOffset;

    if (currentScrollPos === 0) {
        navbar.style.top = "0";
    } else if (prevScrollPos > currentScrollPos) {        
        navbar.style.top = "0";
    } else {
        navbar.style.top = "-70px"; 
    }

    prevScrollPos = currentScrollPos;
};
