<?php
	function getHiddenModalWindow($news)
	{
		$i = 0;
		$result = '';
		foreach ($news as $new) {
			$result .= '<div id="div_'.++$i.'" class="edit-news-modal-window">';
			$result .= 		'<textarea id="text_'.$i.'" class="news" cols=50 rows=3>';
			$result .=			$new->nodeValue;
			$result .= 		"</textarea>";
			// $result .=      '<a href="#"class="close"/>Close it</a>';
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
			$result .=			$new->nodeValue;
			$result .= '</div>';
			$result .= '<a href="#div_'.$i.'" name="modal">Редактировать новость</a>';
		}
		return $result;
	}
?>