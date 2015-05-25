<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Parser for meduza.io</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function () {
		    var buttons = document.querySelectorAll('.btn-save-news-to-file');
    		for (var i = buttons.length - 1; i >= 0; i--) { 
    			buttons[i].addEventListener("click", function () {
    				var id = this.getAttribute("id");
    				console.log("aaaaa" + id);
    				var newsElement = document.getElementById("text_"+ id);
    				var oMyBlob = new Blob([newsElement.value], {type : 'text/html'}); // the blob
					var downloadUrl = URL.createObjectURL(oMyBlob);
    				var div = document.getElementById("div_"+ id);

    				var isAalreadyExist = true;
    				var a = document.getElementById("a_"+ id);
    				if (a == null){
    					a = document.createElement('a');
    					isAalreadyExist = false;
    				}
    				a.id = "a_" + id;
		            a.title = "Скачать бесплатно!";
		            a.innerHTML = a.title;
		            a.href = downloadUrl;
		            a.download = a.title;
		            
		            if (false == isAalreadyExist){
	    				div.appendChild(a);
	    			}
				})
    		};
		});
	</script>
</head>
<body>
	<?php 
		// This need comment by deploy for Ogorodnik
		libxml_use_internal_errors(true);

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
			$i = 0;
			foreach ($news as $new) {
			    echo '<div id="div_'.++$i.'"><textarea id="text_'.$i.'" class="news" cols=50 rows=3>'.$new->nodeValue."</textarea>";
			    echo '<button id="'.$i.'" class="btn-save-news-to-file">Сохранить новость в файл</button></div>';
			}
		}else{
			echo "Aaaaa, капец какой-то, Настя, мне надо уходить из программирования";
		}
	?>
</body>
</html>