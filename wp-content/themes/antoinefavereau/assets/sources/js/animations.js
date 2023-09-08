// gsap.registerPlugin(ScrollTrigger);

var topSectionTL = gsap.timeline();

topSectionTL.from(".topSectionUpElasticAnimation", {
    duration: 3,
    y: 500,
    opacity: 0,
    ease: "elastic.out(1, 0.6)",
    stagger: 0.2
});

// gsap.from("#background .parcoursLIst .item", {
//     scrollTrigger: {
//         trigger: "#background .parcoursLIst",
//         toggleActions: "repeat none none none"
//     },
//     duration: 1,
//     y: 200,
//     opacity: 0,
//     stagger: 0.2
// });