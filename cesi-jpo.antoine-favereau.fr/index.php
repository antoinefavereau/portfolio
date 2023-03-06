<?php

session_start();

if (isset($_SESSION['userId'])) {
    if ($_SESSION['userId']) {
        echo "<script>var userId = " . $_SESSION['userId'] . "</script>";
        echo "<script>var user_formation = " . $_SESSION['formation'] . "</script>";
    } else {
        header("Location: inscription.php");
        exit();
    }
} else {
    header("Location: inscription.php");
    exit();
}

require_once('header.php');

?>
<script type="text/javascript">
    var user_id = '<?php echo $_SESSION['userId']; ?>';
    var user_formation = '<?php echo $_SESSION['formation']; ?>';
</script>

<div id="main" class="position-relative w-100 h-100">
    <video id="videoCam" class="position-absolute start-0 top-0 w-100 h-100"></video>
    <header id="header" class="position-relative w-100 shadow">
        <a class="logo d-block py-4 mx-auto" href=""><img src="assets\dist\images\logoCESI.png" alt="logo"></a>
    </header>
    <div id="batSelect" class="active">
        <div id="batTitane" class="bat">
            <img src="assets\dist\images\titane.jpg" alt="">
            <span>BATIMENT TITANE</span>
        </div>
        <div id="batCristal" class="bat">
            <img src="assets\dist\images\cristal.jpg" alt="">
            <span>BATIMENT CRISTAL</span>
        </div>
    </div>
    <div id="planTitane" class="batPage">
        <div class="batHeader">
            <img src="assets\dist\images\titane.jpg" alt="">
            <span>RETOUR</span>
        </div>
        <div class="plan">
            <div class="batiment">
                <img class="titane" src="assets\dist\images\titane.svg" alt="Titane">
            </div>
        </div>
    </div>
    <div id="planCristal" class="batPage">
        <div class="batHeader">
            <img src="assets\dist\images\cristal.jpg" alt="">
            <span>RETOUR</span>
        </div>
        <div class="plan">
            <div id="planCristalEtage" class="batiment d-none">
                <img class="cristalEtage" src="assets\dist\images\cristalEtage.svg" alt="Cristal 2tqge">
            </div>
            <div id="planCristalRdc" class="batiment">
                <img class="cristalRdc" src="assets\dist\images\cristalRdc.svg" alt="Cristal rez-de-chaussée">
            </div>
            <button id="btnEtage">
                <svg id="stairsUp" class="icon icon-tabler icon-tabler-stairs-up" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 20h4v-4h4v-4h4v-4h4" />
                    <path d="M4 11l7 -7v4m-4 -4h4" />
                </svg>
                <svg id="stairsDown" class="icon icon-tabler icon-tabler-stairs-down d-none" width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 20h4v-4h4v-4h4v-4h4" />
                    <path d="M11 4l-7 7v-4m4 4h-4" />
                </svg>
            </button>
        </div>
    </div>
    <button id="btnQRcode" class="position-absolute start-50 translate-middle-x">
        <svg stroke-width="1.5" viewBox="0 0 24 24" fill="none" color="currentcolor">
            <path d="M15 12v3M12 3v3M18 12v3M12 18h9M18 21h3M6 12h3M6 6.011L6.01 6M12 12.011l.01-.011M3 12.011L3.01 12M12 9.011L12.01 9M12 15.011l.01-.011M15 21.011l.01-.011M12 21.011l.01-.011M21 12.011l.01-.011M21 15.011l.01-.011M18 6.011L18.01 6M9 3.6v4.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6V3.6a.6.6 0 01.6-.6h4.8a.6.6 0 01.6.6zM21 3.6v4.8a.6.6 0 01-.6.6h-4.8a.6.6 0 01-.6-.6V3.6a.6.6 0 01.6-.6h4.8a.6.6 0 01.6.6zM6 18.011L6.01 18M9 15.6v4.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6v-4.8a.6.6 0 01.6-.6h4.8a.6.6 0 01.6.6z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>
    <div id="divQuestionCode">
        <form id="formQuestionCode" class="d-flex flex-column" onsubmit="return false">
            <p>Nous n'avons pas pu accéder à votre caméra, veuillez rentrer le code présent sous le qr-code.</p>
            <input type="text" name="code" id="formQuestionCodeValue" placeholder=" " required>
            <input id="submitFormQuestionCode" type="submit" value="Valider">
        </form>
    </div>
    <div id="qcm" class="position-absolute start-0 top-0 w-100 h-100">
        <div class="fond position-absolute start-0 top-0 end-0 bottom-0"></div>
        <div class="qcmBox position-absolute start-50 top-50 translate-middle d-flex flex-column align-items-center">
            <span class="idQcm d-none"></span>
            <h2 class="question p-3 text-center"></h2>
            <div class="reponses flex-grow-1 d-flex flex-column justify-content-around">
                <button id="reponse1" class="reponse m-1"></button>
                <button id="reponse2" class="reponse m-1"></button>
                <button id="reponse3" class="reponse m-1"></button>
                <button id="reponse4" class="reponse m-1"></button>
            </div>
            <button id="valider" class="mt-4">Valider</button>
        </div>
    </div>
    <div id="messageBienvenue" class="position-absolute start-0 top-0 w-100 h-100 d-none">
        <div class="messageBienvenueBox position-absolute start-50 top-50 translate-middle d-flex flex-column align-items-center">
            <p>
                Bonjour et bienvenue sur le site de la Journée Portes Ouvertes du CESI d'Orléans.<br><br>
                Nous vous proposons une visite interactive de notre campus avec un jeu sous forme de QCM.<br><br>
                Pour répondre aux différentes questions, il vous suffira de scanner les QRcodes présents dans nos locaux.<br><br>
                Afin de bénéficier de tous les points, vous serez amenés à vous déplacer dans les deux bâtiments.
                Bonne chance !<br><br>
                Ps : Faites attention en traversant.
            </p>
            <button id="validerMessageBienvenue">Commencer</button>
        </div>
    </div>
</div>
<?php

require_once('footer.php');
