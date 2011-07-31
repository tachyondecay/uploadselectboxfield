/*
 * Autocomplete Tags
 */

jQuery(document).ready(function($) {
	function uploadPreview(fieldElement) {
		var fieldContainer = $(fieldElement).parents('div').eq(0);
		var currentImg = Symphony.Context.get('root') + '/workspace' +  $(fieldElement).attr('data-path') + '/' + $(fieldElement).val();
		$('.uploadselectbox-preview img', fieldContainer).attr('src', currentImg);
	}
	
	$('.field-uploadselectbox .preview-images').each(function() {
		$(this).parents('div').eq(0).append(
			$(document.createElement('p')).addClass('uploadselectbox-preview').text('Preview').append(
				$(document.createElement('img'))
			)
		);
		uploadPreview(this);
	}).change(function() { uploadPreview(this); });
});