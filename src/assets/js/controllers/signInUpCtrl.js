app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.signToggle = 1;
    $scope.verifPass = true;


$scope.loginPost = function(){
  var login = {
      pseudo: $('#connectPseudo').val(),
      password: $('#connectMdp').val()
  };
  console.log(login);
  $http.get(serviceApi.connect, login)
      .then(
          function(response) {
              $scope.users = response.data;
          },
          function(err) {
              console.log("C'est la merde!");
          });
};


    $scope.logBox = function() {
        $scope.signToggle = 1;
    };


    $scope.signBox = function() {
        $scope.signToggle = 2;
    };

    $('#signInUp').on('hidden.bs.modal', function() {
        $scope.signToggle = 1;
    });


    $scope.createAccount = function() {
        if ($('#mdp').val() !== $('#mdp-verif').val()) {
            $scope.verifPass = false;
        };

        if ($('#mdp').val() === $('#mdp-verif').val()) {
            var dataUser = {
                pseudo: $('#pseudo').val(),
                password: $('#mdp').val()

            };
            $http.post(serviceApi.createUser, dataUser)
                .then(
                    function(response) {
                      $scope.signToggle = 3;
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
        }
    }
}]);
