(function() {
	tinymce.create('tinymce.plugins.samuweb_related_questions_tiny_mce', {
		init: function(ed, url) {
			ed.addButton('samuweb_related_questions_tiny_mce', {
				title: 'Samuweb Related Questions',
				image: url + '/samuweb-related-questions-icon.png',
				onclick : function() {
					var samuweb_related_questions_selected_text = tinyMCE.activeEditor.selection.getContent();

					// Finds out if the user didn't select anything
					if(!samuweb_related_questions_selected_text) {
						window.alert('Feed my thrist of knowledge first!\nSelect the text that is the answer for a question');
					} else {
						// Asks the user for some input
						var samuweb_related_questions_prompt_title = prompt('This selected text is the answer to which question?\ne.g. How to make an awesome blog?\n(if you leave it blank, it will copy what is selected)', '');

						// Generates the shortcode
						if(samuweb_related_questions_prompt_title != null && samuweb_related_questions_prompt_title != '') {
							ed.execCommand('mceInsertContent', false, '[related-questions title="' + samuweb_related_questions_prompt_title + '"]' + samuweb_related_questions_selected_text + '[/related-questions]');
						} else {
							ed.execCommand('mceInsertContent', false, '[related-questions title="' + samuweb_related_questions_selected_text + '"]' + samuweb_related_questions_selected_text + '[/related-questions]');
						}
					}
				}
			});
		}, createControl : function(n, cm) {
			return null;
		}, getInfo : function() {
			return {
				longname : "Samuweb Related Questions",
				author : 'Samuel Nasta',
				authorurl : 'http://samuweb.info/',
				infourl : 'http://samuweb.info/samuweb-related-questions-wordpress-plugin/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('samuweb_related_questions_tiny_mce', tinymce.plugins.samuweb_related_questions_tiny_mce);
})();