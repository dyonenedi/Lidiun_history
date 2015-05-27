$(document).ready(function(){
	$('#sendMessageForm').submit(function(e){
		var formId = this.id;
		e.preventDefault();
		var data = _submit(formId);
		if (data.reply) {
			$('#message').html(data.message);
		} else {
			alertBar(data.message);
		}
	});
});