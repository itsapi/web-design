$(document).ready(function(){
	$('input').change(function(){
		fpl = 11490 + 4020*($('#persons').val().replace(/[^\d.]/g, "")-1);
		$('#percentFPL').val(($('#income').val().replace(/[^\d.]/g, "")/fpl*100).toFixed(2)+'%');
		var fplVal = $('#percentFPL').val().replace(/[^\d.]/g, "");
		if (fplVal > 300){
			$('#description').html(
'<ul>\
	<li>BC+ Benchmark Plan limit for pregnant women</li>\
	<li>BC+ Prenatal Program Benchmark Plan limit</li>\
</ul>'
			);
		} else if (fplVal > 200){
			$('#description').html(
'<ul>\
	<li>BC+ Standard Plan limit for children, pregnant women, and parents/relative caretakers</li>\
	<li>BC+ Prenatal Program Standard Plan Limit</li>\
	<li>BC+ Family Planning Services limit</li>\
	<li>Qualified Disabled and Working Individual limit</li>\
	<li>Premiums for children on BC+ begin</li>\
</ul>'
			);
		} else if (fplVal > 150){
			$('#description').html(
'<ul>\
	<li>BC+ Emergency Services limit for children ages 6 - 18</li>\
</ul>'
			);
		} else if (fplVal > 133){
			$('#description').html(
'<ul>\
	<li>Premiums for parents & relative caretakers on BC+ begin</li>\
	<li>Premiums for adults on BC+ Core Plan begin</li>\
	<li>BC+ backdating cutoff for non-pregnant, non-disabled adults</li>\
	<li>Crowd-out tests begin for non-pregnant, non-disabled adults</li>\
</ul>'
			);
		} else {
			$('#description').html(
'<ul>\
	<li>Qualified Medicare Beneficiary limit</li>\
	<li>Co-pays for children on BC+ begin</li>\
</ul>'
			);
		}
		return false;
	});
});