Array.from(document.querySelectorAll("#sidebar #nav .item")).forEach(element => {
    element.addEventListener("click", function () {
        Array.from(document.querySelectorAll("#sidebar #nav .item")).forEach(element2 => {
            element2.classList.remove("active")
        })
        Array.from(document.querySelectorAll("#main .page")).forEach(element2 => {
            element2.classList.remove("active")
        })
        element.classList.add("active")
        switch (element.id) {
            case "navDashboard":
                document.getElementById("dashboard").classList.add("active")
                break;

            case "navQuestions":
                document.getElementById("questions").classList.add("active")
                break;

            case "navResultats":
                document.getElementById("resultats").classList.add("active")
                break;

            default:
                break;
        }
        document.querySelector("#sidebar").classList.remove("active")
    })
})

document.getElementById("cartesSelect").addEventListener("change", function () {
    Array.from(document.querySelectorAll("#questions .questionContainer .cartes .carte")).forEach(element => {
        element.classList.remove("active")
    })
    switch (document.getElementById("cartesSelect").value) {
        case "titane":
            document.getElementById("carteTitane").classList.add("active")
            break;

        case "cristalRdc":
            document.getElementById("carteCristalRdc").classList.add("active")
            break;

        case "cristalEtage":
            document.getElementById("carteCristalEtage").classList.add("active")
            break;

        default:
            break;
    }
})

document.querySelector("#questions .questionContainer .liste .categories").addEventListener("wheel", (event) => {
    event.preventDefault()
    if (event.deltaY < 0) {
        document.querySelector("#questions .questionContainer .liste .categories").scrollLeft -= 50
    } else {
        document.querySelector("#questions .questionContainer .liste .categories").scrollLeft += 50
    }
})

document.querySelector("#exportPdf").addEventListener("click", function () {
    // let centerImage = new Image();
    // centerImage.src = 'assets/dist/images/logo_cesi_jpo.png';

    var doc = new jsPDF('p', 'pt', 'a4');
    doc.setFontSize(56);

    var first = true
    Array.from(document.querySelectorAll("#tabQuestions .item")).forEach(element => {
        if (!first) {
            doc.addPage();
        } else {
            first = false
        }
        var text = element.dataset.code;
        var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
        var textOffset = (doc.internal.pageSize.width - textWidth) / 2;
        doc.text(text, textOffset, 600);

        var div = document.createElement("div");

        var qrcode = new QRCode(div, {
            text: "https://cesi-jpo.antoine-favereau.fr?q=" + text,
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
            // logo: centerImage
        });

        doc.addImage(div.querySelector("canvas").toDataURL('image/png'), 'PNG', (doc.internal.pageSize.width - 300) / 2, 150, 300, 300);
    })

    doc.save('qrcodes.pdf');
})

if (document.querySelector(".menu")) {
    document.querySelector(".menu").addEventListener("click", function () {
        document.querySelector("#sidebar").classList.add("active")
    })
}

function getCategories() {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=categories", true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        let result = JSON.parse(JSON.parse(ajax.responseText)['value'])
                        result.forEach(element => {
                            document.querySelector("#questions .questionContainer .liste .categories").insertAdjacentHTML("beforeend", "<button data-value='" + element[1] + "' data-id='" + element[0] + "'>" + element[1] + "</button>");
                        })
                        Array.from(document.querySelectorAll("#questions .questionContainer .liste .categories button")).forEach(element => {
                            element.addEventListener("click", function () {
                                if (element.dataset.value == "toutes") {
                                    Array.from(document.querySelectorAll("#questions .questionContainer .liste .categories button")).forEach(element2 => {
                                        element2.classList.remove("active")
                                    })
                                } else {
                                    Array.from(document.querySelectorAll("#questions .questionContainer .liste .categories button")).forEach(element2 => {
                                        if (element2.dataset.value == "toutes") {
                                            element2.classList.remove("active")
                                        }
                                    })
                                }
                                element.classList.toggle("active")
                                getQuestions()
                            })
                        })
                        break;
                    case 'false':
                        console.log('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        console.log('error', 'Echec de la requête.')
                        break;
                }
            } else {
                console.log('error', 'Echec de la requête.')
            }
        }
    }
}

