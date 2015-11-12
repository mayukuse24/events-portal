var a = angular.module('B', []);

a.controller('Bc', 
	[ '$scope', function(scope){
	    scope.aa = [];
	    function compare(a, b) {
		dateA = a.startdate.split('-');
		dateB = b.startdate.split('-');
		timeA = a.starttime.split(':');
		timeB = b.starttime.split(':');

		if (dateA[0] < dateB[0])
    return -1;
if(dateA[0] > dateB[0])
    return 1;
else {
    if (dateA[1] < dateB[1])
    return -1;
if(dateA[1] > dateB[1])
    return 1;
else {
    if (dateA[2] < dateB[2])
    return -1;
    if(dateA[2] > dateB[2])
	return 1;
    else {
	if (timeA[0] < timeB[0])
	    return -1;
	if(timeA[0] > timeB[0])
	    return 1;
	else {
	    if (timeA[0] < timeB[0])
		return -1;
	    if(timeA[0] > timeB[0])
		return 1;
	    else
		return 0;

	}    
    }
}
}
}
data.sort(compare);
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
