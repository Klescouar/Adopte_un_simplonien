app.controller('homeCtrl', ['$scope', '$http', 'serviceApi', '$route', '$timeout', function($scope, $http, serviceApi, $route, $timeout) {
    $scope.button = true;

    $scope.changeButton = function() {
        $scope.button = false;
    }
}]);
