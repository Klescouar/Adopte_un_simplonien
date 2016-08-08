app.controller('BoCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.createAccount = function(){
        console.log('est');
        var data = {
            pseudo: $scope.boCreatePseudo,
            mdp: $scope.boCreateMdp
        }
        $http.post(serviceApi.createUser, data)
            .then(
                function(response) {
                    console.log = response.data;
                },
                function(err) {
                    console.log("C'est la merde!");
                }
            );
    }
}]);
