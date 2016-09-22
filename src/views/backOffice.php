<?php
	session_start();

	if($_SESSION['permission'] !== 'admin') {
		?> <h2>404</h2> <?php
	} else {
 ?>

<div class="container-bo" ng-controller="boCtrl">
	<div class="container-nav-bo">
		<a href=""  ng-click="show = 1">Créer un utilisateur</a>
		<a href="" ng-click="show = 2">Supprimer un utilisateur</a>
		<a href="" ng-click="show = 3">Créer une fiche Simplonien</a>
		<a href="" ng-click="show = 4">Modifier/supprimer une fiche Simplonien</a>

	</div>
	<div class="container-interface">
		<h1 ng-if="show === 0"> Welcome in your BackOffice Norbert!</h1>
		<form class="container-create-user" ng-submit="createAccount()" ng-show="show==1">
			<h2>Créer un utilisateur</h2>
	        		<input class="input-style" type="text" ng-model="boCreatePseudo" placeholder="Pseudo utilisateur (minimum 3 caractères)" required>
	        		<input class="input-style" type="password" ng-model="boCreateMdp" placeholder="Mot de passe utilisateur (minimum 6 caractères)" required >
	        		<input class="input-style" type="password" ng-model="boCreateMdpVerif" placeholder="Vérification mot de passe" required>
	        		<p class ="input-style" ng-if="boCreateMdp != boCreateMdpVerif ||  boCreateMdp.length < 6">Les mots de passe ne sont pas identiques ou inférieur à 6 caractères</p>
	        		<input class="input-style" value="Créer un utilisateur" type="submit">

		</form>
		<div class="container-delete-user" ng-show="show==2">
			<h2>Suppression d'un utilisateur</h2>
			<div class="container-users">
				<div class="cont-info" ng-repeat="user in users">
					<p class="cont-pseudo">{{user.pseudo}}</p>
					<p class="cont-perm">{{user.permission}}</p>
					<div class="delete-user" ng-click="deleteItem(user.id)" confirm="Are you sure ?"></div>
				</div>


			</div>
		</div>
		<form class="container-create-student" ng-submit="createSimplonien()" ng-show="show == 3">
			<h2>Créer une fiche de Simplonien</h2>
			<input class="input-style" placeholder="Nom" type="text" ng-model="boCreateLastName" required>
			<input class="input-style" placeholder="Prénom" ng-model="boCreateName" required>
			<input class="input-style" placeholder="Âge" ng-model="boCreateOld" required>
			<input class="input-style" placeholder="Ville" ng-model="boCreatePromo" required>
			<label for="photo">Upload photo</label>
			<input class="input-style" type="file" id="photo"  name="Photo" placeholder="Photo" ng-model="boCreatePhoto" >
			<input class="input-style" placeholder="Tags" ng-model="boCreateTags" required>
			<textarea class="input-style" placeholder="Description" ng-model="boCreateAbout" required></textarea>
			<input class="input-style" placeholder="Sexe" ng-model="boCreateSexe" required>
			<input class="input-style" placeholder="Domaine" ng-model="boCreateDomaine" required>
			<input class="input-style" placeholder="Specialite1" ng-model="boCreateSpeOne"required>
			<input class="input-style" placeholder="Specialite2" ng-model="boCreateSpeTwo"required>
			<input class="input-style" placeholder="Specialite3" ng-model="boCreateSpeThree"required>
			<input class="input-style" placeholder="Github" ng-model="boCreateGithub">
			<input class="input-style" placeholder="Linkedin" ng-model="boCreateLinkedin">
			<input class="input-style" placeholder="Portfolio" ng-model="boCreatePortfolio">
			<input class="input-style"  id="cv"  name="cv" placeholder="CV" ng-model="boCreateCV" >
			<input class="input-style" placeholder="Twitter" ng-model="boCreateTwitter">
			<input class="input-style" placeholder="StackOverFlow" ng-model="boCreateStackOverFlow">
			<input class="input-style" placeholder="Mail" ng-model="boCreateMail" required>
			<input class="input-style" placeholder="Contrat" ng-model="boCreateContrat" required>
			<input class="input-style" placeholder="DatePromo" ng-model="boCreateDatePromo"required="required">
			<input class="input-style" value="Créer une fiche Simplonien" type="submit">

		</form>
		<div class="cont-modify" ng-show="show === 5" >
				<h2>Modifier/supprimer la fiche Simplonien</h2>
				<input  id="boCreateLastNameSimploniens" class="input-style" value="{{infoSimploniens[0].Nom}}" placeholder="Nom" type="text"  required>
				<input id ="boCreateNameSimploniens" class="input-style" value="{{infoSimploniens[0].Prenom}}" placeholder="Prénom"  required>
				<input id ="boCreateOldSimploniens" class="input-style" value="{{infoSimploniens[0].Age}}" placeholder="Âge" required>
				<input id ="boCreatePromoSimploniens" class="input-style" value="{{infoSimploniens[0].Ville}}" placeholder="Ville" required>
				<input id ="boCreatePhotoSimploniens" class="input-style" type="text" id="photo"  name="Photo" value="{{infoSimploniens[0].Photo}}" placeholder="Photo"  >
				<input  id ="boCreateTagsSimploniens"class="input-style" placeholder="Tags" value="{{infoSimploniens[0].Tags}}"  required>
				<textarea id ="boCreateAboutSimploniens" class="input-style" placeholder="Description"  required>{{infoSimploniens[0].Description}}</textarea>
				<input id ="boCreateSexeSimploniens" class="input-style" value="{{infoSimploniens[0].Sexe}}" placeholder="Sexe"  required>
				<input id ="boCreateDomaineSimploniens" class="input-style" value="{{infoSimploniens[0].Domaine}}" placeholder="Domaine" ng- required>
				<input  id ="boCreateSpeOneSimploniens" class="input-style" placeholder="Specialite1" value="{{infoSimploniens[0].Specialite1}}" required>
				<input id ="boCreateSpeTwoSimploniens" class="input-style" placeholder="Specialite2" value="{{infoSimploniens[0].Specialite2}}" required>
				<input  id ="boCreateSpeThreeSimploniens"class="input-style" placeholder="Specialite3" value="{{infoSimploniens[0].Specialite3}}" required>
				<input id ="boCreateGithubSimploniens" class="input-style" value="{{infoSimploniens[0].Github}}" placeholder="Github" required>
				<input id ="boCreateLinkedinSimploniens" class="input-style" value="{{infoSimploniens[0].Linkedin}}" placeholder="Linkedin" required>
				<input id ="boCreatePortfolioSimploniens" class="input-style" value="{{infoSimploniens[0].Portfolio}}" placeholder="Portfolio" >
				<input id ="boCreateCVSimploniens" class="input-style" value="{{infoSimploniens[0].CV}}" id="cv"  name="cv" placeholder="CV" >
				<input id ="boCreateTwitterSimploniens" class="input-style" value="{{infoSimploniens[0].Twitter}}" placeholder="Twitter">
				<input id ="boCreateStackOverFlowSimploniens" class="input-style" value="{{infoSimploniens[0].StackOverFlow}}" placeholder="StackOverFlow">
				<input id ="boCreateMailSimploniens" class="input-style" value="{{infoSimploniens[0].Mail}}" placeholder="Mail" required>
				<input id ="boCreateContratSimploniens" class="input-style" value="{{infoSimploniens[0].Contrat}}" placeholder="Contrat"  required>
				<input id ="boCreateDatePromoSimploniens" class="input-style" value="{{infoSimploniens[0].DatePromo}}" placeholder="DatePromo" required="required">
				<input class="input-style"  value="Modifier une fiche Simplonien" type="submit" ng-click="sendModif(simplonien.id)">

		</div>
		<div class="container-delete-user" ng-show="show==4">
			<h2>Supprimer une fiche d'un Simplonien</h2>
			<div class="container-users">
				<div class="cont-info" ng-repeat="simplonien in simploniens">
					<p class="cont-pseudo">{{simplonien.nom}}</p>
					<p class="cont-perm">{{simplonien.prenom}}</p>
					<p class="cont-perm">{{simplonien.ville}}</p>
					<button class="modify" ng-click="modify(simplonien.id)">Modifier</button>
					<div class="delete-user" ng-click="deleteSimplonien(simplonien.id)" confirm="Are you sure ?"></div>

			</div>
		</div>

	</div>

 </div>
<?php } ?>
