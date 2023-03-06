document.addEventListener("DOMContentLoaded", function (event) {

    var parcoursHeight = 1000

    document.addEventListener("keypress", function (event) {
        if (event.key == "m") {
            document.querySelector("#maintenance").style.display = "none";
        }
    })


    var cursor = document.querySelector("#cursor");
    document.addEventListener("mousemove", (event) => {
        cursor.classList.add("active")
        cursor.style.left = event.pageX - window.scrollX + "px"
        cursor.style.top = event.pageY - window.scrollY + "px"
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

    document.querySelector(".toTop").addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    })

    var parcoursTab = []

    var htmlParcoursTab = Array.from(document.querySelectorAll(".parcours"))
    htmlParcoursTab.forEach(function (element) {
        var dateDebut = parseInt(element.dataset.dateDebut.substring(6))
        var dateFin = parseInt(element.dataset.dateFin.substring(6))
        parcoursTab.push([
            element.dataset.id,
            element.dataset.titreCours,
            element.dataset.titreLong,
            dateDebut,
            dateFin,
            element.dataset.texte,
        ])
    })

    parcoursTab.sort((a, b) => a[3] - b[3]);

    document.querySelector("#parcours").style.height = "calc(" + parcoursTab.length * parcoursHeight + "px + 100vh)"

    var dateTab = []

    parcoursTab.forEach(element => {
        if (!dateTab.includes(element[3]) && element[3]) {
            dateTab.push(element[3])
        }
        if (!dateTab.includes(element[4]) && element[4]) {
            dateTab.push(element[4])
        }
    })

    dateTab.sort((a, b) => a - b);

    for (let i = 0; i < dateTab.length; i++) {
        var point = document.createElement('div')
        point.classList.add("point")
        document.querySelector("#parcours .parcoursLeft .barreVerticale").appendChild(point)
        point.style.top = (dateTab[i] - dateTab[0]) * 50 + "px"
        point.dataset.year = dateTab[i]
    }

    document.addEventListener("scroll", function (event) {
        document.querySelector(".toTop circle").style.strokeDashoffset = 1000 - Math.floor(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 185)
        getParcoursActiveElement(document.querySelector("#parcours .parcoursContainer").offsetTop)
    })

    function getParcoursActiveElement(top) {
        var index = Math.floor(top / parcoursHeight)
        if (index >= parcoursTab.length) {
            return
        }

        var top = 0
        var bottom = document.querySelector("#parcours .barreVerticale").clientHeight
        Array.from(document.querySelectorAll("#parcours .point")).forEach(function (element) {
            if (element.dataset.year == parcoursTab[index][3]) {
                top = element.offsetTop;
            }
            if (element.dataset.year == parcoursTab[index][4]) {
                bottom = element.offsetTop;
            }
        })
        document.querySelector("#parcours .barreSelection").style.top = top + "px"
        document.querySelector("#parcours .barreSelection").style.height = Math.max(0, bottom - top - 6) + "px"
        document.querySelector("#parcours .barreSelection").dataset.label = parcoursTab[index][1]
        document.querySelector("#parcours .titre").textContent = parcoursTab[index][2]
        document.querySelector("#parcours .texte").textContent = parcoursTab[index][5]
    }
});