<?php

session_start();

require_once('header.php');

?>

<div id="pageInscription" class="position-relative w-100 h-100">
    <img class="fond position-absolute start-0 top-0 w-100 h-100" src="assets\dist\images\fondInscription.jpg">
    <img class="logo position-absolute start-50 translate-middle-x" src="assets\dist\images\logoCESI.png" alt="logo">
    <form id="formAdmin" class="d-flex flex-column" onsubmit="return false">
        <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-evenly">
            <div class="formLine">
                <input type="text" name="id" id="adminFormId" placeholder=" " required>
                <label for="adminFormId">IDENTIFIANT</label>
            </div>
            <div class="formLine">
                <input type="password" name="mdp" id="adminFormMdp" placeholder=" " required>
                <label for="adminFormMdp">MOT DE PASSE</label>
            </div>
        </div>
        <input id="submitAdmin" type="submit" value="Valider">
    </form>
</div>

<?php

require_once('footer.php');