var nNotif = 0

if (document.getElementById("main")) {
    getPointers()
}

if (document.getElementById("messageBienvenue")) {
    document.getElementById("validerMessageBienvenue").addEventListener("click", function () {
        document.getElementById("messageBienvenue").classList.add("d-none")
        var ajax = new XMLHttpRequest()
        ajax.open("GET", "bdd.php?q=notfirst&user_id=" + user_id, true)
        ajax.send()
    })
}

if (document.getElementById("messageBienvenue")) {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=first&user_id=" + user_id, true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                document.getElementById("messageBienvenue").classList.remove("d-none")
            }
        }
    }
}

if (document.getElementById("batTitane")) {
    document.getElementById("batTitane").addEventListener("click", function () {
        document.getElementById("batSelect").classList.remove("active")
        document.getElementById("planCristal").classList.remove("active")
        document.getElementById("planTitane").classList.add("active")
        document.getElementById("btnQRcode").classList.add("active")
    })
}

if (document.getElementById("batCristal")) {
    document.getElementById("batCristal").addEventListener("click", function () {
        document.getElementById("batSelect").classList.remove("active")
        document.getElementById("planTitane").classList.remove("active")
        document.getElementById("planCristal").classList.add("active")
        document.getElementById("btnQRcode").classList.add("active")
    })
}

if (document.getElementsByClassName("batHeader")) {
    Array.from(document.getElementsByClassName("batHeader")).forEach(element => {
        element.addEventListener("click", function () {
            document.getElementById("btnQRcode").classList.remove("active")
            document.getElementById("planTitane").classList.remove("active")
            document.getElementById("planCristal").classList.remove("active")
            document.getElementById("batSelect").classList.add("active")
        })
    })
}

if (document.getElementById("btnEtage")) {
    document.getElementById("btnEtage").addEventListener("click", function () {
        if (document.getElementById("planCristalEtage").classList.contains("d-none")) {
            document.getElementById("planCristalEtage").classList.remove("d-none")
            document.getElementById("planCristalRdc").classList.add("d-none")
            document.getElementById("stairsUp").classList.add("d-none")
            document.getElementById("stairsDown").classList.remove("d-none")
        } else {
            document.getElementById("planCristalEtage").classList.add("d-none")
            document.getElementById("planCristalRdc").classList.remove("d-none")
            document.getElementById("stairsUp").classList.remove("d-none")
            document.getElementById("stairsDown").classList.add("d-none")
        }
    })
}

if (document.getElementById("inscriptionFormFormation")) {
    getFormations()
}

if (document.getElementById("qcm")) {
    document.querySelector("#qcm .fond").addEventListener("click", function() {
        document.getElementById("qcm").classList.remove("active")
    })
}

function getFormations() {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=formations", true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        let result = JSON.parse(JSON.parse(ajax.responseText)['value'])
                        result.forEach(element => {
                            document.getElementById("inscriptionFormFormation").insertAdjacentHTML("beforeend", "<option data-id='" + element["id"] + "'>" + element["nom"] + "</option>")
                        })
                        break;
                    case 'false':
                        notif('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        notif('error', 'Echec de la récupération des formations.')
                        break;
                }
            } else {
                notif('error', 'Echec de la récupération des formations.')
            }
        }
    }
}

