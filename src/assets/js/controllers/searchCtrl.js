app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.schools = serviceApi.schools;
    $scope.contrat = serviceApi.contrat;
    $scope.langages = serviceApi.langages;
    $scope.themes = serviceApi.themes;
    $scope.togglePromo = false;
    $scope.toggleLangage = false;
    $scope.toggleContrat = false;
    $scope.searchResult = {
        Langage: [],
        Ville: "",
        Contrat: [],
    };

    // Récupération de l'api contenant les cards et toutes leurs infos.
    $http.get(serviceApi.api)
        .then(
            function(response) {
                $scope.data = response.data;
                $scope.cardFull = response.data;
            },
            function(err) {
                console.log("C'est la merde!");
            });


    // Comparaison entre les cards et les filtres sélectionné par l'utilisateur et restitution des cards filtrés.
    var searchFilter = function() {
        $scope.data = [];

        // Stockage des infos de searchResult (l'objet où sont stocké les filtres sélectionnés) dans des variables indépendantes.
        var lang1 = typeof $scope.searchResult.Langage[0] !== 'undefined' ? $scope.searchResult.Langage[0] : '';
        var lang2 = typeof $scope.searchResult.Langage[1] !== 'undefined' ? $scope.searchResult.Langage[1] : '';
        var lang3 = typeof $scope.searchResult.Langage[2] !== 'undefined' ? $scope.searchResult.Langage[2] : '';
        var ville = typeof $scope.searchResult.Ville !== 'undefined' ? $scope.searchResult.Ville : '';
        var contrat1 = typeof $scope.searchResult.Contrat[0] !== 'undefined' ? $scope.searchResult.Contrat[0] : '';
        var contrat2 = typeof $scope.searchResult.Contrat[1] !== 'undefined' ? $scope.searchResult.Contrat[1] : '';
        var contrat3 = typeof $scope.searchResult.Contrat[2] !== 'undefined' ? $scope.searchResult.Contrat[2] : '';
        var contrat4 = typeof $scope.searchResult.Contrat[3] !== 'undefined' ? $scope.searchResult.Contrat[3] : '';
        var contrat5 = typeof $scope.searchResult.Contrat[4] !== 'undefined' ? $scope.searchResult.Contrat[4] : '';
        
        // On parcourt chaque card contenu dans la variable cardFull, on mets en place d'une STRING dans la variable 'recherche' contenant toutes les infos de la card afin de comparer celle ci avec les tags des variables ci dessus. Si la comparaison match, on push la card dans $scope.data et elle sera affichée dans le front.
        angular.forEach($scope.cardFull, function(value, key) {
            var recherche = value.contrat + ' ' + value.specialite1 + ' ' + value.specialite2 + ' ' + value.specialite3 + ' ' + value.ville;
            if (recherche.match("^(?=.*" + lang1 + ")(?=.*" + lang2 + ")(?=.*" + lang3 + ")(?=.*" + ville + ")(?=.*" + contrat1 + ")(?=.*" + contrat2 + ")(?=.*" + contrat3 + ")(?=.*" + contrat4 + ")(?=.*" + contrat5 + ")", "i")) {
                $scope.data.push(value);
            };
        });
    };

    searchFilter();

    // Changer la view des onglets. Ville/Langage/Contrat.
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

    // Selectionner les tags correspondant aux villes.
    $scope.changeFilterSchool = function() {
        if (this.school.active === true) {
            this.school.active = false;
            $scope.searchResult.Ville = "";
            searchFilter();
        } else {
            if ($scope.searchResult.Ville.length === 0) {
                this.school.active = true;
                $scope.searchResult.Ville = this.school.ville;
                searchFilter();
            } else if ($scope.searchResult.Ville.length > 0) {
                for (var i = 0; i < $scope.schools.length; i++) {
                    $scope.schools[i].active = false;
                    this.school.active = true;
                    $scope.searchResult.Ville = this.school.ville;
                }
                searchFilter();
            }
        }
    }

    // Selectionner les tags correspondant aux langages.
    $scope.changeFilterLangage = function() {
        if ($scope.searchResult.Langage.length < 3) {
            if (this.langage.active === false) {
                this.langage.active = true;
                $scope.searchResult.Langage.push(this.langage.type);
                searchFilter();
            } else if (this.langage.active === true) {
                this.langage.active = false;
                var index = $scope.searchResult.Langage.indexOf(this.langage.type);
                if (index > -1) {
                    $scope.searchResult.Langage.splice(index, 1);
                }
                searchFilter();
            }
        } else if ($scope.searchResult.Langage.length >= 3) {
            this.langage.active = false;
            var index = $scope.searchResult.Langage.indexOf(this.langage.type);
            if (index > -1) {
                $scope.searchResult.Langage.splice(index, 1);
            }
            searchFilter();
        }
    };

    // Selectionner les tags correspondant aux contrats.
    $scope.changeFilterContrat = function() {
        if ($scope.searchResult.Contrat.length < 3) {
            if (this.contrat.active === false) {
                this.contrat.active = true;
                $scope.searchResult.Contrat.push(this.contrat.type);
                searchFilter();
            } else if (this.contrat.active === true) {
                this.contrat.active = false;
                var index = $scope.searchResult.Contrat.indexOf(this.contrat.type);
                if (index > -1) {
                    $scope.searchResult.Contrat.splice(index, 1);
                }
                searchFilter();
            }
        } else if ($scope.searchResult.Contrat.length >= 3) {
            this.contrat.active = false;
            var index = $scope.searchResult.Contrat.indexOf(this.contrat.type);
            if (index > -1) {
                $scope.searchResult.Contrat.splice(index, 1);
            }
            searchFilter();
        }
    };

    // Pouvoir supprimmer un tags en cliquant sur la croix de l'icone dans le tableau de bord.
    $scope.deleteSchoolTag = function() {
        for (var i = 0; i < $scope.schools.length; i++) {
            if ($scope.schools[i].ville === $scope.searchResult.Ville) {
                $scope.schools[i].active = false;
            }
        }
        $scope.searchResult.Ville = "";
        searchFilter();
    };

    // Pouvoir supprimmer un tags en cliquant sur la croix de l'icone dans le tableau de bord.
    $scope.deleteLangTag = function() {
        console.log(this.lang);
        for (var i = 0; i < $scope.langages.length; i++) {
            if ($scope.langages[i].type === this.lang) {
                $scope.langages[i].active = false;
                var index = $scope.searchResult.Langage.indexOf(this.lang);
                if (index > -1) {
                    $scope.searchResult.Langage.splice(index, 1);
                }
            }
        }
        searchFilter();
    };

    // Pouvoir supprimmer un tags en cliquant sur la croix de l'icone dans le tableau de bord.
    $scope.deleteContTag = function() {
        for (var i = 0; i < $scope.contrats.length; i++) {
            if ($scope.contrats[i].type === this.cont) {
                $scope.contrats[i].active = false;
                var index = $scope.searchResult.Contrat.indexOf(this.cont);
                if (index > -1) {
                    $scope.searchResult.Contrat.splice(index, 1);
                }
            }
        }
        searchFilter();
    };

}]);
