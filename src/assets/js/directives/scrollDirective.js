app.directive("scroll", [function($window) {
    return function(scope, element, attrs) {
        angular.element($window).bind("scroll", function(e) {
          console.log('scroll')
          $scope.$apply(function() {
            console.log(e.pageYOffset)
          });
       });
    };
}]);
