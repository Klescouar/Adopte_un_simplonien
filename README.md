# Adopte_un_simplonien

###Installation d'un serveur local LAMP pour ubuntu

####Installation de lamp et phpmyadmin
D'abord installons LAMP : ```sudo apt-get install apache2 php mysql-server libapache2-mod-php php-mysql```  
pour vérifier que l'installation fonctionne correctement dans le navigateur taper "localhost" dans la barre d'url. Vous devriez voir une page apache avec écris *It works!*  

Maintenant installons phpmyadmin : `sudo apt-get install phpmyadmin`  
L'installation va vous demander plusieurs chose :
 - Comme serveur choisiser Apache2
Vous pouvez vérifier l'installation en allant sur localhost/phpmyadmin

####Mise en place du projet sur votre server local
- Créez un dossier dans vos documents, pour plus de facilité de compréhension nous appellerons ce dosser LAMP.
- Placez vous dans ce dossier avec votre terminal. Tapez `pwd` et copiez collez le chemin.
- Créez un lien symbolique en tapant `sudo ln -s [chemin récupéré à l'étape précédente] /var/www/html`
- Clonez le projet dans ce répertoire: `git clone https://github.com/Klescouar/Adopte_un_simplonien.git`
- Dans votre navigateur allez à l'adresse: `localhost/LAMP/Adopte_un_simplonien/dist`, vous pouvez désormais voir le projet.
