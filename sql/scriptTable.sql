-- Création de la table minichat
CREATE TABLE minichat (
    id INT(11) NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL,
    msg TEXT NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);