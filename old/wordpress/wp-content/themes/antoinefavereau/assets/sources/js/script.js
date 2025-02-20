document.addEventListener("scroll", function (event) {
    gsap.to(document.querySelector(".progressBarInner"), 0.2, {
        width: getVerticalScrollPercentage(document.body) + "%",
    });

    if (window.scrollY > (window.innerHeight || document.documentElement.clientHeight)) {
        document.querySelector(".toTopButton").classList.add("active");
    } else {
        document.querySelector(".toTopButton").classList.remove("active");
    }

    let lastActiveElement;
    Array.from(document.querySelectorAll("#background .parcoursLIst .item")).forEach((element) => {
        if (getVerticalPosition(element) < 70) {
            element.classList.add("active");
            lastActiveElement = element;
        } else {
            element.classList.remove("active");
        }
    });
    if (lastActiveElement) {
        let height = lastActiveElement.getBoundingClientRect().top - document.querySelector("#background .content").getBoundingClientRect().top;
        document.querySelector("#background .verticalLine").style.setProperty("--height", height + "px");
    } else {
        document.querySelector("#background .verticalLine").style.setProperty("--height", "0px");
    }
});

function getVerticalScrollPercentage(elm) {
    var p = elm.parentNode;
    return ((elm.scrollTop || p.scrollTop) / (p.scrollHeight - p.clientHeight)) * 100;
}

function getVerticalPosition(element) {
    var rect = element.getBoundingClientRect();
    var windowHeight = window.innerHeight || document.documentElement.clientHeight;
    var percent = 100 * (rect.top / windowHeight);
    return percent;
}

Array.from(document.querySelectorAll(".scrollToButton")).forEach(function (element) {
    element.addEventListener("click", function (event) {
        event.preventDefault();
        document.querySelector(element.dataset.target).scrollIntoView({
            behavior: "smooth",
        });
    });
});

document.querySelectorAll("#menuButton, #menu .background, #menu .navList .item").forEach((element) => {
    element.addEventListener("click", () => {
        document.querySelector("body").classList.toggle("active");
        if (document.querySelector("body").classList.contains("active")) {
            menuAnitmation();
        }
    });
});

document.querySelectorAll("#services .servicesList .item .button").forEach((element) => {
    element.addEventListener("click", () => {
        document.querySelector("#footer").scrollIntoView({
            behavior: "smooth",
        });
        document.querySelector("#footer #inputSubject").value = element.dataset.value + " : ";
    });
});

function menuAnitmation() {
    document.querySelectorAll("#menu .navList .item").forEach((element) => {
        element.classList.remove("animationFinished");
    });
    gsap.fromTo(
        "#menu .navList .item",
        {
            letterSpacing: 20.0,
            autoAlpha: 0,
        },
        {
            duration: 0.5,
            letterSpacing: 2.0,
            autoAlpha: 1,
            ease: "linear",
            stagger: 0.2,
            onComplete: function () {
                document.querySelectorAll("#menu .navList .item").forEach((element) => {
                    element.classList.add("animationFinished");
                });
            },
        }
    );
    gsap.fromTo(
        "#menu .links a",
        {
            y: 100,
            autoAlpha: 0,
        },
        {
            duration: 0.5,
            delay: 1,
            y: 0,
            autoAlpha: 1,
            ease: "back",
            stagger: 0.2,
        }
    );
}

// background svg animation

setInterval(() => {
    backgroundSvgAnimation();
}, 6000);

function backgroundSvgAnimation() {
    const randomSvg = document.querySelector(".backgroundContainer").children[Math.floor(Math.random() * document.querySelector(".backgroundContainer").children.length)];
    randomSvg.style.display = "block";
    randomSvg.style.left = Math.random() * (document.querySelector(".backgroundContainer").getBoundingClientRect().width - randomSvg.getBoundingClientRect().width) + "px";
    randomSvg.style.top = Math.random() * (document.querySelector(".backgroundContainer").getBoundingClientRect().height - randomSvg.getBoundingClientRect().height) + "px";

    setTimeout(() => {
        randomSvg.style.display = "none";
    }, 4000);
}

const contactForm = document.querySelector("#contactForm");
contactForm?.addEventListener("submit", function (event) {
    event.preventDefault();

    contactForm.querySelector(".submit").classList.add("loading");
    contactForm.querySelector(".submit").setAttribute("disabled", "disabled");

    let action = this.action;
    let method = this.method;
    let data = new FormData(this);
    data.append("action", "contact_form");

    fetch(action, {
        method: method,
        body: data,
    })
        .then(async (response) => {
            if (response.ok) {
                const json = await response.json();
                if (json.success) {
                    contactForm.reset();
                    contactForm.querySelector(".submit").classList.remove("loading");
                    contactForm.querySelector(".submit").removeAttribute("disabled");
                    alert(this.validationText.value);
                } else {
                    console.log(json.data.message);
                    contactForm.querySelector(".submit").classList.remove("loading");
                    contactForm.querySelector(".submit").removeAttribute("disabled");
                }
            } else {
                console.log("error");
                contactForm.querySelector(".submit").classList.remove("loading");
                contactForm.querySelector(".submit").removeAttribute("disabled");
            }
        })
        .catch((error) => {
            console.log(error);
            contactForm.querySelector(".submit").classList.remove("loading");
            contactForm.querySelector(".submit").removeAttribute("disabled");
        });
});
