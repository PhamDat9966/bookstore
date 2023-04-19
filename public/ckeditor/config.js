/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/bookstore/public/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/bookstore/public/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/bookstore/public/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/bookstore/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/bookstore/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/bookstore/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
