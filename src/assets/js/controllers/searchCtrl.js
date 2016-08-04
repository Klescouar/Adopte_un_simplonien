app.controller('searchCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $http.get(serviceApi.api)
        .then(
            function(response) {
              $scope.data = [];
                $scope.data.push(response.data);

                console.log($scope.data[0]);
            },
            function(err) {
                console.log("C'est la merde!");
            });

}]);
