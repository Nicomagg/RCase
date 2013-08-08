$(document).ready(function() {
	// $.get('login.html',function(data) {
	// 	$('#container').empty()
	// 	$('#container').append(data)
	// })
	load('login')
	window.onhashchange = function() {
		load((document.location.hash).substr(3))
	}
})

load = function(dir) {
	history.pushState(null,'','#!/'+dir)
	$('a[target!=_blank]').off('click','**')
	$.get('html/'+dir+'.html',function(data) {
		$('#container').empty().append(data)
	}).done(function() {
		document.location.hash='#!/'+dir
	})
}