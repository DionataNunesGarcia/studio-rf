
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
let feed = new Instafeed({
    accessToken: 'IGQVJXOW1oMjdpS1hvTkM2TEl1dFNKVEd5LVZAWQ0FIZAEtxWEdZAMjRPMHZAwb2ktMUlZASWtfVm1rNDZAwaUVGQnJHYjZAwWHg1YXVjSFhsNkliLVFiWTJwUFZAtMC1xNXhoaDdFQ21fRkhrdjQzcWc3SzBRRgZDZD',
    limit: 8,
    template:'<div class="item"><a href="{{link}}" target="_blank"><img title="{{caption}}" src="{{image}}" /></a></div>',

    after: function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1

                },
                600:{
                    items:3

                },
                1000:{
                    items:5,
                    loop:false
                }
            }
        });
    }
});


feed.run();
