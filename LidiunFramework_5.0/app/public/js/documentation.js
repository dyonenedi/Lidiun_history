var searchTimeout = true;
var breakLoop = false
var countSearch = 0;
var searchWord = '';
var tempElement = false;
var searchWordTemp = '';

function searchText(searchWord){
	if (searchTimeout && searchWord.length >= 3) {
		searchTimeout = false;
		setTimeout(function(){
			resetShine(searchWord);
			findingText(searchWord);
			if (breakLoop) {
				breakLoop = false;
			} else {
				countSearch = 0;
				findingText(searchWord);
				breakLoop = false;
			}
			
			searchTimeout = true;
		}, 500);
	}
}

function findingText(searchWord){
	i = 0;
	$('html, body').find('p').each(function(){
		if ($(this).text().search('(' + searchWord + ')') != -1 && breakLoop == false) {
			if (i == countSearch) {
				$('html, body').animate({
				    scrollTop: ($(this).offset().top - 200)
				},500);
				$(this).html($(this).text().replace(searchWord,'<font class="shine">' + searchWord + '</font>'));
				tempElement = $(this);
				breakLoop = true;
			}
			i++;
		}
	});	
}

function resetShine(searchWord){
	if (tempElement) {
		tempElement.html(tempElement.html().replace('<font class="shine">' + searchWordTemp + '</font>', searchWordTemp));
	}
	searchWordTemp = searchWord;
}

$(document).ready(function(){
	$("#search-box").keyup(function(){
		countSearch = 0;
		searchWord = $("#search-box").val();
		searchText(searchWord);
	});

	$("#next").click(function(){
		countSearch++;
		searchText(searchWord);
	});
});