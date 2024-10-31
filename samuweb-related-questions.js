// Samuweb Related Questions WordPress Plugin

var samuweb_related_questions_anchor = document.getElementsByClassName('samuweb-related-questions-anchor');
var samuweb_related_questions_length = document.getElementsByClassName('samuweb-related-questions-anchor').length;

// When page loads, seeks for every related question and fills the related questions box
if(samuweb_related_questions_length > 0) {
	var samuweb_related_questions_box = document.getElementById('samuweb-related-questions-box');

	for(var i=0; i < samuweb_related_questions_length; i++) {
		var content = samuweb_related_questions_box.innerHTML += '<a href="#' + samuweb_related_questions_anchor[i].getAttribute('id') + '" onclick="samuweb_related_questions_highlight(' + i + ')">' + samuweb_related_questions_anchor[i].getAttribute('data-title') + '</a>';
	}
}

// Adds a highlight in the answer so the user can read only what matters to him/her
function samuweb_related_questions_highlight(i) { 
	samuweb_related_questions_anchor[i].className = samuweb_related_questions_anchor[i].className + ' samuweb-related-questions-highlight';
	window.setTimeout(function(){
		document.getElementById(samuweb_related_questions_anchor[i].id).className = 'samuweb-related-questions-anchor';
	}, 5000);
}