app.service("serviceApi", function(){
  this.api =  'http://localhost/LAMP/Adopte_un_simplonien/server/index.php/api/card';
  this.createUser = 'http://localhost/LAMP/Adopte_un_simplonien/server/index.php/api/create/user';
  this.createUser = 'http://localhost:8888/Adopte_un_simplonien/server/index.php/api/create/user';
  this.getUser = 'http://localhost:8888/Adopte_un_simplonien/server/index.php/api/user';
  this.deleteUser = 'http://localhost:8888/Adopte_un_simplonien/server/index.php/api/delete/user/';
  this.createStudent = 'http://localhost:8888/Adopte_un_simplonien/server/index.php/api/create/simplonien';
});
