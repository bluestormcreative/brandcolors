(function( $ ) {

    tinymce.PluginManager.add('bsc_bc_tinymce_button', function( editor, url ) {


        editor.addButton( 'bsc_bc_tinymce_button', {
            text: 'Brand Colors',
            type: 'menubutton',
            icon: 'icon dashicons-art',
            tooltip: 'Select some text and wrap it in your brand colors',
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
