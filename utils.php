<?php
	function getHiddenModalWindow($news)
	{
		$i = 0;
		$result = '';
		foreach ($news as $new) {
			$result .= '<div id="div_'.++$i.'" class="edit-news-modal-window">';
			$result .= 		'<textarea id="text_'.$i.'" class="news" cols=50 rows=3>';
			$result .=			highlight($new->nodeValue);
			$result .= 		"</textarea>";
			$result .= 		'<button id="'.$i.'" class="btn-save-news-to-file">';
			$result .= 		'Сохранить новость в файл</button>';
			$result .= '</div>';
		}
		return $result;	
	}

	function getNewsDivs($news)
	{
		$i = 0;
		$result = '';
		foreach ($news as $new) {
			$result .= '<div id="div_'.++$i.'_dispalay">';
			$result .=		highlight($new->nodeValue);
			$result .= '</div>';
			$result .= '<a href="#div_'.$i.'" name="modal">Редактировать новость</a>';
		}
		return $result;
	}

	function highlight($str)
	{
		return highlightNumbers(highlightWordsWithT($str));
	}

	function highlightNumbers($str)
	{
		return preg_replace('/(\d+?)/', '<span class="numbers">$1</span>', $str);
	}

	function highlightWordsWithT($str)
	{
		$words = preg_split("/\s+/", $str);

		for ( $i = 0; $i < count($words); $i++ ) {
			if (strpos($words[$i], 'т') || strpos($words[$i], 'Т')){
				$words[$i] = '<span class="word">'.$words[$i].'</span>';
			}
		}

		$new_str = implode(" ", $words);
		return $new_str;
	}
	
?>