app.controller('profilCtrl', ['$scope', '$http', 'serviceApi', '$routeParams', function($scope, $http, serviceApi, $routeParams) {

    var id = $routeParams.id_profil;
    $http.get(serviceApi.profilUser + id)
        .then(
            function(response) {
                $scope.student = response.data;
                console.log($scope.student[0].Photo);

            },
            function(err) {
                console.log("C'est la merde!");
            }
        );

$scope.photo = "trombi15.jpg";

}]);
