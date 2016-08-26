app.controller('projectCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.showDescription = false;
    $scope.showDescription2 = false;

    $scope.showTop = function() {
        $scope.showDescription = !$scope.showDescription;
        console.log($scope.showDescription);
    };

    $scope.showDown = function() {
        $scope.showDescription2 = !$scope.showDescription2;
        console.log($scope.showDescription2);
    };
}]);
