<?php

session_start();

if (isset($_SESSION['userId'])) {
    if ($_SESSION['userId']) {
        header("Location: index.php");
        exit();
    }
}

require_once('header.php');

?>

<div id="pageInscription" class="position-relative w-100 h-100">
    <img class="fond position-absolute start-0 top-0 w-100 h-100" src="assets\dist\images\fondInscription.jpg">
    <img class="logo position-absolute start-50 translate-middle-x" src="assets\dist\images\logoCESI.png" alt="logo">
    <form id="formInscription" class="d-flex flex-column" onsubmit="return false">
        <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-evenly">
            <div class="formLine">
                <input type="text" name="nom" id="inscriptionFormNom" placeholder=" " required>
                <label for="inscriptionFormNom">NOM</label>
            </div>
            <div class="formLine">
                <input type="text" name="prenom" id="inscriptionFormPrenom" placeholder=" " required>
                <label for="inscriptionFormPrenom">PRENOM</label>
            </div>
            <div class="formLine">
                <input type="email" name="email" id="inscriptionFormEmail" placeholder=" " required>
                <label for="inscriptionFormEmail">EMAIL</label>
            </div>
            <div class="formLine">
                <select name="formation" id="inscriptionFormFormation"></select>
                <label for="inscriptionFormFormation">FORMATION</label>
            </div>
        </div>
        <input id="submitInscription" type="submit" value="Valider">
    </form>
</div>

<?php

require_once('footer.php');