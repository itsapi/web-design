function getProperties() {
	$.getJSON('include/user_ajax.php', {
		func: 'getProperties',
		user: userData['id']
	}).done(function(data) {
		console.log(data);
		$('.viewProperty #property').html('');
		$.each(data, function(){
			$('.viewProperty #property').append('<option value="'+this['id']+'">'+this['name']+'</option>');
		});
	});
}

$(document).ready(function(){
	$('.editAccount').hide();
	var button;
	getProperties();
	$('#addProperty').click(function(){
		$('.editAccount').hide();
		$('.editProperty').show();
		$('.editProperty #subscription').show();
		$('.editProperty label[for="subscription"]').show();
		$('.editProperty legend').html('Add property:');
		$('.editProperty').trigger('reset');
	});
	$('#editAccount').click(function(){
		$('.editProperty').hide();
		$('.editAccount').show();
		$.getJSON('include/user_ajax.php', {
			func: 'getAccount',
			user: userData['id']
		}).done(function(data) {
			console.log(data);
			$('.editAccount #username').val(data['username']);
			$('.editAccount #email').val(data['email']);
			$('.editAccount #firstname').val(data['firstname']);
			$('.editAccount #surname').val(data['surname']);
		});
	});
	$('.viewProperty .viewButton').click(function(){
		button = 'viewButton';
	});
	$('.viewProperty .deleteButton').click(function(){
		button = 'deleteButton';
	});
	$('.viewProperty').submit(function() {
		if (button == 'viewButton'){
			$('.editAccount').hide();
			$('.editProperty').show();
			$('.editProperty #subscription').hide();
			$('.editProperty label[for="subscription"]').hide();
			$('.editProperty legend').html('Edit property:');
			$.getJSON('include/user_ajax.php', {
				func: 'getInfo',
				id: $('.viewProperty #property').val()
			}).done(function(data) {
				console.log(data);
				$('.editProperty #id').val(data['id']);
				$('.editProperty #name').val(data['name']);
				$('.editProperty #address').val(data['address']);
				$('.editProperty #size').val(data['size']);
				$('.editProperty #buildings').val(data['buildings']);
				$('.editProperty #subscription').val(data['subscription']);
			});
		} else {
			if (confirm('Are you sure you want to delete ' + $('.viewProperty #property').val() + '?')){
				$.ajax({
					url: 'include/user_ajax.php',
					data: {
						func: 'deleteProperty',
						property: $('.viewProperty #property').val()
					}
				}).done(function() {
					alert('Delete property request sent.');
				}).fail(function(jqXHR, textStatus){
					alert('Failed to delete property: ' + textStatus);
				}).always(function(){
					getProperties();
				});
			}
		}
		return false;
	});
	$('.editProperty').submit(function() {
		console.log($(this).serializeArray());
		formItems = $(this).serializeArray();
		$.ajax({
			url: 'include/user_ajax.php',
			data: {
				func: 'editProperty',
				id: $('.editProperty #id').val(),
				formData: JSON.stringify(formItems)
			}
		}).done(function(data) {
			$('.editProperty').trigger('reset');
			switch (data.split(':')[1]) {
				case 'approved':
					alert('Successfully updated property: '+data.split(':')[0]);
					break;
				case 'pending':
					alert('Successfully updated property: '+data.split(':')[0]+'\nIt will now be approved by the admin.');
					break;
				case 'new':
					alert('Successfully added property: '+data.split(':')[0]+'\nIt will now be approved by the admin.');
					break;
			}
		}).fail(function(jqXHR, textStatus){
			alert('Failed to save property: ' + textStatus);
		}).always(function(){
			getProperties();
		});
		return false;
	});
	$('.editAccount').submit(function() {
		console.log($(this).serializeArray());
		if ($('.editAccount #password').val() == $('.editAccount #passwordc').val()){
			formItems = $(this).serializeArray();
			$.ajax({
				url: 'include/user_ajax.php',
				data: {
					func: 'editAccount',
					user: userData['id'],
					formData: JSON.stringify(formItems)
				}
			}).done(function() {
				$('#addProperty').click();
				alert('Successfully saved account');
			}).fail(function(jqXHR, textStatus){
				alert('Failed to save account: ' + textStatus);
			});
		} else {
			alert('Passwords must be the same');
		}
		return false;
	});
});