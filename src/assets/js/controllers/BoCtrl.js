app.controller('boCtrl', ['$scope', '$http', 'serviceApi', '$route','$timeout',  function($scope, $http, serviceApi,$route,$timeout) {


// to creat an acout user
    $scope.createAccount = function(){
        
        if($scope.boCreateMdpVerif === $scope.boCreateMdp && $scope.boCreatePseudo.length > 3 &&  $scope.boCreateMdpVerif.length > 6){

            console.log('est');
            var dataUser = {
                pseudo: $scope.boCreatePseudo,
                password: $scope.boCreateMdp
            };

            $http.post(serviceApi.createUser, dataUser)
                .then(
                    function(response) {
                       alert(response.data);
                       $scope.showUser();
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
        }
    }

// to show user list

$scope.showUser = function(){

        $http.get(serviceApi.getUser)
                .then(
                    function(response) {  
                         $scope.users = response.data;
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
};

// to delete an acount user in the list

    $scope.deleteItem = function (index) {

         $http.delete(serviceApi.deleteUser + index)
                .then(
                    function(response) {
                         console.log(response.data);
                          $scope.showUser();
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
    };

    $scope.showUser();

// to create a simplonien card

$scope.createSimplonien = function(){
        if($scope.boCreateMdpVerif === $scope.boCreateMdp && $scope.boCreatePseudo.length > 3 &&  $scope.boCreateMdpVerif.length > 6){

            console.log('est');
            var dataStudent = {
                nom: $scope.boCreateLastName,
                prenom: $scope.boCreateName,
                age: $scope.boCreateOld,
                ville: $scope.boCreatePromo,
                photo: $scope.boCreatePhoto,
                tags: $scope.boCreateTags,
                description: $scope.boCreateAbout,
                sexe : $scope.boCreateSexe,
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

            $http.post(serviceApi.createStudent, dataStudent)
                .then(
                    function(response) {
                        console.log('coucou');
                        console.log (response.dataStudent);
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
    
            }
    }


// to show Simplonien list

$scope.showSimplonien = function(){
console.log("coucou")
        $http.get(serviceApi.getSimplonien)
                .then(
                    function(response) {  
                         $scope.simploniens = response.data;
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
};



    // to delete a Simplonien card

    $scope.deleteSimplonien = function (index) {

         $http.delete(serviceApi.deleteSimplonien + index)
                .then(
                    function(response) {
                         console.log(response.data);
                          $scope.showSimplonien();
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
    };
    $scope.showSimplonien();

}]);


