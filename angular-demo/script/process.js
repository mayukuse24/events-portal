var a = angular.module('B', []);

a.controller('Bc', 
	[ '$scope', function(scope){
	    scope.aa = [];

	    function isDateValid(j){
		datetimeSoFar = data[j].starttime.split(" ");
		dateS = datetimeSoFar[0];//yyyy,mm,dd
		timeS = datetimeSoFar[1];//hh,mm

		dateSoFar = dateS.split("-");
		timeSoFar = timeS.split(":");

		var cur = new Date();
		curY = cur.getFullYear();
		curM = cur.getMonth()+1;
		curD = cur.getDate();
		curH = cur.getHours();
		curMi = cur.getMinutes();
		if(Number(dateSoFar[0]) < curY){
		    return -1;
		}
		else if(Number(dateSoFar[0]) > curY){
		    return 1;
		}
		else{
		    if(Number(dateSoFar[1]) < curM){
			return -1;
		    }
		    else if(Number(dateSoFar[1]) > curM){
			return 1;
		    }
		    else{
			if(Number(dateSoFar[2]) < curD){
			    return -1;
			}
			else if(Number(dateSoFar[2]) >= curD){
			    return 1;
			}
		    }
		}
	    }
	    function compare(a, b) {
		xDate = a.starttime.split(" ");
		yDate = b.starttime.split(" ");
		dateA = xDate[0].split('-');
		dateB = yDate[0].split('-');
		timeA = xDate[1].split(':');
		timeB = yDate[1].split(':');

		if (dateA[0] < dateB[0]){
		    return -1;}
		if(dateA[0] > dateB[0]){
		    return 1;}
		else {
		    if (dateA[1] < dateB[1]){
			return -1;}
		    if(dateA[1] > dateB[1]){
			return 1;}
		    else {
			if (dateA[2] < dateB[2]){
			    return -1;}
			if(dateA[2] > dateB[2]){
			    return 1;}
			else {
			    if (timeA[0] < timeB[0]){
				return -1;}
			    if(timeA[0] > timeB[0]){
				return 1;}
			    else {
				if (timeA[0] < timeB[0]){
				    return -1;}
				if(timeA[0] > timeB[0]){
				    return 1;}
				else{
				    return 0;}
			    }    
			}
		    }
		}
	    }

	    function listEventsHere(x){
		var venue = x;
		var event_detail = [];
		var len = data.length;
		for( var i = 0; i < len; i++ ){
		    if(data[i].eventlocation == venue){

			event_detail.push(
				{
				    info: data[i].eventname,
				    when: data[i].starttime
				}
				);
		    }
		}
		console.log(event_detail);
	    }
	    
	    data.sort(compare);
	    for( var iter = 0; iter < data.length; iter++ ){
		if(isDateValid(iter) == 1){
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
	}
]);
