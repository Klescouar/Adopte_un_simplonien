<?php
	session_start();
?>
<div class="contactPage" ng-controller="contactCtrl">

    <div class="contactContainer">
    <form method="post" action="../server/mail.php">
			  <h1>Une question, une suggestion, un doute ?</h1>
				<h1>C’est par ici !</h1>
        <input type="text" name="nom" class="Name" placeholder="Nom/Prenom *" required/>
        <input type="text" name="entreprise" class="Name" placeholder="Entreprise *" required/>
        <input type="text" name="vile" class="City" placeholder="Ville *" required/>
        <input type="email" name="email" class="Email" placeholder="Email *" required/>
        <input type="text" name="phone" class="Phone" placeholder="Telephone" />
        <textarea name="message" rows="20" cols="20" class="Message" placeholder="Message *" required></textarea>
        <input type="submit" name="submit" value="ENVOYER" class="submit-button" />
    </form>
     <div class="mapContact">
            <div id="googleMap"></div>
        </div>
    </div>
</div>



















<!-- <div class="contactPage" ng-controller="contactCtrl">
    <div class="simplonPicture">
        <div class="contactForm animated slideInUp">
            <h1>Une question, une suggestion, un doute ? C’est par ici !</h1>
            <p>Votre message sera reçu par Simplon Montreuil</p>
            <form method="post">
                <input type="text" name="Nom" class="Name" placeholder="Nom/Prenom *" required/>
                <input type="text" name="Nom" class="Name" placeholder="Entreprise *" required/>
                <input type="text" name="City" class="City" placeholder="Ville *" required/>
                <input type="email" name="Email" class="Email" placeholder="Email *" required/>
                <input type="text" name="Phone" class="Phone" placeholder="Telephone" />
                <textarea name="Message" rows="20" cols="20" class="Message" placeholder="Message *" required></textarea>
                <input type="submit" name="submit" value="ENVOYER" class="submit-button" />
            </form>
            <div class="adressSimplon">
                <h1>Simplon Montreuil</h1>
                <p>55 rue de Vincennes</p>
                <p>93100 Montreuil</p>
                <p>inbox@simplon.co</p>
            </div>
        </div>
    </div>
</div> -->
