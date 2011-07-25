/*
 * Autocomplete Tags
 */

jQuery(document).ready(function($) {
	function uploadPreview(fieldContainer) {
		var fieldElement = $(fieldContainer).find('select');
		var currentImg = $(fieldElement).attr('data-path') + '/' + $(fieldElement).val();
		$('.uploadselectbox-preview img', fieldContainer).attr('src', currentImg);
	}
	
	$('.field-uploadselectbox').each(function() {
		$(this).append(
			$(document.createElement('p')).addClass('uploadselectbox-preview').text('Preview').append(
				$(document.createElement('img'))
			)
		);
		uploadPreview(this);
	}).change(function() { uploadPreview(this); });
});