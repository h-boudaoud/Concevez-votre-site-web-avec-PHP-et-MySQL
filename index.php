<?php
//Initialisation des valeurs saisies/à saisir par l'utilisateur
$pseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : "";
$msg = isset($_GET['msg']) ? str_replace('+', ' ', $_GET['msg']) : "";




//Initialisation de la liste des erreurs pour la saisie
$errorList['pseudo'] = [];
$errorList['msg'] = [];
$msg_error=[];
//$errorList['bdd']=[];


$error = isset($_GET['error']) ? $_GET['error'] . '_' : "";
$codes_error = isset($_GET['codes_error']) ? $_GET['codes_error'] : null;
$list_codes_error = isset($codes_error) ? explode(':', $codes_error) : [];

foreach ($list_codes_error as $key=>$value){
    $item = explode('_', $value);
    $errorList[$item[0]][$item[1]] = true;
}
require_once('bddchat.php');
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mini chat</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <!-- script -->
    <script type="text/javascript" src="js/script.js"></script>

</head>
<body>

<div class="flex-center position-ref ">
    <div class="content">
        <div class="head">
            <div class="title m-b-md">
                Mini chat
            </div>
            <div>
                <?php require_once('formChat.php'); ?>
                <?php if (isset($errorList)): ?>
                    <div class="error m-b-md">
                            <?php
                            require_once('errorView.php');
                            ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <div class="chatList">
            <?php
                require_once('miniChatView.php');
            ?>
        </div>

    </div>

</div>


</body>
</html>

