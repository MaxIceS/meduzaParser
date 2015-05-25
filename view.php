<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Parser for meduza.io</title>
</head>
<body>
	<?php 
		// This need comment by deploy for Ogorodnik
		// libxml_use_internal_errors(true);

		$url ="https://meduza.io/";
		$url = iconv("UTF-8","windows-1251",$url);
		$html_str = file_get_contents($url);
		$html_str = gzdecode($html_str);

		$dom = new DOMDocument;
		$dom->recover = true;
		$dom->strictErrorChecking = false;
   		if ($dom->loadHTML($html_str)){
	   		$x_path = new DOMXPath($dom);
			$news = $x_path->query('//span[@class="NewsTitle-first"]');
			foreach ($news as $new) {
			    echo "<div><textarea>".$new->nodeValue."</textarea></div>";
			}
		}else{
			echo "Aaaaa, капец какой-то, Настя, мне надо уходить из программирования";
		}
	?>
</body>
</html>