app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $http.get(serviceApi.api)
        .then(
            function(response) {
                $scope.data = response.data;
            },
            function(err) {
                console.log("C'est la merde!");
            });

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

    $scope.schools = [{
        ville: 'Montreuil',
    }, {
        ville: 'Boulogne sur mer',
    }, {
        ville: 'Roubaix',
    }, {
        ville: 'Noyon',
    }, {
        ville: 'Troyes',
    }, {
        ville: 'Epinal',
    }, {
        ville: 'Rennes',
    }, {
        ville: 'Vannes',
    }, {
        ville: 'Indre',
    }, {
        ville: 'Villeurbanne',
    }, {
        ville: 'Lozère',
    }, {
        ville: 'Alès',
    }, {
        ville: 'Lunel',
    }, {
        ville: 'Toulouse',
    }, {
        ville: 'Hérault',
    }, {
        ville: 'Narbonne',
    }, {
        ville: 'Marseille',
    }, {
        ville: 'Nice',
    }];

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


}]);
