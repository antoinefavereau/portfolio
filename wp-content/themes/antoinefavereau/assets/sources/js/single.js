var activeSection = 0
var numberOfSections = Array.from(document.getElementsByTagName('section')).length - 1

changeSection()

document.querySelector('#arrowLeft').addEventListener('click', function () {
    if (activeSection > 0) {
        activeSection--
        changeSection()
    }
})
document.querySelector('#arrowRight').addEventListener('click', function () {
    if (activeSection < numberOfSections) {
        activeSection++
        changeSection()
    }
})

function changeSection() {
    Array.from(document.getElementsByTagName('section')).forEach((section, index) => {
        if (index == activeSection) {
            section.style.display = 'block'
        } else {
            section.style.display = 'none'
        }
    })
}