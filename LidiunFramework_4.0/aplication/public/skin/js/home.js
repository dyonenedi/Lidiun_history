function getLanguage(){
	var data = {action:"get_language"};
	data = json(data,false);
	if (data.replay) {
		console.log("sucess");
	} else {
		console.log("fail");
	}
}

$("document").ready(function(){

});
