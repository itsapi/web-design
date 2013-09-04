$(document).ready(function(){
	$('.approveProp').submit(function() {
		console.log(propData);
		$.ajax({
			url: 'include/view_ajax.php',
			data: {
				func: 'approveProp',
				propData: propData
			}
		}).done(function() {
			alert('Successfully approved property');
			$('.approveProp').remove();
		}).fail(function(jqXHR, textStatus){
			alert('Failed to approve property: ' + textStatus);
		});
		return false;
	});
	$('.deleteProp').submit(function() {
		if (confirm('Are you sure you want to remove property?')){
			console.log(propData);
			$.ajax({
				url: 'include/view_ajax.php',
				data: {
					func: 'deleteProp',
					propData: propData
				}
			}).done(function() {
				alert('Successfully removed property');
			}).fail(function(jqXHR, textStatus){
				alert('Failed to remove property: ' + textStatus);
			});
			window.location.href = 'index.php';
		}
		return false;
	});
	$('.getID').submit(function() {
		alert("The property ID for this property is " + propData['id']);
		return false;
	});
	$('.map').submit(function() {
		window.open('maps/' + propData['id']);
		return false;
	});
});