function getPointers() {
    var ajax = new XMLHttpRequest()
    ajax.open("GET", "bdd.php?q=pointers&user_id=" + user_id + "&formation=" + user_formation, true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        Array.from(document.getElementsByClassName("pointer")).forEach(element => {
                            element.remove()
                        })
                        JSON.parse(JSON.parse(ajax.responseText)['value']).forEach(element => {
                            if (element["Position"]) {
                                var div = document.createElement("div")
                                div.classList.add('pointer')
                                div.innerHTML = '<svg width="35px" height="35px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" color="#000000"><path d="M20 10c0 4.418-8 12-8 12s-8-7.582-8-12a8 8 0 1116 0z" stroke="#000000" stroke-width="1.5"></path><path d="M12 11a1 1 0 100-2 1 1 0 000 2z" fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'
                                switch (element["Batiment"]) {
                                    case "titane":
                                        div.style.left = element["Position"].split(";")[0] + "%"
                                        div.style.top = element["Position"].split(";")[1] + "%"
                                        document.querySelector("#planTitane .plan .batiment").appendChild(div)
                                        break;

                                    case "cristalrdc":
                                        div.style.left = element["Position"].split(";")[0] + "%"
                                        div.style.top = element["Position"].split(";")[1] + "%"
                                        document.querySelector("#planCristal .plan #planCristalRdc").appendChild(div)
                                        break;

                                    case "cristaletage":
                                        div.style.left = element["Position"].split(";")[0] + "%"
                                        div.style.top = element["Position"].split(";")[1] + "%"
                                        document.querySelector("#planCristal .plan #planCristalEtage").appendChild(div)
                                        break;

                                    default:
                                        break;
                                }
                            }
                        });
                        break;
                    case 'false':
                        notif('error', JSON.parse(ajax.responseText)['value'])
                        break;

                    default:
                        notif('error', 'Echec de la récupération des pointeurs.')
                        break;
                }
            } else {
                notif('error', 'Echec de la récupération des pointeurs.')
            }
        }
    }
}

if (document.getElementById('formInscription')) {
    document.getElementById('formInscription').addEventListener('submit', logSubmit)
}
if (document.getElementById('formAdmin')) {
    document.getElementById('formAdmin').addEventListener('submit', adminSubmit)
}

function logSubmit() {
    var nom = document.getElementById('inscriptionFormNom').value
    var prenom = document.getElementById('inscriptionFormPrenom').value
    var email = document.getElementById('inscriptionFormEmail').value
    var formation = document.getElementById('inscriptionFormFormation').value
    if (nom && prenom && email) {
        var ajax = new XMLHttpRequest()
        ajax.open("GET", "bdd.php?q=inscription&nom=" + nom + "&prenom=" + prenom + "&email=" + email + "&formation=" + formation, true)
        ajax.send()
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    switch (JSON.parse(ajax.responseText)['state']) {
                        case 'true':
                            window.location.href = ''
                            break;
                        case 'false':
                            notif('error', JSON.parse(ajax.responseText)['value'])
                            document.getElementById('formInscription').addEventListener('submit', logSubmit)
                            break;

                        default:
                            notif('error', 'Echec de la requête.')
                            break;
                    }
                } else {
                    notif('error', 'Echec de la requête.')
                }
            }
        }
    } else {
        notif('alert', 'Vous devez remplir tous les champs.')
        document.getElementById('formInscription').addEventListener('submit', logSubmit)
    }
}

function adminSubmit() {
    var id = document.getElementById('adminFormId').value
    var mdp = document.getElementById('adminFormMdp').value
    if (id && mdp) {
        var ajax = new XMLHttpRequest()
        ajax.open("GET", "bdd.php?q=admin&id=" + id + "&mdp=" + mdp, true)
        ajax.send()
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    switch (JSON.parse(ajax.responseText)['state']) {
                        case 'true':
                            window.location.href = "admin.php"
                            break;
                        case 'false':
                            notif('error', JSON.parse(ajax.responseText)['value'])
                            document.getElementById('formAdmin').addEventListener('submit', adminSubmit)
                            break;

                        default:
                            notif('error', 'Echec de la requête.')
                            break;
                    }
                } else {
                    notif('error', 'Echec de la requête.')
                }
            }
        }
    } else {
        notif('alert', 'Vous devez remplir tous les champs.')
        document.getElementById('formAdmin').addEventListener('submit', adminSubmit)
    }
}

