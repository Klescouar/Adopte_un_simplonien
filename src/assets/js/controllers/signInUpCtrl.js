app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.signToggle = true;
    $scope.logBox = function() {
        $scope.signToggle = false;
    };
    $scope.signBox = function() {
        $scope.signToggle = true;
    };

    
    $scope.createAccount = function(){
        console.log('est');
        var data = {
            pseudo: $scope.boCreatePseudo,
            password: $scope.boCreateMdp
        }
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
    console.log($scope.password);

}]);
