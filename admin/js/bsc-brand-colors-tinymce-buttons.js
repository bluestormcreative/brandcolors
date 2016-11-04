(function() {
    tinymce.PluginManager.add('bsc_bc_tinymce_button', function( editor, url ) {
        editor.addButton( 'bsc_bc_tinymce_button', {
            text: 'Brand Colors',
            type: 'menubutton',
            icon: 'icon dashicons-art',
            menu: [
                  {
                      text: 'Menu item I',
                      value: 'Text from menu item I',
                      onclick: function() {
                          editor.insertContent(this.value());
                      }
                  }
             ]
        });
    });
})();
