CKEDITOR.editorConfig = function(config) {
   config.filebrowserBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
   config.allowedContent = true;
   config.contentsCss = [ '/css/app.css', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300' ];
};
CKEDITOR.plugins.addExternal( 'codemirror', '/bundles/jeroenedcmsed/ckeditor-plugins/codemirror/', 'plugin.js' );