function getQuestions() {
    let categories = ""
    Array.from(document.querySelectorAll("#questions .questionContainer .liste .categories button")).forEach(element2 => {
        if (element2.classList.contains("active")) {
            categories += element2.dataset.id
        }
    })
    if (categories == "") {
        Array.from(document.querySelectorAll("#questions .questionContainer .liste .categories button")).forEach(element2 => {
            if (element2.dataset.value == "toutes") {
                element2.classList.add("active")
            }
        })
        categories = "0"
    }
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=questions&categories=" + categories, true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        let result = JSON.parse(JSON.parse(ajax.responseText)['value'])
                        Array.from(document.querySelectorAll("#tabQuestions .item")).forEach(element => {
                            element.remove()
                        })
                        Array.from(document.getElementsByClassName("pointer")).forEach(element => {
                            element.remove()
                        })
                        document.querySelector("#editSection").classList.remove("active")
                        result.forEach(element => {
                            let elementDiv = document.createElement("div");
                            elementDiv.className = "item";
                            elementDiv.dataset.id = element['ID'];
                            elementDiv.dataset.code = element['Identifiant'];
                            elementDiv.dataset.question = element['Question'];
                            elementDiv.dataset.reponse1 = element['Reponse1'];
                            elementDiv.dataset.reponse2 = element['Reponse2'];
                            elementDiv.dataset.reponse3 = element['Reponse3'];
                            elementDiv.dataset.reponse4 = element['Reponse4'];
                            elementDiv.dataset.bonnesreponses = element['BonnesReponses'];

                            let codeSpan = document.createElement("span");
                            codeSpan.className = "code";
                            codeSpan.textContent = element['Identifiant'];
                            elementDiv.appendChild(codeSpan);

                            let categorieSpan = document.createElement("span");
                            categorieSpan.className = "categorie";
                            categorieSpan.textContent = element['nom'];
                            elementDiv.appendChild(categorieSpan);

                            elementDiv.insertAdjacentHTML('beforeend', tabQuestionsActionButtons(element['ID']));
                            document.getElementById("tabQuestions").appendChild(elementDiv);

                            // document.getElementById("tabQuestions").insertAdjacentHTML("beforeend", '<div class="item" data-id="' + element['ID'] + '" data-question="' + element['Question'] + '" data-reponse1="' + element['Reponse1'] + '" data-reponse2="' + element['Reponse2'] + '" data-reponse3="' + element['Reponse3'] + '" data-reponse4="' + element['Reponse4'] + '" data-bonnesreponses="' + element['BonnesReponses'] + '"><span class="code">' + element['Identifiant'] + '</span><span class="categorie">' + element['nom'] + '</span>' + tabQuestionsActionButtons(element['ID']) + '</div>');
                            if (element["Position"]) {
                                var div = document.createElement("div")
                                div.classList.add('pointer')
                                div.dataset.id = element["ID"]
                                div.innerHTML = '<svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" color="#000000"><path d="M20 10c0 4.418-8 12-8 12s-8-7.582-8-12a8 8 0 1116 0z" stroke="#000000"></path><path d="M12 11a1 1 0 100-2 1 1 0 000 2z" fill="#000000" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path></svg>'
                                div.style.left = element["Position"].split(";")[0] + "%"
                                div.style.top = element["Position"].split(";")[1] + "%"
                                switch (element["Batiment"]) {
                                    case "titane":
                                        document.querySelector("#carteTitane").appendChild(div)
                                        break;

                                    case "cristalrdc":
                                        document.querySelector("#carteCristalRdc").appendChild(div)
                                        break;

                                    case "cristaletage":
                                        document.querySelector("#carteCristalEtage").appendChild(div)
                                        break;

                                    default:
                                        break;
                                }
                            }
                        })
                        Array.from(document.querySelectorAll("#tabQuestions .item")).forEach(element => {
                            element.addEventListener("mouseenter", function () {
                                deActivatePointersAndQuestions()
                                Array.from(document.querySelectorAll("#carteTitane .pointer")).forEach(element2 => {
                                    if (element.dataset.id == element2.dataset.id) {
                                        element2.classList.add("active")
                                        document.querySelector("#cartesSelect").value = "titane"
                                        document.querySelector("#carteTitane").classList.add("active")
                                        document.querySelector("#carteCristalRdc").classList.remove("active")
                                        document.querySelector("#carteCristalEtage").classList.remove("active")
                                    }
                                })
                                Array.from(document.querySelectorAll("#carteCristalRdc .pointer")).forEach(element2 => {
                                    if (element.dataset.id == element2.dataset.id) {
                                        element2.classList.add("active")
                                        document.querySelector("#cartesSelect").value = "cristalRdc"
                                        document.querySelector("#carteTitane").classList.remove("active")
                                        document.querySelector("#carteCristalRdc").classList.add("active")
                                        document.querySelector("#carteCristalEtage").classList.remove("active")
                                    }
                                })
                                Array.from(document.querySelectorAll("#carteCristalEtage .pointer")).forEach(element2 => {
                                    if (element.dataset.id == element2.dataset.id) {
                                        element2.classList.add("active")
                                        document.querySelector("#cartesSelect").value = "cristalEtage"
                                        document.querySelector("#carteTitane").classList.remove("active")
                                        document.querySelector("#carteCristalRdc").classList.remove("active")
                                        document.querySelector("#carteCristalEtage").classList.add("active")
                                    }
                                })
                            })
                            element.addEventListener("mouseleave", function () {
                                deActivatePointersAndQuestions()
                            })
                        })

                        Array.from(document.querySelectorAll("#tabQuestions .item .delete")).forEach(element => {
                            element.addEventListener("click", function () {
                                if (confirm("Voulez vous vraiment supprimer cette questions ?")) {
                                    deleteQuestion(element.dataset.code)
                                }
                            })
                        })
                        Array.from(document.querySelectorAll("#tabQuestions .item .edit")).forEach(element => {
                            element.addEventListener("click", function () {
                                if (element.dataset.code == document.querySelector("#editSection").dataset.id) {
                                    document.querySelector("#editSection").classList.toggle("active")
                                } else {
                                    let childElement = document.querySelector("#editSection")
                                    document.querySelector("#tabQuestions").removeChild(childElement)
                                    Array.from(document.querySelectorAll("#tabQuestions .item")).forEach(element2 => {
                                        if (element.dataset.code == element2.dataset.id) {
                                            element2.insertAdjacentHTML('afterend', childElement.outerHTML)
                                            document.querySelector("#editSection #editSectionQuestion").textContent = element2.dataset.question

                                            document.querySelector("#editSection .editSectionAnswer1").textContent = element2.dataset.reponse1
                                            document.querySelector("#editSection .editSectionAnswer2").textContent = element2.dataset.reponse2
                                            document.querySelector("#editSection .editSectionAnswer3").textContent = element2.dataset.reponse3
                                            document.querySelector("#editSection .editSectionAnswer4").textContent = element2.dataset.reponse4

                                            document.querySelector("#editSection .editSectionAnswer1Checkbox").checked = element2.dataset.bonnesreponses[0] == "1" ? true : false
                                            document.querySelector("#editSection .editSectionAnswer2Checkbox").checked = element2.dataset.bonnesreponses[1] == "1" ? true : false
                                            document.querySelector("#editSection .editSectionAnswer3Checkbox").checked = element2.dataset.bonnesreponses[2] == "1" ? true : false
                                            document.querySelector("#editSection .editSectionAnswer4Checkbox").checked = element2.dataset.bonnesreponses[3] == "1" ? true : false

                                            document.querySelector("#editSection").classList.add("active")
                                            document.querySelector("#editSection").dataset.id = element.dataset.code
                                        }
                                    })
                                }
                            })
                        })
                        break;
                    case 'false':
                        console.log('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        console.log('error', 'Echec de la requête.')
                        break;
                }
            } else {
                console.log('error', 'Echec de la requête.')
            }
        }
    }
}

