/****************************************************/
/*             TP PHP - Semaine 3 :                 */
/****************************************************/



##             l'énoncé du projet                   ##

voir le lien suivant

http://exercices.openclassrooms.com/assessment/40?id=918836&slug=
concevez-votre-site-web-avec-php-et-mysql&login=7324830&tk=
9c50f3437ebc81d0d913e32ee1859238&sbd=2016-02-01&sbdtk=
fa78d6dd3126b956265a25af9b322d55



##            Le contenu du projet                  ##

index.php :
    page d'accueil pour mettre en forme la vue coté client
    elle insert « miniChatView.php » le formulaire et « fromChat.php » la liste des message

miniChatView.php :
    pour afficher la liste des messages

fromChat.php :
    pour afficher le formulaire du chat

errorView.php:
    gestion de l'affichage des erreurs côté clients

bddchat.php:
    contient les paramètres et les méthodes pour interroger la base de données
    les paramètres définient en lignes 3, 4, et 5 sont à modifier pour accéder au serveur MySQL
    à la première connexion:
     la BDD « ma_base » sera créé si elle est inexistante
        le nom de la base pourra être changé en ligne 6
     la table « minichat » sera créé si elle est inexistante

scriptTable.sql:
    contient le script pour créer la table minichat

style.css :
    feuille de style

script.js:
    script Javascript

