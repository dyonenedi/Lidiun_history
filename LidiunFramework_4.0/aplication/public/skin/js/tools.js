//--------- Time Loading ----------//
var timeoutLoading = false;

// Refresh in page
function refresh(time) {
	if (time == undefined) {
		time = 8000;
	}

	setTimeout(function(){
		window.location = window.location.pathname+"/";
		window.location = window.location.origin+"/";
	},time);
}

// Validate Name
function validateName(nome) {
	var regex = /[^\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ]/;
	if (!regex.test(nome)) {
		return true;
	} else {
		return false;
	}
}

// Validate User
function validateUser(user) {
	var regex = /[^(abcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZ)+(_0123456789)?]/;
	if (!regex.test(user)) {
		return true;
	} else {
		return false;
	}
}

// Validate Email
function validateEmail(email) {
	var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/;
	if (regex.test(email)) {
		return true;
	} else {
		return false;
	}
}

// Find youtube vídeo link
function findVideoLink(text){
	var regex = /(http:\/\/|https:\/\/)?(www.)?(youtube\.)+(com|com.br{1})+(\/watch\?v=)+([a-zA-Z0-9_-]+)/;
	if (text.search(regex) != -1) {
		var link = text.match(/(http:\/\/|https:\/\/)?(www.)?(youtube\.)+(com|com.br{1})+(\/watch\?v=)+([a-zA-Z0-9_-]+)/);
		return link[0];
	} else {
		var regex = /(http:\/\/|https:\/\/)?(youtu\.)+(be\/{1})+([a-zA-Z0-9_-]+)/;
		if (text.search(regex) != -1) {
			var link = text.match(/(http:\/\/|https:\/\/)?(youtu\.)+(be\/{1})+([a-zA-Z0-9_-]+)/);
			return link[0];
		} else {
			return false;
		}
	}
}

// Scroll page up
function scrollTop(){
	$('html,body').animate({scrollTop: 0}, 340);
}

// Scroll page up with height
function scrollTo(height){
	$('html,body').animate({scrollTop: height}, 340);
}

// Show the error message in the bar.
function errorBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","error_bar");

	$("#message_bar").html(message);
	$("#message_bar").fadeIn(80);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}

// Show the success message in the bar.
function successBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","success_bar");

	$("#message_bar").html(message);
	$("#message_bar").fadeIn(80);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}

// Show the messages in the bar.
function messageBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","message_bar");

	$("#message_bar").html(message);
	$("#message_bar").fadeIn(80);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}

// Show circle load
function loadingCircle(status) {
	if (status) {
		$(".loadingBlock").fadeOut(0);
		$(".loadingBlock").fadeIn(150);
	} else {
		$(".loadingBlock").fadeOut(150);
	}
}

// Show inline load
function loadingLine(status) {
	if (status) {
		$(".progress-loading").fadeOut(0);
		$(".progress-loading").show();
		$(".progress-bar").css("width","1%");
		timeoutLoading = true;
		loadingTime(2);
	} else {
		timeoutLoading = false;
		loadingTime(100);
	}
	
}

// Manager progres bar
function loadingTime(time){
	if (time < 36) {
		delay = 50;
	} else if(time < 66) {
		delay = 100;
	} else {
		delay = 200;
	}
	if (timeoutLoading) {
		timeoutLoading = setTimeout(function(){
			$(".progress-bar").css("width",time+"%");
			if (time < 98) {
				loadingTime(time+1)
			}
		},delay);
	} else {
		timeoutLoading = false;
		$(".progress-bar").css("width","100%");
		$(".progress-loading").delay(1000).fadeOut(0);
		setTimeout(function(){
			$(".progress-bar").css("width","0%");
		},1500);
	}
}

// Make ajax with a action
function json(data,loading,file){
	process = (file == undefined) ? true: false;
	content = (file == undefined) ? "application/x-www-form-urlencoded; charset=UTF-8": false;
	if (loading == "line") {
		loadingLine(true);
	} else if(loading == "circle") {
		loadingCircle(true);
	}
	
	var returnData;
	$.ajax({
		type: "POST",
		url: "/ajax/",
		contentType: content,					
		async: false,
		cache: false,
		dataType: "json",
		timeout:8000,
		data: data,
		processData: process,
		success: function(ajaxData){
			returnData = ajaxData;
		},
		error: function(){
			console.log("Erro na conexão.");
			returnData = false;
		}
	});
	
	if (loading == "line") {
		loadingLine(false);
	} else if(loading == "circle") {
		loadingCircle(false);
	}
	return returnData;
}

$("document").ready(function(){
	var screenHeight = screen.height - 200;
	$("#system_html").css("min-height",screenHeight);
});

