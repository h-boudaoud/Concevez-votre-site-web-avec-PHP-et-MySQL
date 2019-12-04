<?php
// Paramètres pour accéder à la base de données
define("dbhost", "localhost"); // le nom du serveur
define("dbuser", "root"); //le nom du user
define("dbpass", ""); // le mot de passe du user
define("dbname", "ma_base"); //le nom de la base de donnée


////Initialisation des valeurs saisies/à saisir par l'utilisateur
//$pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : "";
//$msg = isset($_GET['msg']) ? str_replace('+', ' ', $_GET['msg']) : "";


//Initialisation de l'url methode get
$url_get = null;

if (isset($_POST['pseudo'])) {
    postData($_POST['pseudo'], $_POST['msg']);
}

function urlGet($url_param, $url_value, $url_get = null)
{
    //echo "<br />urlGet ($url_param, $url_value, $url_get)";
    return ((isset($url_get)) ? $url_get . "&" : '') .
        $url_param . '=' . str_replace(' ', '+', $url_value);
}

function postData($pseudo_post, $msg_post)
{
    $codes_error = null;
    $pseudo = trim(htmlspecialchars($pseudo_post));
    if ($pseudo == '') {
        $error_code[] = 'pseudo_empty';
    }
    if (strlen($pseudo) < 6) {
        $error_code[] = 'pseudo_min';
    }
    if (!(preg_match("#^[a-zA-Z0-9_\-]+$#", $pseudo))) {
        $error_code[] = 'pseudo_pattern';
    }
    if (strlen($pseudo) > 50) {
        $error_code[] = 'pseudo_max';
    }
    $msg = trim(htmlspecialchars($msg_post));
    if ($msg == '') {
        $error_code[] = 'msg_empty';
    };
    $url_value = '';
    //echo "<p>pseudo : $pseudo</p>";
    //echo "<p>msg : $msg</p>";
    //print_r($error_code);
    if (isset($error_code)) {
        foreach ($error_code as $key => $value) {
            $url_value = ($url_value == '') ? $value : $url_value . ':' . $value;
        }
        $url_get = (isset($url_get)) ? $url_get : null;
        $url_get = ($pseudo != '') ? urlGet('pseudo', $pseudo, $url_get) : $url_get;
        $url_get = ($msg != '') ? urlGet('msg', $msg, $url_get) : $url_get;
        $url_get = ($url_value != '') ? urlGet('codes_error', $url_value, $url_get) : $url_get;
        header("Location: index.php?$url_get");
    } elseif (trim($pseudo) && trim($msg)) {
        echo '<br /> --> bddchat.php 62: postData<br />';

        $bdd = connectionBDD();
        try{
            $new_msg = $bdd->prepare("INSERT INTO minichat(pseudo, msg) VALUES(:pseudo,:msg)");
            $new_msg->execute(
                array(
                    'pseudo' => nl2br(htmlspecialchars($pseudo))
                , 'msg' => nl2br(htmlspecialchars($msg))
                )
            );
            $new_msg->closeCursor();
        }catch (Exception $e){
            echo "<br /> post getCode ".$e->getCode();
            echo "<br /> post getMessage ".$e->getMessage();
            $codes_error = 'bdd_'.$e->getCode();
        }
        $msg = "";

        header("Location: index.php?pseudo=$pseudo".(($codes_error!="")?"&codes_error=$codes_error":""));
        return true;
    }
    return false;
}

function getList()
{
    global $codes_error, $errorList;
    $var = [];
    $bdd = connectionBDD();
    //echo "<br />104 --> getList $codes_error ";

    try {
        if (isset($bdd)) {
            $req = $bdd->prepare(
                'SELECT * FROM minichat ORDER BY id DESC'
            );
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                $var[] = $data;
            }
        }

    } catch (Exception $e) {
        echo '<br> 116 $e->getMessage() : ' . $e->getMessage();
        echo '<br> 117 $e->getCode() : ' . $codes_error;
        echo '<br>118 errorList : ' . print_r($errorList);
        echo '<br>119 $e->getLine() : ' . $e->getLine();
        new_BDD_table($e, $bdd);
    }


    return $var;
}

function connectionBDD()
{
    global $codes_error, $errorList;
    $error_req = null;
    $bdd = null;
    try {
        $bdd = new PDO('mysql:host=' . dbhost . ';dbname=' . dbname . ';charset=utf8'
            , dbuser
            , dbpass
            , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        //echo "--> acées réussi";

    } catch (Exception $e) {

        echo '<br> 209 $e->getMessage() : ' . $e->getMessage();
        echo '<br> 210 $e->getCode() : ' . $codes_error;
        echo '<br> 211 $e->getLine() : ' . $e->getLine();
        //echo "<br /> ".$e->getCode(). "  --->  " .$e->getMessage();
        //$codes_error = (($codes_error != '') ? $codes_error . ':' : '') . 'bdd_' . $e->getCode();
        new_BDD_table($e, $bdd);

    }
    return $bdd;
}

function new_BDD_table($e, $bdd)
{
    global $codes_error, $errorList;
    $codes_error = (($codes_error != '') ? $codes_error . ':' : '') . 'bdd_' . $e->getCode();
    switch ($e->getcode()) {
        case 1049:
            echo '<br /> Création de la BDD';
            $bdd = new PDO('mysql:host=' . dbhost, dbuser, dbpass);
            $req_create_table = "CREATE DATABASE "//IF NOT EXISTS "
                . dbname
                . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
            $bdd->prepare($req_create_table)->execute() or die('<br />---> Erreur : création BDD refusé --');
            $codes_error = (($codes_error != '') ? $codes_error . ':' : '') . 'bdd_1049-c';
            //$error_req = "error= --> Base de données inexistante : Code erreur :1045<br />--> Création de " . dbname . " réussi";
            break;
        case '42S02':
            echo '<br /> Création de la table';
            $req = $bdd->prepare(file_get_contents('sql/scriptTable.sql'));
            $req->execute() or die('<br />---> Erreur : création de la table refusé --');

            $codes_error = (($codes_error != '') ? $codes_error . ':' : '') . 'bdd_42S02-c';
            //$error_req = "error= --> table pour chat inexistante : Code erreur :1045<br />--> Création de la table réussi";
            break;
        default:
            break;

    }
    if (empty($errorList['bdd'][$e->getCode()])) {
        $errorList['bdd'][$e->getCode()] = true;
        //$codes_error = (($codes_error != '') ? $codes_error . ':' : '') . 'bdd_' . $e->getCode();
        echo '<br /> code erreur 184 : ' . $codes_error;
        header("Location: index.php?codes_error=$codes_error");
    }

}

