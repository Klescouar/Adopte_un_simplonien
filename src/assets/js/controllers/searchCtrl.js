app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $http.get(serviceApi.api)
        .then(
            function(response) {
                $scope.data = response.data;
            },
            function(err) {
                console.log("C'est la merde!");
            });

    $scope.schools = serviceApi.schools;

    $scope.themes = [{
        name: 'Promo',
        active: true,
    }, {
        name: 'Langage',
        active: false,
    }, {
        name: 'Contrat',
        active: false,
    }];


    $scope.langages = [{
        type: 'Javascript',
        active: false,
    }, {
        type: 'HTML',
        active: false,
    }, {
        type: 'CSS',
        active: false,
    }, {
        type: 'PHP',
        active: false,
    }, {
        type: 'Javascript',
        active: false,
    }, {
        type: 'Angular',
        active: false,
    }, {
        type: 'Montreuil',
        active: false,
    }, {
        type: 'Typescript',
        active: false,
    }, {
        type: 'Jquery',
        active: false,
    }, {
        type: 'PHP',
        active: false,
    }, {
        type: 'symphony',
        active: false,
    }, {
        type: 'JAVA',
        active: false,
    }, {
        type: 'C#',
        active: false,
    }, {
        type: 'C++',
        active: false,
    }, {
        type: 'C',
        active: false,
    }, {
        type: 'SASS',
        active: false,
    }, {
        type: 'Gulp',
        active: false,
    }, {
        type: 'Grunt',
        active: false,
    }, {
        type: 'Jade',
        active: false,
    }, ];

    $scope.contrats = [{
        type: 'CDD',
        active: false,
    }, {
        type: 'CDI',
        active: false,
    }, {
        type: 'Contrat Pro',
        active: false,
    }, {
        type: 'Stage',
        active: false,
    }, {
        type: 'Freelance',
        active: false,
    }, ];

    $scope.changeState = function() {
        if (this.theme.name === 'Promo') {
            this.theme.active = true;
            $scope.themes[1].active = false;
            $scope.themes[2].active = false;
        } else if (this.theme.name === 'Langage') {
            this.theme.active = true;
            $scope.themes[0].active = false;
            $scope.themes[2].active = false;
        } else if (this.theme.name === 'Contrat') {
            this.theme.active = true;
            $scope.themes[0].active = false;
            $scope.themes[1].active = false;
        }
    };

    $scope.searchTag = [];


    $scope.changeFilterSchool = function() {
        if (this.school.active === false) {
            this.school.active = true;
            $scope.searchTag.push(this.school.ville);
        } else {
            this.school.active = false
            var index = $scope.searchTag.indexOf(this.school.ville);
            if (index > -1) {
                $scope.searchTag.splice(index, 1);
            };
        };
        $scope.searchTagFilter = $scope.searchTag.toString().replace(/\,/g, ' ');
    };

    $scope.changeFilterLangage = function() {
        if (this.langage.active === false) {
            this.langage.active = true;
            $scope.searchTag.push(this.langage.type);
        } else {
            this.langage.active = false
            var index = $scope.searchTag.indexOf(this.langage.type);
            if (index > -1) {
                $scope.searchTag.splice(index, 1);
            };
        };
        $scope.searchTagFilter = $scope.searchTag.toString().replace(/\,/g, ' ');
    };

    $scope.changeFilterContrat = function() {
        if (this.contrat.active === false) {
            this.contrat.active = true;
            $scope.searchTag.push(this.contrat.type);
        } else {
            this.contrat.active = false
            var index = $scope.searchTag.indexOf(this.contrat.type);
            if (index > -1) {
                $scope.searchTag.splice(index, 1);
            };
        };
        $scope.searchTagFilter = $scope.searchTag.toString().replace(/\,/g, ' ');
    };

}]);
