app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $http.get(serviceApi.api)
        .then(
            function(response) {
              $scope.data = response.data;

                console.log($scope.data.nomPrenom);
            },
            function(err) {
                console.log("C'est la merde!");
            });

}]);
