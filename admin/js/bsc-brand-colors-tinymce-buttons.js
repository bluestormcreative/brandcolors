(function($) {

    //php_vars.brand_colors
    //
    //console.log(php_vars.brand_colors['primary-color']);

    tinyMCE.PluginManager.add('bsc_bc_tinymce_button', function( editor, url ) {

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
                    value: php_vars.brand_colors['primary-color'],
                    onclick: function() {
                        wrapSelection( this.value() );
                    }
                },
                {
                    text: 'Second Color',
                    value: php_vars.brand_colors['second-color'],
                    onclick: function() {
                        wrapSelection( this.value() );
                    }
                },
                {
                    text: 'Third Color',
                    value: php_vars.brand_colors['third-color'],
                    onclick: function() {
                        wrapSelection( this.value() );
                    }
                }
            ]
        });

        function wrapSelection( color ) {

            selection = tinyMCE.activeEditor.selection.getContent();

            tinyMCE.activeEditor.selection.setContent('<span class="brand-color" style="color: ' + color + '">' + selection + '</span>');
        }
    });
})(jQuery);
