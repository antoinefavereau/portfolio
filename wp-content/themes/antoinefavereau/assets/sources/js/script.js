document.addEventListener("DOMContentLoaded", function (event) {

    var cursor = document.querySelector("#cursor");
    document.addEventListener("mousemove", (event) => {
        cursor.classList.add("active")
        cursor.style.left = event.pageX - window.scrollX + "px"
        cursor.style.top = event.pageY - window.scrollY + "px"
    })

    document.body.addEventListener("mouseleave", (event) => {
        cursor.classList.remove("active")
    })

    Array.from(document.querySelectorAll("button:not(.hover_button), a:not(.hover_button)")).map(function (element) {
        element.addEventListener("mouseenter", function () {
            cursor.classList.add("hover")
            cursorWidth = element.offsetHeight + 10
            if (cursorWidth < 60) {
                cursorWidth = 60
            }
            cursor.style.width = cursorWidth + "px"
            cursor.style.height = cursorWidth + "px"
        })

        element.addEventListener("mouseleave", function () {
            cursor.classList.remove("hover")
            cursor.style.width = "18px"
            cursor.style.height = "18px"
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
        document.querySelector(".toTop circle").style.strokeDashoffset = 1000 - Math.floor(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 185)
    })

    document.querySelector(".nav .burger").addEventListener("click", function () {
        document.querySelector(".nav").classList.toggle("active")
    })

    Array.from(document.querySelectorAll(".navList a")).forEach(element => {
        element.addEventListener("click", function (event) {
            document.querySelector(".nav").classList.remove("active")
        })
    })

});
