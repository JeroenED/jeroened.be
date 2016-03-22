CKEDITOR.editorConfig = function(config) {
   config.filebrowserBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
   config.allowedContent = true
};
CKEDITOR.plugins.addExternal( 'codemirror', '/bundles/jeroenedcmsed/ckeditor-plugins/codemirror/', 'plugin.js' );