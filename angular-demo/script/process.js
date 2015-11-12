var a = angular.module('B', []);

a.controller('Bc', 
	[ '$scope', function(scope)
	{
	    scope.aa = [];
	    console.log(data);
	    for( var iter = 0; iter < data.length; iter++ ){
		scope.aa.push(
		    {
			bb: data[iter].eventname,
			cc: data[iter].eventlocation,
			dd: data[iter].room,
			ee: data[iter].starttime,
			ff: data[iter].startdate
		});
	    }
	}
	]);
