<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Adopte un Simplonien</title>
	<meta name="description" content="Le site AdopteUnSimplonien.fr permet aux entreprises d'avoir un lien direct avec les élèves de l'école Simplon en recherchent de contrat (CDD/CDI/Contrat Pro/Stage)" />
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="lib/css/bootstrap.css">
	<link rel="icon" type="image/png" href="assets/images/logoSimplon.png" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script src="lib/js/angular.min.js"></script>
	<script src="lib/js/angular-animate.min.js"></script>
	<script src="lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/angular-route.js"></script>
	<!-- <script src='lib/js/angular-modal-service.min.js'></script> -->
	<script src='lib/js/bootstrap.min.js'></script>

	<script src="assets/js/min/app.min.js"></script>
	<script src="assets/js/min/searchCtrl.min.js"></script>
	<script src="assets/js/min/scrollSticky.min.js"></script>
	<script src="assets/js/min/BoCtrl.min.js"></script>
	<script src="assets/js/min/contactCtrl.min.js"></script>
	<script src="assets/js/min/profilCtrl.min.js"></script>
	<script src="assets/js/min/scrollDirective.min.js"></script>
	<script src="assets/js/min/projectCtrl.min.js"></script>
	<script src="assets/js/min/confirmPassword.min.js"></script>
	<script src="assets/js/min/BackgroundImageDirective.min.js"></script>
	<script src="assets/js/min/adminCreate.min.js"></script>
	<script src="assets/js/min/signInUpCtrl.min.js"></script>
	<!-- <script src='assets/js/min/indexCtrl.min.js'></script> -->

	<script src="assets/js/min/serviceApi.min.js"></script>
	<!-- <script src="assets/js/min/serviceAdmin.min.js"></script> -->
	<script src="assets/js/min/searchFilter.min.js"></script>
	<script src='lib/js/ui-bootstrap.js'></script>
</head>

<body ng-app="AdopteUnSimplonien" ng-controller="signInUpCtrl">

	<!-- Desktop navbar -->
	<div class="nav-container">
		<!-- <img src="assets/images/bars.svg" alt="" class="burger-menu-icon" id="burger-open"> -->
		<div class="burgerMenu">
			<div id="menu-button" role="button" title="sweet hamburger">
				<div class="hamburger">
					<div class="inner"></div>
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="#/">Home</a></li>
					<li><a href="#/search">Simploniens</a></li>
					<li><a href="#/project">Qui sommes-nous?</a></li>
					<li><a href="#/contact">Contact</a></li>
				</ul>
			</nav>
		</div>

		<div class="page-container-left">
			<a href="#/">Home</a>
			<a href="#/search">Simploniens</a>
			<a href="#/project">Qui sommes nous</a>
			<a href="#/contact">Contact</a>
		</div>
		<?php if(isset($_SESSION['pseudo'])) { ?>
			<p style="color:white">Bienvenue <?php echo $_SESSION['pseudo'] ?></p>
			<a href="../server/deconnection.php" class="user-icon">Deconnexion</a>
			<?php if( $_SESSION['permission'] === 'admin') { ?>
			<a href="#/backOffice" class="user-icon">Back Office</a><?php } ?>
		<?php }else{?>
			<a class="user-icon" ng-click="logBox()" data-toggle="modal" data-target="#signInUp">Espace Perso</a>
		<?php } ?>	</div>

	<!-- Ng-VIEW -->
	<div class="main-container" ng-view></div>

	<!-- Footer -->
	<div class="footer-container">
		<div class="footer_item-container">
			<a target="_blank" href="http://simplon.co/" class="logo"></a>
			<a target="_blank" href="https://www.facebook.com/Simplon.co/?fref=nf" class="facebook-icon"></a>
			<a target="_blank" href="https://twitter.com/simplonco" class="twiter-icon"></a>
			<a target="_blank" href="https://plus.google.com/+Simplon-co-youtube/about" class="google-icon"></a>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id='signInUp' tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="signInUp">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="logbox" ng-if="signToggle === 2">
						<form class="signup" method="post"  name="form" action="#/">
							<h1>Créer un compte</h1>
							<input  id="pseudo" type="text" placeholder="Pseudo" pattern="^[\w]{3,16}$" autofocus="autofocus" required class="inputSign" />


							<input id="mdp" data-ng-model='user.password' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='password' placeholder="Mot de passe" required>
							<input id="mdp-verif" ng-model='boCreateMdpVerif' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='confirm_password' placeholder="Confirmer mot de passe">

							<input  id="pseudo" type="text" placeholder="Pseudo" pattern="^[\w]{3,16}$" autofocus="autofocus" required class="inputSign" ng-model="CreatePseudo" />
							<input id="mdp"  ng-model='CreateMdp' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='password' placeholder="Mot de passe" required>
							<input ng-model='boCreateMdpVerif' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='confirm_password' placeholder="Confirmer mot de passe"
											required data-password-verify="user.password">
							<input type="submit" value="Inscription!" class="inputButton" ng-click="createAccount()" />
							<a ng-click="logBox()">Déjà inscrit?</a>
						</form>
					</div>
					<div class="logbox" ng-if="signToggle === 1">
						<form class="signup" method="post" action="../server/connection.php">
							<h1>Connexion</h1>
							<?php if($_SESSION['permission'] !== 'user' || $_SESSION['permission'] !== 'admin') { ?>
							<p>
								Vous devez vous connecter pour voir les profils complets des simploniens!
							</p>
									<?php } ?>
							<input type="text" name="pseudo" placeholder="Adresse email" class="inputSign" required />
							<input type="password" name="password" placeholder="Mot de passe" required class="inputSign" />
							<input type="hidden" name="page" value="dist/index.php">
							<input type="submit" value="Connexion!" class="inputButton" />
							<a ng-click="signBox()">Pas encore inscrit?</a>
						</form>
					</div>
					<div class="logbox confirm" ng-if= 'signToggle === 3'>
						<p>Vous êtes inscrit!</p>
						<p> Vous pouvez désormais voir les fiches des simploniens et les contacter directement!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
