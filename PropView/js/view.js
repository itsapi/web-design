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
});
