gsap.registerPlugin(ScrollTrigger);

var topSectionTL = gsap.timeline();

topSectionTL.from(".topSectionUpElasticAnimation", {
    duration: 3,
    y: 500,
    opacity: 0,
    ease: "elastic.out(1, 0.6)",
    stagger: 0.2,
});

gsap.utils.toArray("#background .parcoursLIst .item .text").forEach(function (elem) {
    ScrollTrigger.create({
        trigger: elem,
        onEnter: function () {
            gsap.fromTo(
                elem,
                {
                    y: 200,
                    autoAlpha: 0,
                },
                {
                    duration: 1,
                    y: 0,
                    autoAlpha: 1,
                }
            );
        },
    });
});

gsap.utils.toArray("#projects .projectsList .item .description").forEach(function (elem) {
    ScrollTrigger.create({
        trigger: elem,
        onEnter: function () {
            gsap.fromTo(
                elem,
                {
                    x: 200,
                    autoAlpha: 0,
                },
                {
                    duration: 1,
                    x: 0,
                    autoAlpha: 1,
                }
            );
        },
    });
});

gsap.utils.toArray(".section .h2").forEach(function (elem) {
    let text = elem.textContent;
    let replacementText = text.replaceAll(/./gi, "#");

    ScrollTrigger.create({
        trigger: elem,
        onEnter: function () {
            gsap.fromTo(
                elem,
                {
                    text: replacementText,
                },
                {
                    duration: 1,
                    delay: 0.2,
                    text: text,
                }
            );
        },
    });
});

gsap.utils.toArray(".section .h1").forEach(function (elem) {
    var newText = "";
    var theText = elem;
    theText.textContent.split(" ").forEach((word) => {
        newText += "<div>" + word + "&nbsp;</div>";
    });
    theText.innerHTML = newText;
    var targetsDiv = elem.querySelectorAll("div");

    ScrollTrigger.create({
        trigger: elem,
        onEnter: function () {
            gsap.fromTo(
                targetsDiv,
                {
                    y: 100,
                    autoAlpha: 0,
                },
                {
                    duration: 0.5,
                    y: 0,
                    autoAlpha: 1,
                    stagger: 0.1,
                }
            );
        },
    });
});

ScrollTrigger.create({
    trigger: "#skills .skillsList",
    onEnter: function () {
        gsap.fromTo(
            "#skills .skillsList .hex",
            {
                y: -100,
                autoAlpha: 0,
            },
            {
                duration: 0.5,
                y: 0,
                autoAlpha: 1,
                stagger: 0.1,
            }
        );
    },
});

ScrollTrigger.create({
    trigger: "#services .servicesList",
    onEnter: function () {
        gsap.fromTo(
            "#services .servicesList .item:nth-child(2)",
            {
                y: 200,
                autoAlpha: 0,
            },
            {
                duration: 1,
                y: 0,
                autoAlpha: 1,
            }
        );
        gsap.fromTo(
            "#services .servicesList .item:nth-child(1)",
            {
                x: -300,
                autoAlpha: 0,
            },
            {
                duration: 1,
                delay: 0.5,
                x: 0,
                autoAlpha: 1,
            }
        );
        gsap.fromTo(
            "#services .servicesList .item:nth-child(3)",
            {
                x: 300,
                autoAlpha: 0,
            },
            {
                duration: 1,
                delay: 0.5,
                x: 0,
                autoAlpha: 1,
            }
        );
    },
});

ScrollTrigger.create({
    trigger: "#footer .informations",
    onEnter: function () {
        gsap.fromTo(
            "#footer .informations .text",
            {
                y: 200,
                autoAlpha: 0,
            },
            {
                duration: 1,
                y: 0,
                autoAlpha: 1,
            }
        );
        gsap.fromTo(
            "#footer .informations ul li",
            {
                x: 200,
                autoAlpha: 0,
            },
            {
                duration: 1,
                delay: 0.5,
                x: 0,
                autoAlpha: 1,
                stagger: 0.3,
            }
        );
    },
});
