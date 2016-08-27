app.controller('signInUpCtrl', ['$scope', '$http', 'serviceApi', function($scope, $http, serviceApi) {
    $scope.signToggle = false;
    $scope.logBox = function() {
        $scope.signToggle = false;
    };
    $scope.signBox = function() {
        $scope.signToggle = true;
    };


  $scope.createAccount = function(){
 
    if($scope.boCreateMdpVerif === $scope.boCreateMdp){
        
                       var dataUser = {
                pseudo:  $('#pseudo').val(),
                password: $('#mdp').val()

            };
            console.log(dataUser)

            $http.post(serviceApi.createUser, dataUser)
                .then(
                    function(response) {
                       alert(response.data);
                      
                    },
                    function(err) {
                        console.log("C'est la merde!");
                    }
                );
    
    }

}

//     $scope.showUser = function(){

//         $http.get(serviceApi.getUser)
//                 .then(
//                     function(response) {  
//                          $scope.users = response.data;
//                     },
//                     function(err) {
//                         console.log("C'est la merde!");
//                     }
//                 );
// };

}]);
