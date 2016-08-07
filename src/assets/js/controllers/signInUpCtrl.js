app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {

    $scope.signToggle = true;
    $scope.logBox = function() {
        $scope.signToggle = false;
    };
    $scope.signBox = function() {
        $scope.signToggle = true;
    };

    console.log($scope.signToggle);

}]);
