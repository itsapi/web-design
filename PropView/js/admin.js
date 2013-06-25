function getUsers() {
	$.getJSON('include/admin_ajax.php', {
		func: 'getUsers'
	}).done(function(data) {
		console.log(data);
		$.each(data, function(){
			$('select#user').append('<option value="'+this['username']+'">'+this['username']+'</option>');
		});
	});
}

$(document).ready(function(){
	getUsers();
	$('.viewUser').submit(function() {
		$.getJSON('include/admin_ajax.php', {
			func: 'getInfo',
			user: $('select#user').val()
		}).done(function(data) {
			console.log(data);
			$('#username').val(data['username']);
			$('#email').val(data['email']);
			$('#firstname').val(data['firstname']);
			$('#surname').val(data['surname']);
			$('#address').val(data['address']);
			$('#addressb').val(data['addressb']);
			$('#subscription').val(data['subscription']);
			$('#payment').val(data['payment']);
		});
		return false;
	});
	$('.editUser').submit(function() {
		console.log($(this).serializeArray());
		if ($('#password').val() == $('#passwordc').val()){
			formItems = $(this).serializeArray();
			$.ajax({
				url: 'include/admin_ajax.php',
				data: {
					func: 'editUser',
					user: $('#username').val(),
					formData: JSON.stringify(formItems)
				}
			}).done(function() {
				$('.editUser').trigger('reset');
				alert('Successfully saved user');
			}).fail(function(jqXHR, textStatus){
				alert('Failed to save user: ' + textStatus);
			}).always(function(){
				getUsers();
			});
		} else {
			alert('Passwords must be the same');
		}
		return false;
	});
});