const qrScanner = new QrScanner(
    document.getElementById('videoCam'),
    result => {
        qrScanner.stop()
        document.getElementById('header').classList.add('shadow')
        document.getElementById("divQuestionCode").classList.remove("active")
        Array.from(document.getElementsByClassName("batPage")).forEach(element => {
            element.classList.remove("d-none")
        })
        result['data'].split('?')[1].split('&').forEach(element => {
            if (element.split('=')[0] == 'q') {
                var ajax = new XMLHttpRequest()
                var idQcm = element.split('=')[1]
                ajax.open("GET", "bdd.php?q=qcm&id=" + idQcm + "&user_id=" + user_id + "&formation=" + user_formation, true)
                ajax.send()
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        if (ajax.responseText) {
                            switch (JSON.parse(ajax.responseText)['state']) {
                                case 'true':
                                    var data = JSON.parse(ajax.responseText)['value']
                                    document.querySelector('#qcm .idQcm').innerHTML = idQcm
                                    document.querySelector('#qcm .question').innerHTML = data['Question']
                                    document.getElementById('reponse1').classList.remove('selected')
                                    document.getElementById('reponse1').classList.add('d-none')
                                    document.getElementById('reponse2').classList.remove('selected')
                                    document.getElementById('reponse2').classList.add('d-none')
                                    document.getElementById('reponse3').classList.remove('selected')
                                    document.getElementById('reponse3').classList.add('d-none')
                                    document.getElementById('reponse4').classList.remove('selected')
                                    document.getElementById('reponse4').classList.add('d-none')
            
                                    if (data['Reponse1']) {
                                        document.getElementById('reponse1').innerHTML = data['Reponse1']
                                        document.getElementById('reponse1').classList.remove('d-none')
                                    }
                                    if (data['Reponse2']) {
                                        document.getElementById('reponse2').innerHTML = data['Reponse2']
                                        document.getElementById('reponse2').classList.remove('d-none')
                                    }
                                    if (data['Reponse3']) {
                                        document.getElementById('reponse3').innerHTML = data['Reponse3']
                                        document.getElementById('reponse3').classList.remove('d-none')
                                    }
                                    if (data['Reponse4']) {
                                        document.getElementById('reponse4').innerHTML = data['Reponse4']
                                        document.getElementById('reponse4').classList.remove('d-none')
                                    }
                                    document.getElementById('qcm').classList.add('active')
                                    break;
                                case 'false':
                                    notif('alert', JSON.parse(ajax.responseText)['value'])
                                    break;

                                default:
                                    break;
                            }
                        } else {
                            notif('error', 'Echec de la récupération de la question.')
                        }
                    }
                }
            }
        });
    },
    {
        highlightScanRegion: true
    },
);

