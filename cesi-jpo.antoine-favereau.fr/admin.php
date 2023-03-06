<?php

session_start();

if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] != "true") {
        header("Location: admin-login.php");
        exit();
    }
} else {
    header("Location: admin-login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0"><!-- width=device-width, height=device-height, maximum-scale=1.0 -->
    <title>CESI jpo</title>
    <link rel="icon" href="assets/dist/images/logo_cesi_jpo.png">
    <link rel="stylesheet" href="assets\dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\dist\css\admin.css">
</head>

<body class="position-relative">
    <div id="sidebar">
        <header>
            <img src="assets\dist\images\logo_cesi_jpo.png" alt="logo">
            <span>Admin</span>
        </header>
        <div id="nav">
            <button id="navDashboard" class="item">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_315_1153)">
                        <path d="M22.0002 27.5C24.0252 27.5 25.6668 25.8584 25.6668 23.8333C25.6668 21.8083 24.0252 20.1667 22.0002 20.1667C19.9751 20.1667 18.3335 21.8083 18.3335 23.8333C18.3335 25.8584 19.9751 27.5 22.0002 27.5Z" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24.6582 21.175L28.4165 17.4167" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.7333 36.6667C9.05327 34.5365 7.10217 31.6254 6.15043 28.3368C5.19868 25.0483 5.29342 21.5451 6.42152 18.3128C7.54961 15.0805 9.6552 12.2791 12.4465 10.2969C15.2378 8.31469 18.5765 7.24979 22 7.24979C25.4235 7.24979 28.7622 8.31469 31.5535 10.2969C34.3448 12.2791 36.4504 15.0805 37.5785 18.3128C38.7066 21.5451 38.8013 25.0483 37.8496 28.3368C36.8978 31.6254 34.9467 34.5365 32.2667 36.6667H11.7333Z" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <span>Dashboard</span>
            </button>
            <button id="navQuestions" class="item active">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_315_1145)">
                        <path d="M14.6665 14.6667C14.6665 13.208 15.3425 11.809 16.5459 10.7776C17.7493 9.74613 19.3814 9.16667 21.0832 9.16667H22.9165C24.6183 9.16667 26.2504 9.74613 27.4538 10.7776C28.6571 11.809 29.3332 13.208 29.3332 14.6667C29.4007 15.857 29.0796 17.037 28.4183 18.029C27.757 19.0209 26.7912 19.7712 25.6665 20.1667C24.5418 20.694 23.5761 21.6943 22.9147 23.017C22.2534 24.3396 21.9323 25.9129 21.9998 27.5" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 34.8333V34.8517" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <span>Questions</span>
            </button>
            <button id="navResultats" class="item">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_315_1133)">
                        <path d="M14.6665 38.5H29.3332" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 31.1667V38.5" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.8335 7.33333H31.1668" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M31.1668 7.33333V22C31.1668 24.4311 30.2011 26.7627 28.482 28.4818C26.7629 30.2009 24.4313 31.1667 22.0002 31.1667C19.569 31.1667 17.2374 30.2009 15.5184 28.4818C13.7993 26.7627 12.8335 24.4311 12.8335 22V7.33333" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.16667 20.1667C11.1917 20.1667 12.8333 18.525 12.8333 16.5C12.8333 14.475 11.1917 12.8333 9.16667 12.8333C7.14162 12.8333 5.5 14.475 5.5 16.5C5.5 18.525 7.14162 20.1667 9.16667 20.1667Z" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M34.8332 20.1667C36.8582 20.1667 38.4998 18.525 38.4998 16.5C38.4998 14.475 36.8582 12.8333 34.8332 12.8333C32.8081 12.8333 31.1665 14.475 31.1665 16.5C31.1665 18.525 32.8081 20.1667 34.8332 20.1667Z" stroke="#E7E7E7" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <span>Résultats</span>
            </button>
        </div>
    </div>
    <div id="main">
        <button class="menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="18" x2="20" y2="18" />
            </svg>
        </button>
        <div id="dashboard" class="page">
            <h1>Dashboard</h1>
        </div>
        <div id="questions" class="page active">
            <h1>Questions</h1>
            <div class="questionContainer row row-cols-1 row-cols-md-2 gx-5 gy-5">
                <div class="col">
                    <button id="exportPdf" class="mb-4">Exporter pdf</button>
                    <div class="cartes">
                        <select id="cartesSelect">
                            <option value="titane" selected>Titane</option>
                            <option value="cristalRdc">Cristal rdc</option>
                            <option value="cristalEtage">Cristal étage</option>
                        </select>
                        <div id="carteTitane" class="carte active">
                            <img src="assets\dist\images\titane.svg" alt="titane">
                        </div>
                        <div id="carteCristalRdc" class="carte">
                            <img src="assets\dist\images\cristalRdc.svg" alt="cristal rdc">
                        </div>
                        <div id="carteCristalEtage" class="carte">
                            <img src="assets\dist\images\cristalEtage.svg" alt="cristal étage">
                        </div>
                    </div>
                </div>
                <div class="liste col">
                    <div class="categories">
                        <button class="active" data-value="toutes" data-id="0">toutes</button>
                    </div>
                    <div id="tabQuestions">
                        <div id="editSection" data-id="0">
                            <p id="editSectionQuestion" class="text-center" contenteditable></p>
                            <div class="d-flex justify-content-start align-items-center">
                                <input type="checkbox" class="editSectionAnswer1Checkbox">
                                <span class="editSectionAnswer1 ms-2" contenteditable></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center">
                                <input type="checkbox" class="editSectionAnswer2Checkbox">
                                <span class="editSectionAnswer2 ms-2" contenteditable></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center">
                                <input type="checkbox" class="editSectionAnswer3Checkbox">
                                <span class="editSectionAnswer3 ms-2" contenteditable></span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center">
                                <input type="checkbox" class="editSectionAnswer4Checkbox">
                                <span class="editSectionAnswer4 ms-2" contenteditable></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="resultats" class="page">
            <h1>Résultats</h1>
            <table id="tabResultats">
                <tr>
                    <th>Position</th>
                    <th>Score</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Mail</th>
                </tr>
            </table>
        </div>
    </div>

    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/qr-scanner.umd.min.js"></script>
    <script src="assets/dist/js/jspdf.min.js"></script>
    <script src="assets/dist/js/qrcode.min.js"></script>
    <script src="assets/sources/js/admin.js"></script>
</body>

</html>