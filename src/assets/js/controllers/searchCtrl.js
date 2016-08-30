app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.schools = serviceApi.schools;
    $scope.togglePromo = false;
    $scope.toggleLangage = false;
    $scope.toggleContrat = false;
    $scope.searchSchool = [];
    $scope.searchLangage = [];
    $scope.searchContrat = [];
    var searchResult = {
        Langage: [],
        Ville: "",
        Contrat: [],
    };


    var searchFilter = function() {
        $http.get(serviceApi.api)
            .then(
                function(response) {
                    $scope.data = response.data;
                    $scope.studentShow = [];
                    for (var i = 0; i < $scope.data.length; i++) {
                        var search = [{
                            'specialite': [$scope.data[i].specialite1, $scope.data[i].specialite2, $scope.data[i].specialite3],
                            'contrat': [$scope.data[i].contrat],
                            'ville': $scope.data[i].ville,
                        }];
                        var ville = _.some(search, {
                            'ville': searchResult.Ville
                        });
                        const langage = _.some(search, {
                            'specialite': searchResult.Langage
                        });
                        const contrat = _.some(search, {
                            'contrat': searchResult.Contrat
                        });
                        if (searchResult.Ville.length == 0) {
                            ville = true;
                        }
                        if (ville === true && langage === true && contrat === true) {
                            $scope.studentShow.push($scope.data[i]);
                        }
                    }
                },
                function(err) {
                    console.log("C'est la merde!");
                }
            );
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
        } else if (searchResult.Ville.length > 0) {
            if (this.school.active === true) {
                this.school.active = false;
                searchResult.Ville = "";
                searchFilter();
            } else if (this.school.active === false) {
                for (var i = 0; i < $scope.schools.length; i++) {
                    $scope.schools[i].active = false;
                    this.school.active = true;
                }
                searchResult.Ville = this.school.ville;
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
}]);