function getQcmByCode() {
    var ajax = new XMLHttpRequest()
    var idQcm = document.getElementById("formQuestionCodeValue").value
    ajax.open("GET", "bdd.php?q=qcm&id=" + idQcm + "&user_id=" + user_id + "&formation=" + user_formation, true)
    ajax.send()
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText) {
                switch (JSON.parse(ajax.responseText)['state']) {
                    case 'true':
                        var data = JSON.parse(ajax.responseText)['value']
                        document.querySelector('#qcm .idQcm').innerHTML = idQcm
                        document.querySelector('#qcm .question').innerHTML = data['Question']
                        document.getElementById('reponse1').classList.remove('selected')
                        document.getElementById('reponse1').classList.add('d-none')
                        document.getElementById('reponse2').classList.remove('selected')
                        document.getElementById('reponse2').classList.add('d-none')
                        document.getElementById('reponse3').classList.remove('selected')
                        document.getElementById('reponse3').classList.add('d-none')
                        document.getElementById('reponse4').classList.remove('selected')
                        document.getElementById('reponse4').classList.add('d-none')

                        if (data['Reponse1']) {
                            document.getElementById('reponse1').innerHTML = data['Reponse1']
                            document.getElementById('reponse1').classList.remove('d-none')
                        }
                        if (data['Reponse2']) {
                            document.getElementById('reponse2').innerHTML = data['Reponse2']
                            document.getElementById('reponse2').classList.remove('d-none')
                        }
                        if (data['Reponse3']) {
                            document.getElementById('reponse3').innerHTML = data['Reponse3']
                            document.getElementById('reponse3').classList.remove('d-none')
                        }
                        if (data['Reponse4']) {
                            document.getElementById('reponse4').innerHTML = data['Reponse4']
                            document.getElementById('reponse4').classList.remove('d-none')
                        }
                        document.getElementById('qcm').classList.add('active')
                        document.getElementById('header').classList.add('shadow')
                        document.getElementById("divQuestionCode").classList.remove("active")
                        Array.from(document.getElementsByClassName("batPage")).forEach(element => {
                            element.classList.remove("d-none")
                        })
                        break;
                    case 'false':
                        notif('alert', JSON.parse(ajax.responseText)['value'])
                        document.getElementById('formQuestionCode').addEventListener('submit', getQcmByCode)
                        document.getElementById('header').classList.add('shadow')
                        document.getElementById("divQuestionCode").classList.remove("active")
                        Array.from(document.getElementsByClassName("batPage")).forEach(element => {
                            element.classList.remove("d-none")
                        })
                        break;

                    default:
                        break;
                }
            } else {
                notif('error', 'Echec de la récupération de la question.')
                document.getElementById('formQuestionCode').addEventListener('submit', getQcmByCode)
            }
        }
    }
    document.getElementById("formQuestionCodeValue").value = ""
}

document.getElementById('btnQRcode').addEventListener('click', function () {
    if (qrScanner['_active']) {
        qrScanner.stop()
        document.getElementById('header').classList.add('shadow')
        document.getElementById("divQuestionCode").classList.remove("active")
        Array.from(document.getElementsByClassName("batPage")).forEach(element => {
            element.classList.remove("d-none")
        })
    } else {
        qrScanner.start().then((valeur) => {
            document.getElementById('header').classList.remove('shadow')
            Array.from(document.getElementsByClassName("batPage")).forEach(element => {
                element.classList.add("d-none")
            })
        }, (raison) => {
            QrScanner.listCameras(true).then((valeur) => {
                notif('alert', 'Echec de l\'accès à la caméra.') // raison + '\r' + JSON.stringify(valeur)
                document.getElementById("divQuestionCode").classList.add("active")
                Array.from(document.getElementsByClassName("batPage")).forEach(element => {
                    element.classList.add("d-none")
                })
                document.getElementById('formQuestionCode').addEventListener('submit', getQcmByCode)
            })
        });
    }
})

Array.from(document.getElementsByClassName('reponse')).forEach(function (element) {
    element.addEventListener('click', function (event) {
        event.target.classList.toggle('selected')
    })
})

document.getElementById('valider').addEventListener('click', function () {
    var idQcm = document.querySelector('#qcm .idQcm').innerHTML
    var reponse1selectionnee = document.getElementById('reponse1').classList.contains('selected')
    var reponse2selectionnee = document.getElementById('reponse2').classList.contains('selected')
    var reponse3selectionnee = document.getElementById('reponse3').classList.contains('selected')
    var reponse4selectionnee = document.getElementById('reponse4').classList.contains('selected')
    if (reponse1selectionnee || reponse2selectionnee || reponse3selectionnee || reponse4selectionnee) {
        var reponse = (reponse1selectionnee ? '1' : '0') + (reponse2selectionnee ? '1' : '0') + (reponse3selectionnee ? '1' : '0') + (reponse4selectionnee ? '1' : '0')
        var ajax = new XMLHttpRequest()
        ajax.open("GET", "bdd.php?q=reponse&id=" + idQcm + "&userId=" + userId + "&reponse=" + reponse, true)
        ajax.send()
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                if (ajax.responseText) {
                    switch (JSON.parse(ajax.responseText)['state']) {
                        case 'true':
                            document.getElementById('qcm').classList.remove('active')
                            getPointers()
                            notif('success', 'Réponse envoyée.')
                            break;
                        case 'false':
                            document.getElementById('qcm').classList.remove('active')
                            notif('alert', JSON.parse(ajax.responseText)['value'])
                            break;
                        default:
                            document.getElementById('qcm').classList.remove('active')
                            notif('alert', 'Echec de l\'envoie de la réponse.')
                            break;
                    }
                } else {
                    document.getElementById('qcm').classList.remove('active')
                    notif('error', 'Echec de l\'envoie de la réponse.')
                }
            }
        }
    }
})

