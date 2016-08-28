app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.signToggle = 1;
    $scope.logBox = function() {
        $scope.signToggle = 1;
    };
    $scope.signBox = function() {
        $scope.signToggle = 2;
    };

    $scope.createAccount = function() {
      $scope.signToggle = 3;


        if ($scope.boCreateMdpVerif === $scope.boCreateMdp) {

            var dataUser = {
                pseudo: $('#pseudo').val(),
                password: $('#mdp').val()

            };
            console.log(dataUser)

            $http.post(serviceApi.createUser, dataUser)
                .then(
                    function(response) {},
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
        }
    }
}]);
