// javascript
var slideIndex = 0;
    showSlides();

    // Next/previous controls
    function plusSlides(n) {
        showSlides2(slideIndex += n);
    }

    function showSlides2(n) {
        var slides = document.getElementsByClassName("slideshow__myslide");

        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";
    }

    function showSlides() {

        var slides = document.getElementsByClassName("slideshow__myslide");

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000);
    }
// jquery
// register
$(document).ready(function () {
    $('.btn').delay(400).queue(function (next) {
        $(this).addClass('hover').delay(1800).queue(function (next) {
            $(this).removeClass('hover');
        });
        next();
    });
});
// checkout
$(".button").on("touchsart mousedown", function () {
    $(this).addClass("clicked");
});
$(".button").on("touchend mouseup", function () {
    $(this).removeClass("clicked");
    $(this).blur();
});


