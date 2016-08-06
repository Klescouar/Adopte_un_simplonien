app.controller('contactCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.schools = serviceApi.schools;
}]);
