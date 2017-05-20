CKEDITOR.editorConfig = function(config) {
   config.filebrowserBrowseUrl = '/admin/elfinder?mode=files';
   config.filebrowserImageBrowseUrl = '/admin/elfinder?mode=image';
   config.filebrowserFlashBrowseUrl = '/admin/elfinder?mode=flash';
   config.filebrowserImageWindowWidth = '950';
   config.filebrowserImageWindowHeight ='520';
   config.filebrowserWindowWidth = '950';
   config.filebrowserWindowHeight = '520';
   config.allowedContent = true;
   config.contentsCss = [ '/css/app.css', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300' ];
};
CKEDITOR.plugins.addExternal( 'codemirror', '/bundles/jeroenedcmsed/ckeditor-plugins/codemirror/codemirror/', 'plugin.js' );
