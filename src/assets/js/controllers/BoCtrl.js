app.controller('boCtrl', ['$scope', '$http', 'serviceApi', '$route', '$timeout', ($scope, $http, serviceApi, $route, $timeout) => {

    $scope.show = 0;

    // to creat an acout user
    $scope.createAccount = () => {

        if ($scope.boCreateMdpVerif === $scope.boCreateMdp && $scope.boCreatePseudo.length > 2 && $scope.boCreateMdpVerif.length > 5) {


            var dataUser = {
                pseudo: $scope.boCreatePseudo,
                password: $scope.boCreateMdp
            };

            $http.post(serviceApi.createUser, dataUser)
                .then(
                    function(response) {
                        alert('Compte créé!');
                        $scope.showUser();
                    },
                    function(err) {
                        console.log("Error");
                    }
                );
        }
    }

    // to show user list

    $scope.showUser = () => {

        $http.get(serviceApi.getUser)
            .then(
                function(response) {
                    $scope.users = response.data;
                },
                function(err) {
                    console.log("Error");
                }
            );
    };

    // to delete an acount user in the list

    $scope.deleteItem = (index) => {
        var response = confirm("Voulez vous vraiment supprimer cet utilisateur?");
        if (response === true) {
            $http.delete(serviceApi.deleteUser + index)
                .then(
                    function(response) {
                        $scope.showUser();
                    },
                    function(err) {
                        console.log("Error");
                    }
                );
        }
    };

    $scope.showUser();

    // to create a simplonien card

    $scope.createSimplonien = () => {
        var dataStudent = {
            nom: $scope.boCreateLastName,
            prenom: $scope.boCreateName,
            age: $scope.boCreateOld,
            ville: $scope.boCreatePromo,
            photo: $scope.boCreatePhoto,
            tags: $scope.boCreateTags,
            description: $scope.boCreateAbout,
            sexe: $scope.boCreateSexe,
            specialite1: $scope.boCreateSpeOne,
            specialite2: $scope.boCreateSpeTwo,
            specialite3: $scope.boCreateSpeThree,
            github: $scope.boCreateGithub,
            linkedin: $scope.boCreateLinkedin,
            portfolio: $scope.boCreatePortfolio,
            cV: $scope.boCreateCV,
            twitter: $scope.boCreateTwitter,
            stack: $scope.boCreateStackOverFlow,
            mail: $scope.boCreateMail,
            contrat: $scope.boCreateContrat,
            datePromo: $scope.boCreateDatePromo,
            domaine: $scope.boCreateDomaine
        };

        console.log(dataStudent);

        $http.post(serviceApi.createStudent, dataStudent)
            .then(
                (response) => {
                    console.log(response.data);
                    alert('Simplonien créé!');
                    $scope.showSimplonien();
                },
                (err) => {
                    console.log("Error");
                }
            );
    }


    // to show Simplonien list

    $scope.showSimplonien = () => {
        $http.get(serviceApi.getSimplonien)
            .then(
                function(response) {
                    $scope.simploniens = response.data;
                },
                function(err) {
                    console.log("Error");
                }
            );
    };



    // to delete a Simplonien card

    $scope.deleteSimplonien = (index) => {
        var response = confirm("Voulez vous vraiment supprimer ce simplonien?");
        if (response === true) {
            $http.delete(serviceApi.deleteSimplonien + index)
                .then(
                    function(response) {
                        alert('Simplonien supprimé!');
                        $scope.showSimplonien();
                    },
                    function(err) {
                        console.log("Error");
                    }
                );
        }
    };
    $scope.showSimplonien();

    // to modify a Simplonien's card

    $scope.modify = (index) => {
        $scope.show = 5;
        $scope.id = index;
        $http.get(serviceApi.modifySimplonien + index)
            .then(
                (response) => {
                    $scope.infoSimploniens = response.data;
                },
                (err) => {
                    console.log("Error");
                }
            );
    }



    $scope.sendModif = () => {

        var dataInfoSimploniens = {
            nom: document.getElementById("boCreateLastNameSimploniens").value,
            prenom: document.getElementById("boCreateNameSimploniens").value,
            age: document.getElementById("boCreateOldSimploniens").value,
            ville: document.getElementById("boCreatePromoSimploniens").value,
            photo: document.getElementById("boCreatePhotoSimploniens").value,
            tags: document.getElementById("boCreateTagsSimploniens").value,
            description: document.getElementById("boCreateAboutSimploniens").value,
            sexe: document.getElementById("boCreateSexeSimploniens").value,
            specialite1: document.getElementById("boCreateSpeOneSimploniens").value,
            specialite2: document.getElementById("boCreateSpeTwoSimploniens").value,
            specialite3: document.getElementById("boCreateSpeThreeSimploniens").value,
            github: document.getElementById("boCreateGithubSimploniens").value,
            linkedin: document.getElementById("boCreateLinkedinSimploniens").value,
            portfolio: document.getElementById("boCreatePortfolioSimploniens").value,
            cV: document.getElementById("boCreateCVSimploniens").value,
            twitter: document.getElementById("boCreateTwitterSimploniens").value,
            stack: document.getElementById("boCreateStackOverFlowSimploniens").value,
            mail: document.getElementById("boCreateMailSimploniens").value,
            contrat: document.getElementById("boCreateContratSimploniens").value,
            datePromo: document.getElementById("boCreateDatePromoSimploniens").value,
            domaine: document.getElementById("boCreateDomaineSimploniens").value

        };

        $http.put(serviceApi.modifySendSimplonien + $scope.id, dataInfoSimploniens)
            .then(
                (response) => {
                    alert('Simplonien modifié!')
                    $scope.showSimplonien();

                },
                (err) => {
                    console.log("Error");
                }
            );
    }

    $(document).ready(function() {
        $(function() {
            var nav = $('.container-nav-bo');
            if (nav.length) {
                var stickyNavTop = nav.offset().top + 4;
                $(window).scroll(function() {
                    if ($(window).scrollTop() > stickyNavTop && screen.width > 640) {
                        $('.container-nav-bo').addClass('sticktotop');
                        $('.container-interface').addClass('marginToFix2');
                    } else {
                        $('.container-nav-bo').removeClass('sticktotop');
                        $('.container-interface').removeClass('marginToFix2');
                    }
                });
            }
        });
    });


}]);
