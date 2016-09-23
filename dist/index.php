<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- TITLE -->
	<title>Adopte un Simplonien</title>
	<!-- META -->
	<meta name="description" content="Le site AdopteUnSimplonien.fr permet aux entreprises d'avoir un lien direct avec les élèves de l'école Simplon en recherchent de contrat (CDD/CDI/Contrat Pro/Stage)" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<!-- LIB -->
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="lib/css/bootstrap.css">
	<!-- LOGO -->
	<link rel="icon" type="image/png" href="assets/images/logoSimplon.png" />
	<!-- LIB -->
	<script src='lib/js/ui-bootstrap.js'></script>
	<script src="lib/js/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.15.0/lodash.js"></script>
	<script src="lib/js/angular-animate.min.js"></script>
	<script src="lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/angular-route.js"></script>
	<script src='lib/js/bootstrap.min.js'></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2HIhxJzwOMeqTQyzgzRQP3RAMlAD0By0&callback=initMap" async defer></script>
	<script src="https://use.fontawesome.com/2add07b476.js"></script>
	<!-- app.js -->
	<script src="assets/js/min/app.min.js"></script>
	<!-- Controllers -->
	<script src="assets/js/min/homeCtrl.min.js"></script>
	<script src="assets/js/min/searchCtrl.min.js"></script>
	<script src="assets/js/min/BoCtrl.min.js"></script>
	<script src="assets/js/min/contactCtrl.min.js"></script>
	<script src="assets/js/min/profilCtrl.min.js"></script>
	<script src="assets/js/min/projectCtrl.min.js"></script>
	<script src="assets/js/min/signInUpCtrl.min.js"></script>
	<!-- Directives -->
	<script src="assets/js/min/confirmPassword.min.js"></script>
	<script src="assets/js/min/BackgroundImageDirective.min.js"></script>
	<script src="assets/js/min/adminCreate.min.js"></script>
	<script src="assets/js/min/scrollDirective.min.js"></script>
	<script src="assets/js/min/searchFilter.min.js"></script>
	<!-- Services -->
	<script src="assets/js/min/serviceApi.min.js"></script>
	<!-- Jquery -->
	<script src="assets/js/min/jqueryStuff.min.js"></script>


</head>

<body ng-app="AdopteUnSimplonien" ng-controller="signInUpCtrl">

	<!-- Desktop navbar -->
	<div class="nav-container">

		<!-- Menu Burger -->
		<div class="burgerMenu">
			<div id="menu-button" role="button" title="sweet hamburger">
				<div class="hamburger">
					<div class="inner"></div>
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="#/">Home</a></li>
					<li><a href="#/search">Nos simploniens</a></li>
					<li><a href="#/project">Qui sommes-nous?</a></li>
					<li><a href="#/contact">Contact</a></li>
				</ul>
			</nav>
		</div>

		<!-- NavBar classique -->
		<div class="page-container-left containerNav borderXwidth">
			<a href="#/">Home</a>
			<a href="#/search">Nos simploniens</a>
			<a href="#/project">Qui sommes-nous?</a>
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
						<h1>Créer un compte</h1>
						<form class="signup" method="post"  name="form">
							<p ng-if="verifPass === false">Vos mots de passe ne sont pas identique</p>
							<input id="pseudo" type="text" placeholder="Pseudo" autofocus="autofocus" required class="inputSign" />
-             <input id="mdp" data-ng-model='user.password' type="password" ng-class="{'inputSignError' : 			  form.confirm_password.$error.passwordVerify, 'inputSign':!form.confirm_password.$error.passwordVerify}" name='password' placeholder="Mot de passe" required>
-              <input id="mdp-verif" ng-model='user.password_verify' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='confirm_password' placeholder="Confirmer mot de passe" required data-password-verify="user.password">
							<input type="submit" value="Inscription!" class="inputButton" ng-click="createAccount()" />
							<a ng-click="logBox()">Déjà inscrit?</a>
						</form>
					</div>
					<div class="logbox" ng-if="signToggle === 1">
						<h1>Connexion</h1>
						<form class="signup" action='server/connection.php' method="post">
							<?php if($_SESSION['permission'] !== 'user' || $_SESSION['permission'] !== 'admin') { ?>
							<p>
								Vous devez vous connecter pour voir les profils complets des simploniens!
							</p>
									<?php } ?>
							<input type="text" id="connectPseudo" name="pseudo" placeholder="Adresse email" class="inputSign" required />
							<input type="password" id="connectMdp" name="password" placeholder="Mot de passe" required class="inputSign" />
							<input type="submit" ng-click="loginPost()" value="Connexion!" class="inputButton" />
							<a ng-click="signBox()">Pas encore inscrit?</a>
						</form>
					</div>
					<div class="logbox confirm" ng-if= 'signToggle === 3'>
						<p>Vous êtes désormais inscrit!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
