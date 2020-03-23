/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/browse.php?type=files';
   	config.filebrowserImageBrowseUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 'http://arsip.semarangkota.go.id/assets/js/ckeditor/kcfinder/upload.php?type=flash';
};
