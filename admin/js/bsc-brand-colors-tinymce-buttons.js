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
			text: '',
			type: 'menubutton',
			classes: 'bsc-bc-button',
			icon: 'icon dashicons-admin-appearance',
			tooltip: 'Select some text and wrap it in your brand colors',
			menu: [
				{
					text: ( php_vars.brand_colors['primary-label'] ? php_vars.brand_colors['primary-label'] : 'Primary' ),
					value: php_vars.brand_colors['primary-color'],
					classes: 'bc-button-first',
					onclick: function() {
						editor.focus();
							var color = this.value();
							var text = editor.selection.getContent({'format': 'html'});

							if(text && text.length > 0) {
							editor.execCommand('forecolor', false, color );
						}
					}
				},
				{
					text: ( php_vars.brand_colors['second-label'] ? php_vars.brand_colors['second-label'] : 'Secondary' ),
					value: php_vars.brand_colors['second-color'],
					classes: 'bc-button-second',
					onclick: function() {
						editor.focus();
							var color = this.value();
							var text = editor.selection.getContent({'format': 'html'});

							if(text && text.length > 0) {
							editor.execCommand('forecolor', false, color );
						}
					}
				},
				{
					text: ( php_vars.brand_colors['third-label'] ? php_vars.brand_colors['third-label'] : 'Tertiary' ),
					value: php_vars.brand_colors['third-color'],
					classes: 'bc-button-third',
					onclick: function() {
						editor.focus();
							var color = this.value();
							var text = editor.selection.getContent({'format': 'html'});

							if(text && text.length > 0) {
							editor.execCommand('forecolor', false, color );
						}
					}
				},
				{
					text: 'Clear Color',
					value: 'clear',
					classes: 'bc-button-clear',
					onclick: function() {
						editor.focus();
							var text = editor.selection.getContent({'format': 'html'});

							if(text && text.length > 0) {
							editor.execCommand('removeFormat');
						}
					}
				},
			]
		});
	},

	/**
	 * Returns information about the plugin as a name/value array.
	 * The current keys are longname, author, authorurl, infourl and version.
	 *
	 * @return {Object} Name/value array containing information about the plugin.
	 */
	getInfo : function() {
		return {
			longname : 'Simple Branded Text Colors',
			author : 'BlueStormCreative',
			authorurl : 'https://bluestormcreative.com',
			version : "0.1"
		};
	}
});

// Register plugin
tinymce.PluginManager.add( 'bsc_bc_tinymce_button', tinymce.plugins.BSC_BC );


})();