document.addEventListener("click", function (event) {

    if (!getElementParents(event.target).includes(document.querySelector("#sidebar")) && !getElementParents(event.target).includes(document.querySelector(".menu"))) {
        document.querySelector("#sidebar").classList.remove("active")
    }

    var element = event.target.parentElement

    deActivatePointersAndQuestions()

    if (element.classList.contains("pointer")) {
        Array.from(document.querySelectorAll("#tabQuestions .item")).forEach(question => {
            if (element.dataset.id == question.dataset.id) {
                question.classList.add("active")
                element.classList.add("active")
                window.scrollTo(0, question.offsetTop)
            }
        })
    }
})

function getElementParents(element) {
    var a = element
    var els = []
    while (a) {
        els.unshift(a)
        a = a.parentNode
    }
    return els
}

function deActivatePointersAndQuestions() {
    Array.from(document.querySelectorAll(".pointer, #tabQuestions .item")).forEach(pointerAndQuestion => {
        pointerAndQuestion.classList.remove("active")
    })
}

function getQuestionDetails() {

}

function deleteQuestion(id_question) {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=delete_question&id_question=" + id_question, true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        getQuestions()
                        break;
                    case 'false':
                        console.log('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        console.log('error', 'Echec de la suppression de la question.')
                        break;
                }
            } else {
                console.log('error', 'Echec de la suppression de la question.')
            }
        }
    }
}

