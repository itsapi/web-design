function getUsers() {
	$.getJSON('include/admin_ajax.php', {
		func: 'getUsers'
	}).done(function(data) {
		console.log(data);
		$('.viewUser #user').html('');
		$.each(data, function(){
			$('.viewUser #user').append('<option value="'+this['username']+'">'+this['username']+'</option>');
		});
	});
}

$(document).ready(function(){
	$('.editAccount').hide();
	var button;
	getUsers();
	$('#addUser').click(function(){
		$('.editAccount').hide();
		$('.editUser').show();
		$('.editUser legend').html('Add user:');
		$('.editUser #username, .editUser label[for="username"]').show();
		$('.editUser').trigger('reset');
	});
	$('#editAccount').click(function(){
		$('.editUser').hide();
		$('.editAccount').show();
		$.getJSON('include/admin_ajax.php', {
			func: 'getAccount'
		}).done(function(data) {
			console.log(data);
			$('.editAccount #username').val(data['username']);
			$('.editAccount #email').val(data['email']);
			$('.editAccount #firstname').val(data['firstname']);
			$('.editAccount #surname').val(data['surname']);
		});
	});
	$('.viewUser .viewButton').click(function(){
		button = 'viewButton';
	});
	$('.viewUser .deleteButton').click(function(){
		button = 'deleteButton';
	});
	$('.viewUser').submit(function() {
		if (button == 'viewButton'){
			$('.editAccount').hide();
			$('.editUser').show();
			$('.editUser legend').html('Edit user:');
			$('.editUser #username, .editUser label[for="username"]').hide();
			$.getJSON('include/admin_ajax.php', {
				func: 'getInfo',
				user: $('.viewUser #user').val()
			}).done(function(data) {
				console.log(data);
				$('.editUser #username').val(data['username']);
				$('.editUser #email').val(data['email']);
				$('.editUser #firstname').val(data['firstname']);
				$('.editUser #surname').val(data['surname']);
				$('.editUser #address').val(data['address']);
				$('.editUser #addressb').val(data['addressb']);
				$('.editUser #subscription').val(data['subscription']);
				$('.editUser #payment').val(data['payment']);
			});
		} else {
			if (confirm('Are you sure you want to delete ' + $('.viewUser #user').val() + '?')){
				$.ajax({
					url: 'include/admin_ajax.php',
					data: {
						func: 'deleteUser',
						user: $('.viewUser #user').val()
					}
				}).done(function() {
					alert('Successfully deleted user');
				}).fail(function(jqXHR, textStatus){
					alert('Failed to delete user: ' + textStatus);
				}).always(function(){
					getUsers();
				});
			}
		}
		return false;
	});
	$('.editUser').submit(function() {
		console.log($(this).serializeArray());
		formItems = $(this).serializeArray();
		$.ajax({
			url: 'include/admin_ajax.php',
			data: {
				func: 'editUser',
				user: $('.editUser #username').val(),
				formData: JSON.stringify(formItems)
			}
		}).done(function(data) {
			$('.editUser').trigger('reset');
			if (data.split(':').length == 2){
				alert('Successfully updated user: '+data.split(':')[0]);
			} else {
				alert('Successfully created user: '+data.split(':')[0]+' with password: '+data.split(':')[1]);
			}
		}).fail(function(jqXHR, textStatus){
			alert('Failed to save user: ' + textStatus);
		}).always(function(){
			getUsers();
		});
		return false;
	});
	$('.editAccount').submit(function() {
		console.log($(this).serializeArray());
		if ($('.editAccount #password').val() == $('.editAccount #passwordc').val()){
			formItems = $(this).serializeArray();
			$.ajax({
				url: 'include/admin_ajax.php',
				data: {
					func: 'editAccount',
					user: $('.editAccount #username').val(),
					formData: JSON.stringify(formItems)
				}
			}).done(function() {
				$('#addUser').click();
				alert('Successfully saved user');
			}).fail(function(jqXHR, textStatus){
				alert('Failed to save user: ' + textStatus);
			});
		} else {
			alert('Passwords must be the same');
		}
		return false;
	});
});