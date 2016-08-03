var app = angular.module('AdopteUnSimplonien', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/home.html'
        })
        .when('/search', {
            templateUrl: 'views/search.html'
        })
        .when('/project', {
            templateUrl: 'views/project.html'
        })
        .when('/contact', {
            templateUrl: 'views/contact.html'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);

app.controller('app', ["$scope", function($scope) {
  $scope.lol= 3;
}]);
