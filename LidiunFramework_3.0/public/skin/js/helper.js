//--------- Json -----//
var jsonTimeOut = false;
//--------- Wittle -----//
var mouse_is_inside = false;
var page_selected = false;
//--------- Wittle Search -----//
var WittleSearch = false;
var firstWittleSearch = true;
//--------- Wittle -----//

function injectString(string){
	var dateTime = new Date();
	var day = dateTime.getDate();
	var day = (day > 9) ? day : "0"+day;
	var month = dateTime.getMonth()+1;
	var month =  (month > 9) ? month : "0"+month;
	var yer = dateTime.getFullYear();
	var hour = dateTime.getHours();
	var min = dateTime.getMinutes();
	var date = day+'/'+month+'/'+yer+' '+ hour + ':' + min;
	var eu = $(".mensagem-content").attr("rel");
	var link = string.match(/(((http|ftp|https):\/\/)|www\.)[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#!]*[\w\-\@?^=%&/~\+#])?/g);
	string = string.replace(/(((http|ftp|https):\/\/)|www\.)[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#!]*[\w\-\@?^=%&/~\+#])?/, "<a href='http://"+link+"' target='_blank'>"+link+"</a>");
	var html = '<div class="clear_fix"><div class="fluid_grid_16"><strong class="heading8 color_blue"><span class="color_blue">'+eu+'</span></strong><p>'+string+'</p><span class="heading11 color_gray">Enviado: '+date+'</span></div></div><hr class="clear-10">';
	$("#content-message").find("#"+peopleSelected).find(".message").prepend(html);
}

function validateName(nome) {
	var regex = /[^\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ]/;
	if (!regex.test(nome)) {
		return true;
	} else {
		return false;
	}
}
function validateNamePage(nome) {
	var regex = /[^\s-()1234567890abcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ]/;
	if (!regex.test(nome)) {
		return true;
	} else {
		return false;
	}
}
function validateUser(user) {
	var regex = /[^(abcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZ)+(_0123456789)?]/;
	if (!regex.test(user)) {
		return true;
	} else {
		return false;
	}
}
function validateEmail(email) {
	var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/;
	if (regex.test(email)) {
		return true;
	} else {
		return false;
	}
}

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

// Usano na ingeção de html para não pegar as tags como <i>.
function escapeHtml(text){
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

// Move o backgorund
function move(nun){
	$("#background").css("background-position-y",nun);
	setTimeout(function(){
		nun = nun + 1;
		move(nun);
	},10);
}

// Sobe a barra de rolagem ao topo
function scrollTop(){
	$('html,body').animate({scrollTop: 0}, 340);
}

// Sobe a barra de rolagem ao topo
function scrollTopSeacrh(){
	$('html,body').animate({scrollTop: 180}, 200);
}

// Sobe a barra de rolagem quando no mural
function scrollMural(){
	$('html,body').animate({scrollTop: 170}, 0);
}

// Sobe a barra de rolagem para um height específico
function scrollTo(height){
	$('html,body').animate({scrollTop: height}, 340);
}

// Show the success message in line.
function success(message){
	$("#Success").fadeOut(0);
	$("#Error").fadeOut(0);
	$("#Success").html(message);
	$("#Success").fadeIn(200);
}
// Show the error message in line.
function error(message){
	$("#Success").fadeOut(0);
	$("#Error").fadeOut(0);
	$("#Error").html(message);
	$("#Error").fadeIn(200);
}
// Show the error message in the bar.
function errorBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","error_bar");

	$("#message_bar").html(message);
	$("#message_bar").slideDown(200);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}
// Show the success message in the bar.
function successBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","success_bar");

	$("#message_bar").html(message);
	$("#message_bar").slideDown(200);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}
// Show the messages of Wittle in the bar.
function messageBar(message){
	$("#message_bar").fadeOut(0);
	$("#message_bar").attr("class","message_bar");

	$("#message_bar").html(message);
	$("#message_bar").slideDown(200);
	setTimeout(function(){$("#message_bar").fadeOut(2000);} ,6000);
}

// Light box script
function loadingCircle(status) {
	if (status) {
		$(".loadingCircle").fadeOut(0);
		$(".loadingCircle").fadeIn(150);
	} else {
		$(".loadingCircle").fadeOut(0);
	}
}

// Light box script
function loadingLine(status) {
	if (status) {
		$("#progress_bar").fadeOut(0);
		$("#progress_bar").fadeIn(200);
	} else {
		$("#progress_bar").fadeOut(0);
	}
	
}

function closeLightBoxInfo(){
	$("#lightbox_out_info").fadeOut(100);
	$("#lightbox_mensagem_info").html('');
}

function closeLightBoxAsk(){
	$("#lightbox_out_ask").fadeOut(100);
	$("#lightbox_mensagem_ask").html('');
}

function closeLightBoxMail(){
	$("#lightbox_out_mail").fadeOut(100);
	$("#emailPasswd").val('');
}

function openLightBoxInfo(mensagem){
	$("#lightbox_out_info").fadeOut(0);
	$("#lightbox_mensagem_info").html(mensagem);
	$("#lightbox_out_info").fadeIn(100);
	box_in = false;
	box_out = false;
}

function openLightBoxAsk(mensagem){
	$("#lightbox_out_ask").fadeOut(0);
	$("#lightbox_mensagem_ask").html(mensagem);
	$("#lightbox_out_ask").fadeIn(100);
	box_in = false;
	box_out = false;
}

function openLightBoxMail(){
	$("#lightbox_out_mail").fadeOut(0);
	$("#lightbox_out_mail").fadeIn(100);
	box_in = false;
	box_out = false;
}

// make ajax with a action
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

	// Light box
	var box_in = false;
	var box_out = false;
	
	$("#lightbox_in_ask").click(function(){
		box_in = true;
	});
	
	$("#lightbox_in_ask").mouseout(function(){
		box_in = false;
	});
	
	$("#lightbox_out_ask").click(function(){
		box_out = true;

		if (box_out == true && box_in == false) {
			closeLightBoxAsk();
			box_in = false;
			box_out = false;
		}
	});
	
	$("#lightbox_in_info").click(function(){
		box_in = true;
	});
	
	$("#lightbox_in_info").mouseout(function(){
		box_in = false;
	});
	
	$("#lightbox_out_info").click(function(){
		box_out = true;

		if (box_out == true && box_in == false) {
			closeLightBoxInfo();
			box_in = false;
			box_out = false;
		}
	});
	
	$("#lightbox_in_mail").click(function(){
		box_in = true;
	});
	
	$("#lightbox_in_mail").mouseout(function(){
		box_in = false;
	});
	
	$("#lightbox_out_mail").click(function(){
		box_out = true;

		if (box_out == true && box_in == false) {
			closeLightBoxMail();
			box_in = false;
			box_out = false;
		}
	});
});

