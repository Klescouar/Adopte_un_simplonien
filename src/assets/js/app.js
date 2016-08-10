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
        .when('/profil:id_profil', {
            templateUrl: 'views/profil.html'
        })
        .when('/log', {
            templateUrl: 'views/signInUp.html'
        })
        .when('/backOffice', {
            templateUrl: 'views/backOffice.html'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);
