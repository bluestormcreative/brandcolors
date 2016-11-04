(function() {
    tinymce.PluginManager.add('bsc_bc_tinymce_button', function( editor, url ) {
        //this command will be executed when the button in the toolbar is clicked
        editor.addCommand('mceWRAP', function() {

            selection = tinyMCE.activeEditor.selection.getContent();

            tinyMCE.activeEditor.selection.setContent('<span class="brand-color">' + selection + '</span>');

        });
        editor.addButton( 'bsc_bc_tinymce_button', {
            text: 'Brand Colors',
            type: 'menubutton',
            icon: 'icon dashicons-art',
            menu: [
                {
                    text: 'Primary Color',
                    value: '#ff0000;',
                }
            ],
            cmd : 'mceWRAP'
        });
    });
})();
