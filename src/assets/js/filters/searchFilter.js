app.filter('searchFilter', function () {
  return function(objects, criteria){
      var filterResult = new Array();
      if(!criteria)
          return objects;

      for(index in objects) {
          if(objects[index].boy.name.indexOf(criteria) != -1)
              filterResult.push(objects[index]);
      }
      console.log(filterResult);
      return filterResult;
  }
});
