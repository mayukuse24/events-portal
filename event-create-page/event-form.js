function validate(form)
{
    console.log(form.start_date.value.split("").reverse().join(""));
}

function generate_list()
{
    OBH_list = [];
    Vindhya_list = ["Seminar Hall 1","Seminar Hall 2","workspace"];
    Nilgiri_list = ["Open lab","Teaching lab 1","Teaching Lab 2"];
    Himalaya_list = ["Room 105","Room 103","Room 104","Room 102"] ;

    $("#Parent_Location").change(function(){

	var parent = $(this).val(); //get option value from parent 
        
	switch(parent){ //using switch compare selected option and populate child
	case "OBH":
            refresh_list(OBH_list);
            break;
	case 'Nilgiri':
            refresh_list(Nilgiri_list);
            break;              
	case 'Vindhya':
            refresh_list(Vindhya_list);
            break;
	case 'Himalaya':
            refresh_list(Himalaya_list);
            break;
	default: //default child option is blank
            refresh_list(Nilgiri_list);
            break;
	}

    })

}    


function refresh_list(array_list)
{
    $("#Child_Location").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options 
        $("#Child_Location").append("<option value=\""+array_list[i]+"\">"+array_list[i]+"</option>");
    });
}
window.onload = generate_list;
