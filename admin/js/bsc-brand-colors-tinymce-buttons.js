(function() {

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

            // Get the selected node - we need the node for any html tags
            // TODO: I want this to only regex on .brand-color selectors...
            node = tinyMCE.activeEditor.selection.getNode();

            // Add a temporary div so we can strip out any tags
            var tmp = document.createElement("div");

            // Stuff our node into the temporary div
            tmp.appendChild(node);

            // Now let's get just the innerHTML of our temp div...
            selection = tmp.innerHTML;

            // And create a regex to remove html tags...
            var rex = /(<([^>]+)>)/ig;


            // And finally remove any tags from our selection.
            // TODO: this is set up to stop the button from endlessly wrapping our text in more and more spans. There must be a better way.
            selection = selection.replace( rex, "");

            // Set our new selection content and wrap in the proper color span.
            tinyMCE.activeEditor.selection.setContent('<span class="brand-color" style="color: ' + color + '">' + selection + '</span>');
        }

    });

})();
