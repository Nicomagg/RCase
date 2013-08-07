$(document).ready(function() {
	$('#container').empty()
	$.get('login.html',function(data) {
		$('#container').append(data)
		$('#log').css('margin-top',(window.innerHeight-196)/2)
	})
})