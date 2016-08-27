<div class="cont-simplon-description" ng-controller="projectCtrl">
	<p class="title-simplon" ng-click="showTop()" ng-class="{'title-simplon-closed': showDescription}">SIMPLON.CO ?</p>
	<div class="cont-img-description cont-img" ng-class="{'cont-img-description-simple':showDescription}">
		<div class="mask" ng-class="{'mask-is-open': showDescription}">
			<div class="cross-close" ng-click="showTop()"></div>
		</div>
		<div class="generic-cont-description description-simlpon" ng-class="{'description-simlpon-is-open': showDescription}">
			<p class="corpus-description">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.</p>
			<p class="end-description">FABRIQUE DE TALENTS 3.0</p>
		</div>
		<div class="mask2" ng-class="{'mask2-is-open': showDescription}"></div>
	</div>
	<p class="title-recrutement" ng-click="showDown()" ng-class="{'title-recrutement-closed': showDescription2}">ADOPTEZ UN SIMLONIEN</p>
	<div class="cont-img-description-down cont-img">
		<div class="mask" ng-class="{'mask-is-open': showDescription2}">
		<div class="cross-close" ng-click="showDown()"></div>
		</div>
		<div class="generic-cont-description description-simlpon" ng-class="{'description-simlpon-is-open': showDescription2}">
			<p class="corpus-description">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.</p>
			<p class="end-description">FABRIQUE DE TALENTS 3.0</p>
		</div>
	<div class="mask2" ng-class="{'mask2-is-open': showDescription2}"></div>
	</div>
</div>
