<?php
	session_start();
 ?>

<div class="searchPage" ng-controller='searchCtrl'>
    <div class="searchBar">
        <div class="filterMain">
            <form class="inputForm">
                <div class="searchImage"></div>
                <input ng-model="searchStudent" placeholder="Nom, langage, ville...">
            </form>
            <div class="flex">
                <div class="filterChoice">
                    <div class="filterTheme">
                        <div ng-click="changeState(); toggle()" ng-repeat="theme in themes track by $index" ng-class="{'promo': ($index === 0), 'langage': ($index === 1), 'contrat': ($index === 2)}">
                            <div ng-show="theme.active" class="triangle"></div>
                        </div>
                        <div class="gradient"></div>
                    </div>
                </div>
                <div class="filterRight">
                    <div class="filter" ng-if="themes[0].active === true">
                        <input ng-click="changeFilterSchool()" ng-model="schoolData" type="button" value="{{school.ville}}" name="button" ng-repeat="school in schools" ng-class="{'buttonFilterOff': !school.active, 'buttonFilterOn' : school.active}">
                    </div>
                    <div class="filter" ng-if="themes[1].active === true">
                        <input ng-click="changeFilterLangage()" type="button" value="{{langage.type}}" name="button" ng-repeat="langage in langages" ng-class="{'buttonFilterOff': !langage.active, 'buttonFilterOn' : langage.active}">
                    </div>
                    <div class="filter" ng-if="themes[2].active === true">
                        <input ng-click="changeFilterContrat()" type="button" value="{{contrat.type}}" name="button" ng-repeat="contrat in contrats" ng-class="{'buttonFilterOff': !contrat.active, 'buttonFilterOn' : contrat.active}">
                    </div>
                </div>
            </div>
        </div>
        <div class="cardPage">
					<div class="tagSearch"></div>
            <?php if($_SESSION['permission'] === 'user' || $_SESSION['permission'] === 'admin') { ?>
            <a class="card" href="#/profil{{student.id}}" ng-repeat="student in data | filter:searchStudent:q track by $index">
                <?php } else { ?>
                <a class="card" data-toggle="modal" data-target="#signInUp" ng-repeat="student in data | filter:searchStudent:q track by $index">
                    <?php } ?>
                <div class="topCard">
                    <div class="studentPic"><img src="assets/images/{{student.photo}}" /></div>
                    <h3>{{student.nomPrenom}}</h3>
                    <p> {{student.ville}}</p>
                    <p>Recherche: <strong>{{student.contrat}}</strong></p>
                </div>
                <div class="botCard">
                    <p>#{{student.specialite1}}</p> <p>#{{student.specialite2}}</p> <p>#{{student.specialite3}}</p>
                </div>
            </a>
        </div>
    </div>
</div>
