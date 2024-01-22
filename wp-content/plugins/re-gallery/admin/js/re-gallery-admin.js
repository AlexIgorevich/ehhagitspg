(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );
function remove_img(value) {
	let parent=jQuery(value).parent().parent();
	parent.remove();
}
let media_uploader = null;
function open_media_uploader_image(obj){
	media_uploader = wp.media({
		frame:    "post",
		state:    "insert",
		multiple: false
	});
	media_uploader.on("insert", function(){
		let json = media_uploader.state().get("selection").first().toJSON();
		let image_url = json.url;
		let html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
		console.log(image_url);
		jQuery(obj).append(html);
		jQuery(obj).find('.meta_image_url').val(image_url);
	});
	media_uploader.open();
}
function open_media_uploader_image_this(obj){
	media_uploader = wp.media({
		frame:    "post",
		state:    "insert",
		multiple: false
	});
	media_uploader.on("insert", function(){
		let json = media_uploader.state().get("selection").first().toJSON();
		let image_url = json.url;
		console.log(image_url);
		jQuery(obj).attr('src',image_url);
		jQuery(obj).siblings('.meta_image_url').val(image_url);
	});
	media_uploader.open();
}

function open_media_uploader_image_plus(){
	media_uploader = wp.media({
		frame:    "post",
		state:    "insert",
		multiple: true
	});
	media_uploader.on("insert", function(){

		let length = media_uploader.state().get("selection").length;
		let images = media_uploader.state().get("selection").models

		for(let i = 0; i < length; i++){
			let image_url = images[i].changed.url;
			let box = jQuery('#master_box').html();
			jQuery(box).appendTo('#img_box_container');
			let element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
			let html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
			element.append(html);
			element.find('.meta_image_url').val(image_url);
			console.log(image_url);
		}
	});
	media_uploader.open();
}
jQuery(function() {
	jQuery("#img_box_container").sortable();
});
