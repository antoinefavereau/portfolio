$ = jQuery.noConflict();

var canvas
var ctx

$(document).ready(() => {

    canvas = document.getElementById('canvasGoTop');
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    ctx = canvas.getContext('2d');


    const txtElement = document.querySelector('.txt-type');
    const mots = JSON.parse(txtElement.getAttribute('data-words'));
    const initialSpeed = txtElement.getAttribute('data-speed');
    const wait = txtElement.getAttribute('data-wait');

    var index = 0;
    var sens = true;
    var indexMot = 0;
    var waitTimer = 0;
    var speed = initialSpeed

    setInterval(() => {
        if (waitTimer <= 0) {
            if (sens) {
                speed = initialSpeed
                if (index >= mots[indexMot].length) {
                    waitTimer = wait;
                    sens = !sens;
                } else {
                    txtElement.textContent = mots[indexMot].substring(0, ++index);
                }
            } else {
                speed = initialSpeed / 20
                if (index <= 0) {
                    sens = !sens;
                    if (indexMot >= mots.length - 1) {
                        indexMot = 0;
                    } else {
                        indexMot++;
                    }
                } else {
                    txtElement.textContent = mots[indexMot].substring(0, --index);
                }
            }
        } else {
            waitTimer--;
        }
    }, speed);

    $('#scrollBar').css('width', $(document).scrollTop() * 100 / ($(document).height() - $(window).height()) + '%');

    // ----------About----------
    var swiperAboutFormations = new Swiper("#swiperAboutFormations", {
        effect: "cards",
        grabCursor: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiperAboutCompetences = new Swiper("#swiperAboutCompetences", {
        effect: "cards",
        grabCursor: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiperAboutExperiences = new Swiper("#swiperAboutExperiences", {
        effect: "cards",
        grabCursor: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    $('#btnAboutFormations').click(function () {
        $('#btnAboutFormations').addClass('active');
        $('#btnAboutCompetences').removeClass('active');
        $('#btnAboutExperiences').removeClass('active');

        $('#swiperAboutFormations').addClass('active');
        $('#swiperAboutCompetences').removeClass('active');
        $('#swiperAboutExperiences').removeClass('active');
    });
    $('#btnAboutCompetences').click(function () {
        $('#btnAboutFormations').removeClass('active');
        $('#btnAboutCompetences').addClass('active');
        $('#btnAboutExperiences').removeClass('active');

        $('#swiperAboutFormations').removeClass('active');
        $('#swiperAboutCompetences').addClass('active');
        $('#swiperAboutExperiences').removeClass('active');
    });
    $('#btnAboutExperiences').click(function () {
        $('#btnAboutFormations').removeClass('active');
        $('#btnAboutCompetences').removeClass('active');
        $('#btnAboutExperiences').addClass('active');

        $('#swiperAboutFormations').removeClass('active');
        $('#swiperAboutCompetences').removeClass('active');
        $('#swiperAboutExperiences').addClass('active');
    });

    $('.lienHeader').click(function () {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 500);
    });


    // ----------Portfolio----------
    var swiperPortfolio = new Swiper("#swiperPortfolio", {
        slidesPerView: 1,
        centeredSlides: true,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next-arrow",
            prevEl: ".swiper-button-prev-arrow",
        },
        breakpoints: {
            500: {
                slidesPerView: 1.5,
            },
            800: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 3,
            },
        },
    });
});

$(window).on('load', function () {
    $('#loader').fadeOut('slow');
    $('body').removeClass('overflow-hidden');
    $('#home .titre h1, #home .titre h2, #home header .lienHeader').addClass('loaded');
});

$(document).scroll(function () {
    $('#scrollBar').css('width', $(document).scrollTop() * 100 / ($(document).height() - $(window).height()) + '%');

    if ($(document).scrollTop() > $('#home').height() / 2) {
        $('#goTop').addClass('show');
    } else {
        $('#goTop').removeClass('show');
    }

    ctx.clearRect(0, 0, 100, 100);
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.strokeStyle = '#000';
    ctx.arc(canvas.width / 2, canvas.height / 2, canvas.width / 2 - ctx.lineWidth / 2, -.5 * Math.PI, ($(document).scrollTop() * 100 / ($(document).height() - $(window).height()) / 50 - .5) * Math.PI);
    ctx.stroke();
});

$(document).mousemove(function (event) {
    // console.log(event.clientX);
    // console.log($("goTop").position());
});

function goTop() {
    $(document).scrollTop(0);
    $('html, body').animate({
        scrollTop: 0
    }, 500);
}
