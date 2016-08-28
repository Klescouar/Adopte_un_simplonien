app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.signToggle = 1;
    $scope.verifPass = true;
    $scope.logBox = function() {
        $scope.signToggle = 1;
    };
    $scope.signBox = function() {
        $scope.signToggle = 2;
    };

    $scope.createAccount = function() {

        if ($('#mdp').val() !== $('#mdp-verif').val()) {
          $scope.verifPass = false;
        };

        if ($('#mdp').val() === $('#mdp-verif').val()) {
            $scope.signToggle = 3;
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