function tabQuestionsActionButtons(code) {
    let actionButtons = '<div class="actionButtons">'
    actionButtons += '<button class="edit" data-code="' + code + '"><svg width="30" height="30" viewBox="0 0 30 30" fill="none"><g clip-path="url(#clip0_316_1566)"><path d="M5 25H10L23.125 11.875C23.788 11.212 24.1605 10.3127 24.1605 9.375C24.1605 8.43731 23.788 7.53804 23.125 6.875C22.462 6.21196 21.5627 5.83946 20.625 5.83946C19.6873 5.83946 18.788 6.21196 18.125 6.875L5 20V25Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M16.875 8.125L21.875 13.125" stroke="black" stroke-linecap="round" stroke-linejoin="round"/></g></svg></button>'
    actionButtons += '<button class="delete" data-code="' + code + '"><svg width="30" height="30" viewBox="0 0 30 30" fill="none"><g clip-path="url(#clip0_316_1571)"><path d="M5 8.75H25" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.5 13.75V21.25" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.5 13.75V21.25" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.25 8.75L7.5 23.75C7.5 24.413 7.76339 25.0489 8.23223 25.5178C8.70107 25.9866 9.33696 26.25 10 26.25H20C20.663 26.25 21.2989 25.9866 21.7678 25.5178C22.2366 25.0489 22.5 24.413 22.5 23.75L23.75 8.75" stroke="black" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 8.75V5C11.25 4.66848 11.3817 4.35054 11.6161 4.11612C11.8505 3.8817 12.1685 3.75 12.5 3.75H17.5C17.8315 3.75 18.1495 3.8817 18.3839 4.11612C18.6183 4.35054 18.75 4.66848 18.75 5V8.75" stroke="black" stroke-linecap="round" stroke-linejoin="round"/></g></svg></button>'
    actionButtons += '</div>'
    return actionButtons;
}

function getResults() {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=results", true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        let result = JSON.parse(JSON.parse(ajax.responseText)['value'])
                        let position = 0
                        result.forEach(element => {
                            position++
                            document.getElementById("tabResultats").insertAdjacentHTML("beforeend", "<tr class='item'><td>" + position + "</td><td>" + element[3] + "</td><td>" + element[0] + "</td><td>" + element[1] + "</td><td>" + element[2] + "</td></tr>");
                        })
                        break;
                    case 'false':
                        console.log('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        console.log('error', 'Echec de la requête.')
                        break;
                }
            } else {
                console.log('error', 'Echec de la requête.')
            }
        }
    }
}

getCategories()
getQuestions()
getResults()