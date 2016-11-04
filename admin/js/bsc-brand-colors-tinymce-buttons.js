(function() {
    tinymce.PluginManager.add('bsc_bc_tinymce_button', function( editor, url ) {
        editor.addButton( 'bsc_bc_tinymce_button', {
            text: 'My test button',
            icon: false,
            onclick: function() {
                editor.insertContent('Hello World!');
            }
        });
    });
})();
