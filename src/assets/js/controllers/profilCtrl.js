app.controller('profilCtrl', ['$scope', '$http', 'serviceApi', '$routeParams', function($scope, $http, serviceApi, $routeParams) {
$scope.contactStud = 1;
$scope.verifChamps = false;


// Vérification des inputs pour l'envoie de mail au simplonien.
$scope.contactStudent = function(){
    if ($('.inputMail').val().length > 0 && $('.textAreaMail').val().length > 0) {
        $scope.contactStud = 2;
    }
    else {
        $scope.verifChamps = true;
    }
}

// Récupération de l'id dans l'URL du simplonien sélectionné.
    var id = $routeParams.id_profil;

// Récupération des infos du simplonien sélectionné.
    $http.get(serviceApi.profilUser + id)
        .then(
            function(response) {
                $scope.student = response.data;
            },
            function(err) {
                console.log("Error");
            }
        );


}]);
