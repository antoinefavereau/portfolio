<?php

session_start();

$bdd = new PDO('mysql:host=185.98.131.91;dbname=antoi1888818', 'antoi1888818', 'Favere45+-');
// $bdd = new PDO('mysql:host=localhost;dbname=cesi-jpo', 'root', 'root');
$bdd->query("SET NAMES utf8");

if (isset($_GET['q'])) {
    switch ($_GET['q']) {
        case 'inscription':
            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $email = $_GET['email'];
            $formation = $_GET['formation'];

            if ($bdd->query("SELECT * FROM Users WHERE Mail = '$email'")->fetch()) {
                $result = $bdd->query("SELECT ID, id_categorie FROM Users WHERE Nom = '$nom' AND Prenom = '$prenom' AND Mail = '$email'")->fetch();
                if ($result) {
                    $_SESSION['userId'] = $result['ID'];
                    $_SESSION['formation'] = $result['id_categorie'];
                    echo json_encode(['state' => 'true', 'value' => $result]);
                    exit();
                } else {
                    echo json_encode(['state' => 'false', 'value' => 'Cet email est déjà utilisé.']);
                }
            } else {
                $bdd->query("INSERT INTO Users(`Nom`, `Prenom`, `Mail`, `id_categorie`, `FirstConnection`) VALUES ('$nom', '$prenom', '$email', (SELECT id FROM categories WHERE nom = '$formation'), 1)");
                $result = $bdd->query("SELECT ID, id_categorie FROM Users WHERE Nom = '$nom' AND Prenom = '$prenom' AND Mail = '$email'")->fetch();
                if ($result) {
                    $_SESSION['userId'] = $result['ID'];
                    $_SESSION['formation'] = $result['id_categorie'];
                    echo json_encode(['state' => 'true', 'value' => $result]);
                    exit();
                } else {
                    echo json_encode(['state' => 'false', 'value' => 'Echec de l\'enregistrement.']);
                }
            }
            break;

        case "admin":
            $id = $_GET['id'];
            $mdp = $_GET['mdp'];

            if ($id == "admin" && $mdp == "mdpcesijpo123") {
                $_SESSION['admin'] = "true";
                echo json_encode(['state' => 'true']);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Identifiants incorrects']);
            }
            break;

        case "results":
            $result = $bdd->query("SELECT Users.Nom, Users.Prenom, Users.Mail, COUNT(Users.ID) AS `Bonnes réponses` FROM Users INNER JOIN (SELECT Reponses.ID FROM Reponses INNER JOIN QCM ON Reponses.ID_QCM = QCM.ID WHERE Reponses.Reponses = QCM.BonnesReponses) AS Bonnes_reponses ON Users.ID = Bonnes_reponses.ID GROUP BY Users.ID ORDER BY COUNT(Users.ID) DESC;")->fetchAll();
            if ($result) {
                echo json_encode(['state' => 'true', 'value' => json_encode($result)]);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la requette']);
            }
            break;

        case "categories":
            $result = $bdd->query("SELECT * FROM categories")->fetchAll();
            if ($result) {
                echo json_encode(['state' => 'true', 'value' => json_encode($result)]);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la requette']);
            }
            break;

        case "formations":
            $result = $bdd->query("SELECT * FROM categories WHERE nom != 'communes'")->fetchAll();
            if ($result) {
                echo json_encode(['state' => 'true', 'value' => json_encode($result)]);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la requette']);
            }
            break;

        case "questions":
            $categories = $_GET["categories"];
            if ($categories == "0") {
                $result = $bdd->query("SELECT * FROM QCM INNER JOIN categories ON QCM.id_categorie = categories.id WHERE QCM.deleted = 0")->fetchAll();
            } else {
                $query = "SELECT * FROM QCM INNER JOIN categories ON QCM.id_categorie = categories.id WHERE QCM.deleted = 0 AND (";
                for ($i = 0; $i < strlen($categories); $i++) {
                    $query .= "id_categorie = " . $categories[$i] . " OR ";
                }
                $query = substr($query, 0, -4);
                $query .= ")";
                $result = $bdd->query($query)->fetchAll();
            }
            if ($result || count($result) == 0) {
                echo json_encode(['state' => 'true', 'value' => json_encode($result)]);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la requette']);
            }
            break;

        case 'qcm':
            $qcm_id = $_GET['id'];
            $user_id = $_GET["user_id"];
            $user_formation = $_GET["formation"];
            $questionId = $bdd->query("SELECT ID FROM QCM WHERE Identifiant = '$qcm_id' AND deleted = 0")->fetch()["ID"];
            if ($questionId) {
                if ($bdd->query("SELECT * FROM QCM WHERE ID = $questionId AND (id_categorie = (SELECT id FROM categories WHERE nom = 'communes') OR id_categorie = $user_formation)")->fetch()) {
                    if ($bdd->query("SELECT * FROM Reponses WHERE ID_QCM = $questionId AND ID = $user_id")->fetchAll()) {
                        echo json_encode(['state' => 'false', 'value' => 'Vous avez déjà répondu à cette question.']);
                    } else {
                        echo json_encode(['state' => 'true', 'value' => $bdd->query("SELECT * FROM QCM WHERE ID = $questionId")->fetch()]);
                    }
                } else {
                    echo json_encode(['state' => 'false', 'value' => 'Cette question est pour une autre formation.']);
                }
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Ce code n\'est pas reconnu.']);
            }
            break;

        case 'delete_question':
            $id_question = $_GET["id_question"];
            if ($bdd->query("UPDATE QCM SET deleted = 1 WHERE ID = $id_question")) {
                echo json_encode(['state' => 'true']);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la requête de suppression de la question.']);
            }
            break;

        case 'pointers':
            $user_id = $_GET["user_id"];
            $user_formation = $_GET["formation"];
            $QCMList = $bdd->query("SELECT * FROM QCM LEFT JOIN (SELECT Reponses.ID, Reponses.ID_QCM, Reponses.Reponses FROM Reponses LEFT JOIN Users ON Reponses.ID = Users.ID WHERE Users.ID = $user_id) customQCM ON QCM.ID = customQCM.ID_QCM WHERE QCM.deleted = 0 AND (QCM.id_categorie = (SELECT id FROM categories WHERE nom = 'communes') OR QCM.id_categorie = $user_formation) AND customQCM.ID_QCM IS NULL; ")->fetchAll();
            if ($QCMList) {
                echo json_encode(['state' => 'true', 'value' => json_encode($QCMList)]);
            } else {
                echo json_encode(['state' => 'false', 'value' => 'Echec de la récupération des pointeurs.']);
            }
            break;

        case 'first':
            $user_id = $_GET['user_id'];
            if ($bdd->query("SELECT * FROM Users WHERE ID = $user_id")->fetch()["FirstConnection"] == 1) {
                echo true;
            }
            break;

        case 'notfirst':
            $user_id = $_GET['user_id'];
            $bdd->query("UPDATE Users SET Firstconnection = 0 WHERE ID = $user_id");
            break;

        case 'reponse':
            if (isset($_GET['id']) && isset($_GET['userId']) && isset($_GET['reponse'])) {
                $bdd->query("INSERT INTO Reponses VALUES (" . $_GET['userId'] . ", (SELECT ID FROM QCM WHERE Identifiant = '" . $_GET['id'] . "' LIMIT 1), '" . $_GET['reponse'] . "')")->fetch();
                if ($bdd->query("SELECT * FROM Reponses WHERE ID = " . $_GET['userId'] . " AND ID_QCM = (SELECT ID FROM QCM WHERE Identifiant = '" . $_GET['id'] . "' LIMIT 1) AND Reponses = " . $_GET['reponse'])->fetch()) {
                    echo json_encode(['state' => 'true', 'value' => true]);
                } else {
                    echo json_encode(['state' => 'false', 'value' => 'Echec de l\'envoie de la réponse.']);
                }
            }
            break;

        default:
            break;
    }
}
