jQuery.noConflict(); 
jQuery(document).ready(function() {
		// generate a slug when the user types a title in
		pyro.generate_slug('input[name="name"]', 'input[name="slug"]');
});