<div id="back-office" ng-controller="BoCtrl">
    <div id="create-user">
        <form ng-submit="createAccount()">
            <input type="text" placeholder="pseudo" ng-model="boCreatePseudo">
            <input type="password" placeholder="mot de passe" ng-model="boCreateMdp">
            <input type="password" placeholder="confirmation mot de passe" ng-model="boCreateVerifMdp">
            <input type="submit" value="Valider">
            <input type="button" name="name" value="" ng-click="createAccount()">
        </form>
    </div>
</div>