function notif(type, message) {

    Array.from(document.getElementsByClassName('notif')).forEach(element => {
        element.classList.add('closed')
        setTimeout(() => {
            element.style.display = 'none'
        }, 500);
    })

    switch (type) {
        case 'success':
            type = 'Success'
            break;

        case 'alert':
            type = 'Alert'
            break;

        case 'error':
            type = 'Error'
            break;

        default:
            type = 'Info'
            break;
    }

    const htmlElementId = 'notif' + nNotif

    var div = document.createElement("div");

    div.id = htmlElementId

    div.classList.add('notif')
    div.classList.add('notif' + type)

    div.innerHTML = '<div class="left"><svg class="svgInfo" width="35" height="35" viewBox="0 0 35 35" fill="none"><path d="M17.5 16.7708V24.0625M17.5 10.9521L17.5145 10.936M17.5 32.0833C25.5543 32.0833 32.0833 25.5544 32.0833 17.5C32.0833 9.44563 25.5543 2.91667 17.5 2.91667C9.44559 2.91667 2.91663 9.44563 2.91663 17.5C2.91663 25.5544 9.44559 32.0833 17.5 32.0833Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg><svg class="svgSuccess" width="35" height="35" viewBox="0 0 35 35" fill="none"><path d="M7 18.75L12.8333 24.5833L27.4167 10" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg><svg class="svgAlert" width="35" height="35" viewBox="0 0 35 35" fill="none"><path d="M17.5001 13.125V18.9583M29.2294 30.625H5.77068C3.52776 30.625 2.12484 28.1983 3.24193 26.2544L14.9713 5.85521C16.0942 3.90542 18.9073 3.90542 20.0288 5.85521L31.7582 26.2544C32.8753 28.1983 31.4709 30.625 29.2294 30.625Z" stroke="white" stroke-width="2.5" stroke-linecap="round" /><path d="M17.5 24.8012L17.51 24.7902" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg><svg class="svgError" width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.3758 21.6242L17.5014 17.5M21.6256 13.3758L17.5014 17.5M17.5014 17.5L13.3758 13.3758M17.5014 17.5L21.6256 21.6242M17.5 32.0833C25.5543 32.0833 32.0833 25.5544 32.0833 17.5C32.0833 9.44563 25.5543 2.91667 17.5 2.91667C9.44559 2.91667 2.91663 9.44563 2.91663 17.5C2.91663 25.5544 9.44559 32.0833 17.5 32.0833Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg></div><p class="message">' + message + '</p><button class="close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M6.75806 17.243L12.0011 12M17.2441 6.757L12.0001 12M12.0001 12L6.75806 6.757M12.0011 12L17.2441 17.243" stroke="black" stroke-opacity="0.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg></button>'

    document.body.appendChild(div)

    nNotif++

    document.querySelector('#' + htmlElementId + ' .close').addEventListener('click', function () {
        document.querySelector('#' + htmlElementId).classList.add('closed')
        setTimeout(() => {
            document.querySelector('#' + htmlElementId).style.display = 'none'
        }, 500);
    })

    setTimeout(() => {
        document.getElementById(htmlElementId).classList.add('closed')
        setTimeout(() => {
            document.getElementById(htmlElementId).style.display = 'none'
        }, 500)
    }, 5000)
}