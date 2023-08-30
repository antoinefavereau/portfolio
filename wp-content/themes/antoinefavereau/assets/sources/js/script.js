document.addEventListener("scroll", function (event) {
    let lastActiveElement;
    Array.from(document.querySelectorAll('#background .parcoursLIst .item')).forEach(element => {
        if (getVerticalPosition(element) < 70) {
            element.classList.add('active');
            lastActiveElement = element;
        } else {
            element.classList.remove('active');
        }
    })
    if (lastActiveElement) {
        let height = lastActiveElement.getBoundingClientRect().top - document.querySelector('#background .content').getBoundingClientRect().top
        document.querySelector('#background .verticalLine').style.setProperty('--height', height + 'px');
    } else {
        document.querySelector('#background .verticalLine').style.setProperty('--height', '0px');
    }
})

function getVerticalPosition(element) {
    var rect = element.getBoundingClientRect();
    var windowHeight = (window.innerHeight || document.documentElement.clientHeight);
    var percent = 100 * (rect.top / windowHeight);
    return percent;
}

Array.from(document.querySelectorAll(".scrollToButton")).forEach(function (element) {
    element.addEventListener("click", function (event) {
        event.preventDefault()
        document.querySelector(element.dataset.target).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.querySelectorAll("#menuButton, #menu .background, #menu .navList .item").forEach(element => {
    element.addEventListener("click", () => {
        document.querySelector("body").classList.toggle("active");
    })
});

document.querySelectorAll("#services .servicesList .item .button").forEach(element => {
    element.addEventListener("click", () => {
        document.querySelector("#footer").scrollIntoView({
            behavior: 'smooth'
        });
        document.querySelector("#footer #inputSubject").value = element.dataset.value + " : ";
    });
});

document.querySelector("#footer form").addEventListener("submit", (event) => {
    event.preventDefault();
    alert("Not available yet, please use my email address instead.");
});