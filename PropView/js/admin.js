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
			$('#lastname').val(data['surname']);
			$('#address').val(data['address']);
			$('#addressb').val(data['addressb']);
			$('#subscription').val(data['subscription']);
			$('#payment').val(data['payment']);
		});
		return false;
	});
	$('.editUser').submit(function() {
		if ($('#password').val() == $('#passwordc').val()){
			$.getJSON('include/admin_ajax.php', {
				func: 'editUser',
				formData: $('.editUser').serialize()
			}).done(function(data) {
				console.log(data);
				$('.editUser').trigger('reset');
				alert('Successfully saved user');
			}).fail(function(){
				alert('Failed to save user');
			}).always(function(){
				getUsers();
			});
		} else {
			alert('Passwords must be the same');
		}
		return false;
	});
});