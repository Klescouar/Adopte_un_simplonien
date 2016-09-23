app.controller('projectCtrl', ['$scope', '$http', 'serviceApi', '$timeout', '$window', function($scope, $http, serviceApi, $timeout, $window) {
    $scope.showDescription = false;
    $scope.showDescription2 = false;

// Apparition des descriptions en dessous de 640px avec un léger délai.
    $timeout(function() {
        if (window.innerWidth < 640) {
            $scope.showDescription = true;
            $scope.showDescription2 = true;
        }
    }, 70);

// Apparition de la première description au premier scroll et de la deuxième a partir de 600px de hauteur.
    angular.element($window).bind("scroll", function(e) {
        $scope.showDescription = true;
        console.log(window.pageYOffset);
        if (window.pageYOffset > 600) {
            $scope.showDescription2 = true;
        }
        $scope.$apply(function() {});
    });
}]);
