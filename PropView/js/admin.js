function getUsers() {
	$.getJSON('include/admin_ajax.php', {
		func: 'getUsers'
	}).done(function(data) {
		console.log(data);
		$('select#user').html('');
		$.each(data, function(){
			$('select#user').append('<option value="'+this['username']+'">'+this['username']+'</option>');
		});
	});
}

$(document).ready(function(){
	var button;
	getUsers();
	$('.viewButton').click(function(){
		button = 'viewButton';
	});
	$('.deleteButton').click(function(){
		button = 'deleteButton';
	});
	$('.viewUser').submit(function() {
		if (button == 'viewButton'){
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
		} else {
			if (confirm('Are you sure you want to delete ' + $('select#user').val() + '?')){
				$.ajax({
					url: 'include/admin_ajax.php',
					data: {
						func: 'deleteUser',
						user: $('select#user').val()
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
		return false;
	});
});