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
        type: 'HTML/CSS',
        active: false,
    }, {
        type: 'PHP',
        active: false,
    }, {
        type: 'Angular',
        active: false,
    }, {
        type: 'REACT',
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

    $scope.togglePromo = false;
    $scope.toggleLangage = false;
    $scope.toggleContrat = false;

    if ($(window).width() > 640) {
        $('.filterRight').css('display', 'block');
    }

    $scope.changeState = function() {
        if (this.theme.name === 'Promo') {
            this.theme.active = true;
            $scope.themes[1].active = false;
            $scope.themes[2].active = false;
            if ($(window).width() < 640 && $scope.togglePromo === false) {
                $('.filterRight').css('display', 'block');
                $scope.togglePromo = true;
                $scope.toggleLangage = false;
                $scope.toggleContrat = false;
            } else if ($(window).width() < 640 && $scope.togglePromo === true) {
                $('.filterRight').css('display', 'none');
                $scope.togglePromo = false;
            }
        } else if (this.theme.name === 'Langage') {
            this.theme.active = true;
            $scope.themes[0].active = false;
            $scope.themes[2].active = false;
            if ($(window).width() < 640 && $scope.toggleLangage === false) {
                $('.filterRight').css('display', 'block');
                $scope.togglePromo = false;
                $scope.toggleLangage = true;
                $scope.toggleContrat = false;
            } else if ($(window).width() < 640 && $scope.toggleLangage === true) {
                $('.filterRight').css('display', 'none');
                $scope.toggleLangage = false;
            }
        } else if (this.theme.name === 'Contrat') {
            this.theme.active = true;
            $scope.themes[0].active = false;
            $scope.themes[1].active = false;
            if ($(window).width() < 640 && $scope.toggleContrat === false) {
                $('.filterRight').css('display', 'block');
                $scope.togglePromo = false;
                $scope.toggleLangage = false;
                $scope.toggleContrat = true;
            } else if ($(window).width() < 640 && $scope.toggleContrat === true) {
                $('.filterRight').css('display', 'none');
                $scope.toggleContrat = false;
            }
        }
    };

    $scope.searchSchool = [];
    $scope.searchLangage = [];
    $scope.searchContrat = [];
    var searchResult = {
        Langage: [],
        Ville: "",
        Contrat: [],
    };

    $scope.changeFilterSchool = function() {
        if (searchResult.Ville.length === 0) {
            if (this.school.active === false) {
                this.school.active = true;
                searchResult.Ville = this.school.ville;
                searchFilter();
            } else if (this.school.active === true) {
                this.school.active = false;
                searchResult.Ville = "";
                searchFilter();
            }
        } else if (searchResult.Ville.length > 1) {
            if (this.school.active === true) {
                this.school.active = false;
                searchResult.Ville = "";
                searchFilter();
            }
        }
    };


    $scope.changeFilterLangage = function() {
        if (searchResult.Langage.length < 3) {
            if (this.langage.active === false) {
                this.langage.active = true;
                searchResult.Langage.push(this.langage.type);
                searchFilter();
            } else if (this.langage.active === true) {
                this.langage.active = false;
                var index = searchResult.Langage.indexOf(this.langage.type);
                if (index > -1) {
                    searchResult.Langage.splice(index, 1);
                }
                searchFilter();
            }
        } else if (searchResult.Langage.length >= 3) {
            this.langage.active = false;
            var index = searchResult.Langage.indexOf(this.langage.type);
            if (index > -1) {
                searchResult.Langage.splice(index, 1);
            }
            searchFilter();
        }
    };

    $scope.changeFilterContrat = function() {
        if (searchResult.Contrat.length < 3) {
            if (this.contrat.active === false) {
                this.contrat.active = true;
                searchResult.Contrat.push(this.contrat.type);
                searchFilter();
            } else if (this.contrat.active === true) {
                this.contrat.active = false;
                var index = searchResult.Contrat.indexOf(this.contrat.type);
                if (index > -1) {
                    searchResult.Contrat.splice(index, 1);
                }
                searchFilter();
            }
        } else if (searchResult.Contrat.length >= 3) {
            this.contrat.active = false;
            var index = searchResult.Contrat.indexOf(this.contrat.type);
            if (index > -1) {
                searchResult.Contrat.splice(index, 1);
            }
            searchFilter();
        }
    };

    var searchFilter = function() {
        $http.post(serviceApi.filter, searchResult)
            .then(
                function(response) {
                  $scope.data = response.data;
                },
                function(err) {
                    console.log("C'est la merde!");
                }
            );
            console.log($scope.data);
    }

}]);
