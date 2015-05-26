function highlight (str) {
	var newStr = clearSpans(str);

	var pattern_word_with_t = /([а-яА-Я]+?[тТ]+?[а-яА-Я]+)/g;
	newStr = str.replace(pattern_word_with_t, '<span class="word">$1</span>');

	var pattern_number = /(\d+?)/g;
	return newStr.replace(pattern_number, '<span class="numbers">$1</span>');
}

function clearSpans (str) {
	var pattern_start_span = /<span class="[a-z]+">/g;
	var newStr = str.replace(pattern_start_span, "");
	var pattern_end_span = /<\/span>/g;
	return newStr.replace(pattern_end_span, "");
}