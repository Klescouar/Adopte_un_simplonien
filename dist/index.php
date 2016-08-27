<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Adopte un Simplonien</title>
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="lib/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script src="lib/js/angular.min.js"></script>
	<script src="lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/angular-route.js"></script>
	<!-- <script src='lib/js/angular-modal-service.min.js'></script> -->
	<script src='lib/js/bootstrap.min.js'></script>

	<script src="assets/js/min/app.min.js"></script>
	<script src="assets/js/min/searchCtrl.min.js"></script>
	<script src="assets/js/min/scrollSticky.min.js"></script>
	<script src="assets/js/min/boCtrl.min.js"></script>
	<script src="assets/js/min/contactCtrl.min.js"></script>
	<script src="assets/js/min/profilCtrl.min.js"></script>
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

<body ng-app="AdopteUnSimplonien">

	<!-- Burger Menu -->

	<!-- <div class="burger-menu closed">
		<img src="assets/images/close-button.svg" alt="" class="burger-menu-close-icon" id="burger-close">
		<div class="burger-menu_items">
			<a href="#/">Home</a>
			<a href="#/search">Simploniens</a>
			<a href="#/project">Qui sommes-nous?</a>
			<a href="#/contact">Contact</a>
			<a href="">Se connecter</a>
		</div>
	</div> -->

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
			<a href="#/backOffice" class="user-icon">Back Office</a>
		<?php }else{?>
			<a class="user-icon" data-toggle="modal" data-target="#signInUp">Espace Perso</a>
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
				<div class="signInUp" ng-controller="signInUpCtrl">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="logbox" ng-if="signToggle">
						<form class="signup" method="post" action="/signup" name="form">
							<h1>Créer un compte</h1>
							<input type="text" placeholder="Pseudo" pattern="^[\w]{3,16}$" autofocus="autofocus" required class="inputSign" />


							<input data-ng-model='user.password' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='password' placeholder="Mot de passe" required>
							<input ng-model='user.password_verify' type="password" ng-class="{'inputSignError' : form.confirm_password.$error.passwordVerify, 'inputSign' : !form.confirm_password.$error.passwordVerify}" name='confirm_password' placeholder="Confirmer mot de passe"
											required data-password-verify="user.password">
							<!-- <input type="email" placeholder="Adresse email" class="inputSign" required/> -->
							<input type="submit" value="Inscription!" class="inputButton" />
							<a ng-click="logBox()">Déjà inscrit?</a>
						</form>
					</div>
					<div class="logbox" ng-if="!signToggle">
						<form class="signup" method="post" action="../server/connection.php">
							<h1>Connexion</h1>
							<?php if($_SESSION['permission'] !== 'user' || $_SESSION['permission'] !== 'admin') { ?>
							<p>
								Vous devez vous connecter pour voir les profils complets des simploniens!
							</p>
									<?php } ?>
							<input type="email" name="pseudo" placeholder="Adresse email" class="inputSign" required />
							<input type="password" name="password" placeholder="Mot de passe" required class="inputSign" />
							<input type="hidden" name="page" value="dist/index.php">
							<input type="submit" value="Connexion!" class="inputButton" />
							<a ng-click="signBox()">Pas encore inscrit?</a>
						</form>
					</div>
				</div>

				<!-- <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        <p>One fine body&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div> -->
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</body>

</html>
