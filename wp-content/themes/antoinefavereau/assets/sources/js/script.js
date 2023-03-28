document.addEventListener("DOMContentLoaded", function (event) {

    var parcoursHeight = 1000

    document.querySelector("#maintenanceButton").addEventListener('click', function () {
        document.querySelector("#maintenance").style.display = "none";
        document.body.style.overflowY = "visible";
    })


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
        element.addEventListener("click", function () {
            document.querySelector(element.dataset.target).scrollIntoView({
                behavior: 'smooth'
            });
        })
    })

    var parcoursTab = []

    var htmlParcoursTab = Array.from(document.querySelectorAll("#parcours .parcoursRightContainer"))
    htmlParcoursTab.forEach(function (element) {
        var dateDebut = parseInt(element.dataset.dateDebut.substring(6))
        var dateFin = parseInt(element.dataset.dateFin.substring(6))
        parcoursTab.push([
            element.dataset.id,
            element.dataset.titreCours,
            dateDebut,
            dateFin,
        ])
    })

    parcoursTab.sort((a, b) => a[2] - b[2]);

    document.querySelector("#parcours").style.height = "calc(" + parcoursTab.length * parcoursHeight + "px + 100vh)"

    var dateTab = []

    parcoursTab.forEach(element => {
        if (!dateTab.includes(element[2]) && element[2]) {
            dateTab.push(element[2])
        }
        if (!dateTab.includes(element[3]) && element[3]) {
            dateTab.push(element[3])
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

        console.log(document.querySelector("#parcours").clientHeight / parcoursTab.length);

        document.querySelector(".progressBar").style.width = "10%"

        var top = 0
        var bottom = document.querySelector("#parcours .barreVerticale").clientHeight
        Array.from(document.querySelectorAll("#parcours .point")).forEach(function (element) {
            if (element.dataset.year == parcoursTab[index][2]) {
                top = element.offsetTop;
            }
            if (element.dataset.year == parcoursTab[index][3]) {
                bottom = element.offsetTop;
            }
        })
        document.querySelector("#parcours .barreSelection").style.top = top + "px"
        document.querySelector("#parcours .barreSelection").style.height = Math.max(0, bottom - top - 6) + "px"
        document.querySelector("#parcours .barreSelection").dataset.label = parcoursTab[index][1]
        Array.from(document.querySelectorAll("#parcours .parcoursRightContainer")).forEach(function (element) {
            if (element.dataset.id == parcoursTab[index][0]) {
                element.classList.add("active")
            } else {
                element.classList.remove("active")
            }
        })
    }

    if (document.querySelector("#parcoursTitleList")) {
        document.querySelector("#parcoursTitleList").ScrollingList({
            height: "120px",
            separator: true,
        })
    }
    if (document.querySelector("#competencesTitleList")) {
        document.querySelector("#competencesTitleList").ScrollingList({
            height: "120px",
            separator: true,
        })
    }

    document.querySelector(".mobileNavContainer").style.left = Math.round(document.querySelector(".btnMobileNav").getBoundingClientRect().left + document.querySelector(".btnMobileNav").getBoundingClientRect().width / 2) + "px"
    document.querySelector(".mobileNavContainer").style.top = Math.round(document.querySelector(".btnMobileNav").getBoundingClientRect().top + document.querySelector(".btnMobileNav").getBoundingClientRect().height / 2) + "px"

    document.querySelector(".btnMobileNav").addEventListener("click", function () {
        document.querySelector(".mobileNav").classList.toggle("active")
    })
});
