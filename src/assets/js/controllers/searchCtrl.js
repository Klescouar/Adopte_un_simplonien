app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.schools = serviceApi.schools;
    $scope.togglePromo = false;
    $scope.toggleLangage = false;
    $scope.toggleContrat = false;
    $scope.searchResult = {
        Langage: [],
        Ville: "",
        Contrat: [],
    };


    $http.get(serviceApi.api)
        .then(
            function(response) {
                $scope.data = response.data;
                $scope.cardFull = response.data;
            },
            function(err) {
                console.log("C'est la merde!");
            });

    var searchFilter = function() {
        $scope.data = [];

        var lang1 = typeof $scope.searchResult.Langage[0] !== 'undefined' ? $scope.searchResult.Langage[0] : '';
        var lang2 = typeof $scope.searchResult.Langage[1] !== 'undefined' ? $scope.searchResult.Langage[1] : '';
        var lang3 = typeof $scope.searchResult.Langage[2] !== 'undefined' ? $scope.searchResult.Langage[2] : '';
        var ville = typeof $scope.searchResult.Ville !== 'undefined' ? $scope.searchResult.Ville : '';
        var contrat1 = typeof $scope.searchResult.Contrat[0] !== 'undefined' ? $scope.searchResult.Contrat[0] : '';
        var contrat2 = typeof $scope.searchResult.Contrat[1] !== 'undefined' ? $scope.searchResult.Contrat[1] : '';
        var contrat3 = typeof $scope.searchResult.Contrat[2] !== 'undefined' ? $scope.searchResult.Contrat[2] : '';
        var contrat4 = typeof $scope.searchResult.Contrat[3] !== 'undefined' ? $scope.searchResult.Contrat[3] : '';
        var contrat5 = typeof $scope.searchResult.Contrat[4] !== 'undefined' ? $scope.searchResult.Contrat[4] : '';

        angular.forEach($scope.cardFull, function(value, key) {
            var recherche = value.contrat + ' ' + value.specialite1 + ' ' + value.specialite2 + ' ' + value.specialite3 + ' ' + value.ville;
            if (recherche.match("^(?=.*" + lang1 + ")(?=.*" + lang2 + ")(?=.*" + lang3 + ")(?=.*" + ville + ")(?=.*" + contrat1 + ")(?=.*" + contrat2 + ")(?=.*" + contrat3 + ")(?=.*" + contrat4 + ")(?=.*" + contrat5 + ")", "i")) {
                $scope.data.push(value);
            };
        });
    };

    searchFilter();


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
        type: 'React',
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
        type: 'Design',
        active: false,
    }, {
        type: 'JAVA',
        active: false,
    }, {
        type: 'C#',
        active: false,
    }, {
        type: 'UI/UX',
        active: false,
    }, {
        type: 'Ruby',
        active: false,
    }, {
        type: 'Responsive',
        active: false,
    }, {
        type: 'Node',
        active: false,
    }, {
        type: 'Meteor',
        active: false,
    }, {
        type: 'Git',
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



    if ($(window).width() > 640) {
        $('.filterRight').css('display', 'block');
    }
    $(window).resize(function() {
        if ($(window).width() > 640) {
            $('.filterRight').css('display', 'block');
        };
    });

    $(document).ready(function() {
        $(function() {
            var nav = $('.filterMain');
            if (nav.length) {
                var stickyNavTop = nav.offset().top + 4;
                $(window).scroll(function() {
                    if ($(window).scrollTop() > stickyNavTop && screen.width > 640) {
                        $('.filterMain').addClass('sticktotop');
                        $('.cardPage').addClass('marginToFix');
                    } else {
                        $('.filterMain').removeClass('sticktotop');
                        $('.cardPage').removeClass('marginToFix');
                    }
                });
            }
        });
    });



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
                }
            }
        }
    }


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


    $scope.changeFilterContrat = function() {
        if ($scope.searchResult.Contrat.length < 5) {
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
        } else if ($scope.searchResult.Contrat.length >= 5) {
            this.contrat.active = false;
            var index = $scope.searchResult.Contrat.indexOf(this.contrat.type);
            if (index > -1) {
                $scope.searchResult.Contrat.splice(index, 1);
            }
            searchFilter();
        }
    };

    $scope.deleteSchoolTag = function() {
        for (var i = 0; i < $scope.schools.length; i++) {
            if ($scope.schools[i].ville === $scope.searchResult.Ville) {
                $scope.schools[i].active = false;
            }
        }
        $scope.searchResult.Ville = "";
        searchFilter();
    };

    $scope.deleteLangTag = function() {
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
