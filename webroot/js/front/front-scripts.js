
document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    let activeUrl = window.location.href;
    let links = document.querySelectorAll('header li a');
    links.forEach(link => {
        if (link.href == activeUrl) {
            link.classList.add('active');
        }
    });
});
