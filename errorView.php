<?php
//$msg_error['bdd'][2002] = "Le serveur est inaccessible";
//$msg_error['bdd'][1045] = "Le serveur est inaccessible";
//$msg_error['bdd'][1049] = "BDD inexistante";
//$msg_error['bdd'][22001] = "Erreur envoie du message";  //code SQL taille de données
//$msg_error['bdd']['HY000'] = "Erreur envoie du message";//code SQL type de données
//$msg_error['bdd']['1049-c'] = "Succès -> création de la BDD";
//$msg_error['bdd']['1049-e'] = "création de la BDD refusée";
//$msg_error['bdd']['42S02'] = "Table inexistante";
//$msg_error['bdd']['42S02-c'] = "Succès -> création de la table";
//$msg_error['bdd']['42S02-e'] = "création  de la table refusée";
//$msg_error['bdd']['server'] = "Le serveur est inaccessible";
//$msg_error['msg']['empty'] = "Le champ message ne doit pas être vide";
//$msg_error['pseudo']['empty'] = "Le champ pseudo est obligatoir";
//$msg_error['pseudo']['min'] = "Le pseudo  doit  contenir au moins 6 caractères";
//$msg_error['pseudo']['max'] = "Le pseudo  doit  contenir au plus 50 caractères";
//$msg_error['pseudo']['pattern'] = "Le pseudo choisi n'est pas valide.
//seuls les lettres sans accent, les chiffres et les symboles '-' et '_' sont accéptés";


$msg_error = array(
    'bdd' => array(
        2002 => "Le serveur est inaccessible",
        1045 => "Le serveur est inaccessible",
        1049 => "BDD inexistante",
        22001 => "Erreur envoie du message",  //code SQL taille de données
        'HY000' => "Erreur envoie du message",//code SQL type de données
        '1049-c' => "Succès -> création de la BDD",
        '1049-e' => "création de la BDD refusée",
        '42S02' => "Table inexistante",
        '42S02-c' => "Succès -> création de la table",
        '42S02-e' => "création  de la table refusée",
        'server' => "Le serveur est inaccessible"
    ),
    'msg' => array(
        'empty' => "Le champ message ne doit pas être vide",
    ),
    'pseudo' => array(
        'empty' => "Le champ pseudo est obligatoir",
        'min' => "Le pseudo  doit  contenir au moins 6 caractères",
        'max' => "Le pseudo  doit  contenir au plus 50 caractères",
        'pattern' => "Le pseudo choisi n'est pas valide. 
seuls les lettres sans accent, les chiffres et les symboles '-' et '_' sont accéptés",
    ),
);



if(isset($errorList)){

    echo "<ul>";
    foreach ($errorList as $key1 => $item) {
        if (in_array(true, $item)) {
            foreach ($item as $key2 => $value) {
                if ($value) {
                    //echo '<li> >> ' . $key1 . ' -> ' . $key2 . '</li>';
                    echo '<li> >> '
                        . $msg_error[$key1][$key2]
                        . (
                        ($key1 == "bdd" && $key2 != "server" && !stripos($key2, 'c'))
                            ? '<br />Code d\'erreur ' . $key2
                            : ''
                        )
                        . '</li>';
                }
            }
        }
    }
}
//echo '</ul>';


/*echo "<ul>";
foreach ($msg_error as $key1 => $item) {
    foreach ($item as $key2 => $value) {
        echo '<li> >> ' . $key1 . ' -> ' . $key2 . ' -> ' . $value . '</li>';
    }
}
echo '</ul>';*/