app.controller('homeCtrl', ['$scope', '$http', 'serviceApi', '$route', '$timeout', ($scope, $http, serviceApi, $route, $timeout) => {
    $scope.button = true;

    $scope.changeButton = () => {
        $scope.button = false;
    }
}]);
