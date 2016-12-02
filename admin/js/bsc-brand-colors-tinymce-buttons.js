(function() {

    tinymce.create('tinymce.plugins.BSC_BC', {
    /**
     * Initializes the plugin, this will be executed after the plugin has been created.
     * This call is done before the editor instance has finished it's initialization so use the onInit event
     * of the editor instance to intercept that event.
     *
     * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
     * @param {string} url Absolute URL to where the plugin is located.
     */
    init : function(editor, url) {

        editor.addButton( 'bsc_bc_tinymce_button', {
            text: 'Brand Colors',
            type: 'menubutton',
            classes: 'bsc-bc-button',
            icon: 'icon dashicons-art',
            tooltip: 'Select some text and wrap it in your brand colors',
            menu: [
                {
                    text: 'Primary Color',
                    value: php_vars.brand_colors['primary-color'],
                    classes: 'bc-button-first',
					// inline: 'span',
					// styles: {color: php_vars.brand_colors['primary-color']},
                    onclick: function() {
                        //wrapSelection( this.value() );
						editor.focus();
							var color = this.value();
							var text = editor.selection.getContent({'format': 'html'});

							if(text && text.length > 0) {
							editor.execCommand('mceReplaceContent', false, '<span style="'+color+'">'+text+'</span>');
						}
                    }
                },
                {
                    text: 'Second Color',
                    value: php_vars.brand_colors['second-color'],
                    classes: 'bc-button-second',
                    onclick: function() {
                        wrapSelection( this.value() );
                    }
                },
                {
                    text: 'Third Color',
                    value: php_vars.brand_colors['third-color'],
                    classes: 'bc-button-third',
                    onclick: function() {
                        wrapSelection( this.value() );
                    }
                },
                {
                    text: 'Clear',
                    value: 'clear',
                    classes: 'bc-button-clear',
                    onclick: function() {
                        clearSelection();
                    }
                },
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


        function clearSelection() {
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

            // Set our new selection content with no color span.
            tinyMCE.activeEditor.selection.setContent( selection );
        }
    },

    /**
     * Returns information about the plugin as a name/value array.
     * The current keys are longname, author, authorurl, infourl and version.
     *
     * @return {Object} Name/value array containing information about the plugin.
     */
    getInfo : function() {
        return {
            longname : 'BSC Brand Color Button',
            author : 'BlueStormCreative',
            authorurl : 'https://bluestormcreative.com',
            version : "0.1"
        };
    }
});

// Register plugin
tinymce.PluginManager.add( 'bsc_bc_tinymce_button', tinymce.plugins.BSC_BC );


})();
