app.controller('projectCtrl', ['$scope', '$http', 'serviceApi', '$timeout', function($scope, $http, serviceApi, $timeout) {
    $scope.showDescription = false;
    $scope.showDescription2 = false;


    $scope.showTop = function() {
        $scope.showDescription = !$scope.showDescription;
    };

    $scope.showDown = function() {
        $scope.showDescription2 = !$scope.showDescription2;
        console.log($scope.showDescription2);
    };
    $timeout(function() {
        if (window.innerWidth < 640) {
            $scope.showDescription = true;
            $scope.showDescription2 = true;
        }
    }, 70);

}]);
