/**********************************************************
* Lidiun JS Pattern 1.0 - (http://www.lidiun.com)
*
* @Created 08/08/2014
* @Author  Dyon Enedi <dyonenedi@hotmail.com>
* @License: http://www.lidiun.com/license/
*
**********************************************************/

function scrollTop(){
	$('html,body').animate({scrollTop: 0}, 340);
}

function scrollTo(height){
	$('html,body').animate({scrollTop: height}, 340);
}

var meesageTimeout;
function alertBar(message){
	clearTimeout(meesageTimeout);
	$("#messageBar").fadeOut(80);
	$("#messageBar").html(message);
	$("#messageBar").attr('class', 'alert-bar');
	$("#messageBar").fadeIn(80);
	meesageTimeout = setTimeout(function(){$("#messageBar").fadeOut(2000);} ,6000);
}

var successTimeout;
function successBar(message){
	clearTimeout(meesageTimeout);
	$("#messageBar").fadeOut(80);
	$("#messageBar").html(message);
	$("#messageBar").attr('class', 'success-bar');
	$("#messageBar").fadeIn(80);
	meesageTimeout = setTimeout(function(){$("#messageBar").fadeOut(2000);} ,6000);
}

var serrorTimeout;
function errorBar(message){
	clearTimeout(meesageTimeout);
	$("#messageBar").fadeOut(80);
	$("#messageBar").html(message);
	$("#messageBar").attr('class', 'error-bar');
	$("#messageBar").fadeIn(80);
	meesageTimeout = setTimeout(function(){$("#messageBar").fadeOut(2000);} ,6000);
}

function refresh(time) {
	if (time == undefined) {
		time = 8000;
	}

	setTimeout(function(){
		window.location = window.location.pathname+"/";
		window.location = window.location.origin+"/";
	},time);
}

function redirect(url) {
	window.location = window.location.pathname+"/"+url;
	window.location = window.location.origin+"/"+url;
}

function ajax(data,method,url,file){
	var returnData;

	if (data == undefined) {
		console.log("data object is required in ajax method.");
		return false;
	}

	process = (file == undefined || !file) ? true: false;
	content = (file == undefined || !file) ? "application/x-www-form-urlencoded; charset=UTF-8": false;
	method = (method == undefined) ? "POST" : method;
	url = (url == undefined) ? "/web/" : url;

	$.ajax({
		type: method,
		url: url,
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
	
	return returnData;
}

function _submit(formId) {
	var data = $("#" + formId).serializeArray();
	var reply = ajax(data);
	
	return reply;
}

