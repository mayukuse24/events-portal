var a = angular.module('B', []);

a.controller('Bc', 
	[ '$scope', function(scope)
	{
	    scope.aa = [];
	    for( var iter = 0; iter < 3; iter++ ){
		scope.aa.push({bb: "dsfsdfs"});
	    }
	}
	]);
