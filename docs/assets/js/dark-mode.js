/* Dependency: js-cookie plugin - Ref: https://github.com/js-cookie/js-cookie */

$(document).ready(function() {

	function setThemeFromCookie() {
		// Check if the cookie is set 
		if (typeof Cookies.get('mode') !== "undefined" ) {
			$('body').addClass("dark-mode");
			$('#darkmode').attr('checked', true); // toggle change
			console.log('Cookie: dark mode' );
		} else {
			$('body').addClass("dark-mode");
			$('#darkmode').attr('checked', false); // toggle change
			console.log('Cookie: light mode' );
		}
	}
	
	setThemeFromCookie();

	
	
	
});	