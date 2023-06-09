document.addEventListener("DOMContentLoaded", function (event) {

    upAnimation()

    var swiper = new Swiper(".swiperCompetences", {
        slidesPerView: 3,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            576: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
            992: {
                slidesPerView: 5,
            },
            1200: {
                slidesPerView: 6,
            },
        }
    });

    var cursor = document.querySelector("#cursor");
    document.addEventListener("mousemove", (event) => {
        cursor.classList.add("active")
        cursor.style.left = event.pageX - window.scrollX + "px"
        cursor.style.top = event.pageY - window.scrollY + "px"
    })

    document.body.addEventListener("mouseleave", (event) => {
        cursor.classList.remove("active")
    })

    Array.from(document.querySelectorAll(".hover:not(#cursor)")).map(function (element) {
        element.addEventListener("mouseenter", function () {
            cursor.classList.add("hover")
            if (element.classList.contains("link")) {
                cursor.classList.add("link")
                cursorWidth = 60
                cursor.style.width = cursorWidth + "px"
                cursor.style.height = cursorWidth + "px"
            } else {
                if (element.classList.contains("text")) {
                    cursorWidth = Math.max(60, element.offsetHeight + 10)
                } else {
                    cursorWidth = Math.max(60, Math.sqrt(Math.pow(element.offsetWidth, 2) + Math.pow(element.offsetHeight, 2)) + 10)
                }
                cursor.style.width = cursorWidth + "px"
                cursor.style.height = cursorWidth + "px"
            }
        })

        element.addEventListener("mouseleave", function () {
            cursor.classList.remove("link")
            cursor.classList.remove("hover")
            cursor.style.width = "20px"
            cursor.style.height = "20px"
        })
    })

    // hover button
    Array.from(document.querySelectorAll(".hover_button")).forEach(element => {
        ["mouseenter", "mouseleave"].forEach(eventItem => {
            element.addEventListener(eventItem, function (event) {
                element.style.setProperty("--left", (event.x - element.getBoundingClientRect().left).toString() + "px")
                element.style.setProperty("--top", (event.y - element.getBoundingClientRect().top).toString() + "px")
            })
        })
    })

    Array.from(document.querySelectorAll(".scrollToButton")).forEach(function (element) {
        element.addEventListener("click", function (event) {
            event.preventDefault()
            document.querySelector(element.dataset.target).scrollIntoView({
                behavior: 'smooth'
            });
        })
    })

    document.addEventListener("scroll", function (event) {
        // document.querySelector(".toTop circle").style.strokeDashoffset = 1000 - Math.floor(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 185);

        let lastActiveElement;
        Array.from(document.querySelectorAll('#parcours .parcoursLIst .item')).forEach(element => {
            if (getVerticalPosition(element) < 60) {
                element.classList.add('active');
                lastActiveElement = element;
            } else {
                element.classList.remove('active');
            }
        })
        if (lastActiveElement) {
            let height = lastActiveElement.getBoundingClientRect().top - document.querySelector('#parcours').getBoundingClientRect().top + lastActiveElement.offsetHeight / 2
            document.querySelector('#parcours .verticalLine').style.setProperty('--height', height + 'px');
        } else {
            document.querySelector('#parcours .verticalLine').style.setProperty('--height', '0px');
        }

        upAnimation()
    })

    document.querySelector(".nav .burger").addEventListener("click", function () {
        document.querySelector(".nav").classList.toggle("active")
    })

    Array.from(document.querySelectorAll(".navList a")).forEach(element => {
        element.addEventListener("click", function (event) {
            setTimeout(() => {
                document.querySelector(".nav").classList.remove("active")
            }, 300);
        })
    })

    function getVerticalPosition(element) {
        var rect = element.getBoundingClientRect();
        var windowHeight = (window.innerHeight || document.documentElement.clientHeight);
        var percent = 100 * (rect.top / windowHeight);
        return percent;
    }

    function upAnimation() {
        Array.from(document.querySelectorAll(".upAnimation")).forEach(element => {
            if (element.getBoundingClientRect().top < window.screenY + window.innerHeight) {
                element.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        })
    }

});
