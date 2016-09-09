app.controller('projectCtrl', ['$scope', '$http', 'serviceApi', '$timeout', '$window', function($scope, $http, serviceApi, $timeout, $window) {
    $scope.showDescription = false;
    $scope.showDescription2 = false;

    $timeout(function() {
        if (window.innerWidth < 640) {
            $scope.showDescription = true;
            $scope.showDescription2 = true;
        }
    }, 70);


    angular.element($window).bind("scroll", function(e) {
        $scope.showDescription = true;
        console.log(window.pageYOffset);
        if (window.pageYOffset > 600) {
            $scope.showDescription2 = true;
        }
        $scope.$apply(function() {});
    });
}]);
