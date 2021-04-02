$(document).ready(function(){
    $('.categories').slick({
        slidesToShow: 8,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows: false,
        prevArrow: '<span class=" mat-shadow p-3 slick-prev rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class=" mat-shadow p-3 slick-next rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-right"></i></span>',
        dots: false,
        pauseOnHover: true,
        responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 5
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 7
            }
        },
        {
            breakpoint: 668,
            settings: {
                slidesToShow: 4 
            }
        },
        {
            breakpoint: 520,
            settings: {
                slidesToShow: 3 
            }
            
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 2
            }
            
        }]
    });
});
$(document).ready(function(){
    $('.products').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        prevArrow: '<span class=" mat-shadow p-3 slick-prev product-prev rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class=" mat-shadow p-3 slick-next product-next rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-right"></i></span>',
        dots: false,
        pauseOnHover: true,
        responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 668,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 520,
            settings: {
                slidesToShow: 1 
            }
            
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 1
            }
            
        }]
    });
});
