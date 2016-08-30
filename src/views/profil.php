<?php
	session_start();
 ?>
<div class="main-container-profil" ng-controller="profilCtrl">
	<div class="conatiner-left-profil"></div>
	<div class="container-middle-profil">
		<div class="profil-pic"><img src="./assets/images/{{student[0].Photo}}"></div>
		<h2>{{student[0].Prenom}} {{student[0].Nom}}</h2>
		<p class="spe">{{student[0].Domaine}}</p>
		<p class="age">{{student[0].Age}} ans</p>
		<div class="line"></div>
		<p class="comp">#{{student[0].Specialite1}} #{{student[0].Specialite2}} #{{student[0].Specialite3}}</p>
		<div class="container-social">
		<a ng-href="{{student[0].Github}}">	 <div class="github" ></div></a>
		<a ng-href="{{student[0].CV}}">	<div class="cv"></div></a>
		<a ng-href="{{student[0].Linkedin}}">	<div class="linkedin"></div></a>
		</div>
		<p class="description">{{student[0].Description}}</p>
		<div class="line"></div>
		<div class="main-cont-tags">
			<div class="cont-tags">
				<h4 class="title-comp">Compétences</h4>
				<p ng-repeat="comp in student">{{comp.Tags}}</p>
			</div>
		</div>
		<h4 class="projects">Projets</h4>
		<div class="cont-project">
			<div class="project"></div>
			<div class="project"></div>
			<div class="project"></div>
		</div>
		<button data-toggle="modal" data-target="#contactDirect">Contacter {{student[0].Prenom}}</button>
	</div>
	<div class="container-right-profil" ng-style="{'background-image':'url(./assets/images/'+student[0].Photo+')'}">
		<div class="linear">
		</div>
	</div>


	<div class="modal fade" id='contactDirect' tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="contactStudent">
					<div class="logbox logBoxStyle" ng-if="contactStud === 1">
						<form class="signup" method="post" name="form">
							<div class="profil-pic" ng-style="{'background-image':'url(./assets/images/'+student[0].Photo+')'}"></div>
							<h1>Ecrire à {{student[0].Prenom}} {{student[0].Nom}}</h1>
							<p ng-if='verifChamps === true'>Veuillez remplir tous les champs...</p>
							<input class="inputMail" type="email" name="email" placeholder="Votre email..." >
							<textarea name="name" class="textAreaMail" rows="8" cols="40" placeholder="Ecrivez votre message ici..."></textarea>
							<input type="submit" name="name" ng-click="contactStudent()" value="Envoyer!">
						</form>
					</div>
					<div class="logbox confirmContact" ng-if="contactStud === 2">
						<p>
							Message envoyé!
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
