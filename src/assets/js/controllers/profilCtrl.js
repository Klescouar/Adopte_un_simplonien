app.controller('profilCtrl', ['$scope', '$http', 'serviceApi', '$routeParams', function($scope, $http, serviceApi, $routeParams) {
$scope.contactStud = 1;
$scope.verifChamps = false;
$scope.contactStudent = function(){
    if ($('.inputMail').val().length > 0 && $('.textAreaMail').val().length > 0) {
        $scope.contactStud = 2;
    }
    else {
        $scope.verifChamps = true;
    }
}
    var id = $routeParams.id_profil;
    console.log(id)
    $http.get(serviceApi.profilUser + id)
        .then(
            function(response) {
                $scope.student = response.data;
                console.log($scope.student[0]);
            },
            function(err) {
                console.log("C'est la merde!");
            }
        );


}]);
