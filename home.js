var app=angular.module("home",[]);

app.factory('productsService',function(valueName){
	//factory Object -singleton Objects
	return {
		name:"product1Service",
	    getAppName:function(){
	    	return valueName;
	    }
	};
    	
})

app.factory('product2Service',function(valueName){
	/// serve as Object Constructor;
	function product2Service(age){
		this.age=age;
	}
	product2Service.prototype={
			name:"sai",
			grade:6.2,
			value:valueName
	}
    return product2Service;
});

app.controller("product1Ctrl",['$scope','product2Service','valueName','userService','version',function($scope,product2Service,valueName,userService,version){
	var a=new product2Service(12);
	var b=new product2Service(13);
	$scope.ctrl="parentCtrl - "+ a.name+ "  "+a.grade+' '+valueName+" "+a.value+"  "+userService.getuserId();
	$scope.grade="parentGrade-"+a.age+" "+b.age+" "+a.age;
	$scope.Version=version;
}])