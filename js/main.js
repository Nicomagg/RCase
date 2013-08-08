$(document).ready(function() {
	$.get('login.html',function(data) {
		$('#container').empty()
		$('#container').append(data)
		$('#log').css('margin-top',(window.innerHeight-196)/2)
	})
})