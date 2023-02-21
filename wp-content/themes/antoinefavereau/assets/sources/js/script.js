document.addEventListener("DOMContentLoaded", function (event) {

    document.addEventListener("keypress", function (event) {
        if (event.key == "m") {
            document.querySelector("#maintenance").style.display = "none";
        }
    })


    var cursor = document.querySelector("#cursor");

    ["mousemove", "scroll"].map(function (listEvent) {
        document.addEventListener(listEvent, (event) => {
            cursor.classList.add("active")
            cursor.style.left = event.pageX - window.scrollX + "px"
            cursor.style.top = event.pageY - window.scrollY + "px"
        })
    })

    createBrandSpan()

    setInterval(() => {
        Array.from(document.querySelectorAll(".brand span")).map(function (spanElement) {
            spanElement.style.left = spanElement.offsetLeft - 1 + "px"
        })

        createBrandSpan()
    }, 10);

    function createBrandSpan() {
        Array.from(document.querySelectorAll(".brand")).map(function (brand) {
            if (!brand.firstChild) {
                let spanElement = document.createElement("span")
                spanElement.textContent = brand.dataset.text
                spanElement.style.left = "0px"
                brand.appendChild(spanElement)
            } else {
                if (brand.lastChild.offsetLeft <= window.innerWidth) {
                    let spanElement = document.createElement("span")
                    spanElement.textContent = brand.dataset.text
                    spanElement.style.left = brand.lastChild.offsetLeft + brand.lastChild.offsetWidth + "px"
                    brand.appendChild(spanElement)
                }
                if (brand.firstChild.offsetLeft + brand.lastChild.offsetWidth < 0) {
                    brand.removeChild(brand.firstChild)
                }
            }
        })
    }

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

    document.querySelector("#discoverButton").addEventListener("click", function () {
        document.querySelector('#parcours').scrollIntoView({
            behavior: 'smooth'
        });
    })



    document.addEventListener("scroll", function (event) {
        document.querySelector(".toTop circle").style.strokeDashoffset = 1000 - Math.floor(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 185)
    })

    document.querySelector(".toTop").addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    })

});