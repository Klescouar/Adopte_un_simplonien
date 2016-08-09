app.controller('boCtrl', ['$scope', '$http', 'serviceApi',  function($scope, $http, serviceApi) {

    $scope.createAccount = function(){
        
        if($scope.boCreateMdpVerif === $scope.boCreateMdp && $scope.boCreatePseudo.length > 3 &&  $scope.boCreateMdpVerif.length > 6){

            console.log('est');
            var data = {
                pseudo: $scope.boCreatePseudo,
                password: $scope.boCreateMdp
            };
            console.log(data['pseudo'])
            $http.post(serviceApi.createUser, data)
                .then(
                    function(response) {
                        console.log (response.data);
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
        }

    }

    $scope.deleteItem = function (index) {



    $scope.entreprises.splice(index, 1);
    }

    $scope.entreprises = [{
        name: 'uzik',
        permission: 'user',
    }, {
        name: 'simplon',
        permission: 'user',
    }, {
        name: 'betc',
        permission: 'user',
    }, {
        name: 'crédit agricole',
        permission: 'user',
    }, {
        name: 'sncf',
        permission: 'user',
    }, {
        name: 'razorfish',
        permission: 'user',
    }, {
        name: 'vogue',
        permission: 'user',
    }, {
        name: 'google',
        permission: 'user',
    }, {
        name: 'apple',
        permission: 'user',
    }, {
        name: 'mozilla',
        permission: 'user',
    }, {
        name: 'samsung',
        permission: 'user',
    }, {
        name: 'malboro',
        permission: 'user',
    }, {
        name: 'levis',
        permission: 'user',
    }
    ];

$scope.createStudent = function(){
        
            console.log('est');
            var data = {
                Nom: $scope.boCreateLastName,
                Prenom: $scope.boCreateName,
                Age: $scope.boCreateOld,
                Ville: $scope.boCreateCity,
                Photo: $scope.boCreatePhoto,
                Tags: $scope.boCreateTags,
                Description: $scope.boCreateAbout,
                SpecialiteUn: $scope.boCreateSpeOne,
                SpecialiteDeux: $scope.boCreateSpeTwo,
                SpecialiteTrois: $scope.boCreateSpeThree,
                Github: $scope.boCreateGithub,
                Linkedin: $scope.boCreateLinkedin,
                Portfolio: $scope.boCreatePortfolio,
                CV: $scope.boCreateCV,
                Twitter: $scope.boCreateTwitter,
                StackOverFlow: $scope.boCreateStackOverFlow,
                Mail: $scope.boCreateMail,
                Contrat: $scope.boCreateContrat,
                DatePromo: $scope.boCreateDatePromo

            };
            $http.post(serviceApi.createStudents, data)
                .then(
                    function(response) {
                        console.log (response.data);
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
    

    }

}]);


