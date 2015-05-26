<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="UTF-8"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Parser for meduza.io</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
	<script type="text/javascript" src="highlight.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script type="text/javascript">

		var currentPopupNewsId = null;

		$(document).ready(function() {	

			//select all the a tag with name equal to modal
			$('a[name=modal]').click(function(e) {
				//Cancel the link behavior
				e.preventDefault();
				
				//Get the A tag
				var id = $(this).attr('href');
				currentPopupNewsId = id;
			
				//Get the screen height and width
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
			
				//Set heigth and width to mask to fill up the whole screen
				$('#mask').css({'width':maskWidth,'height':maskHeight});
				
				//transition effect		
				$('#mask').fadeIn(1000);	
				$('#mask').fadeTo("slow",0.8);	
			
				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();
		              
				//Set the popup window to center
				$(id).css('position', "absolute");				
				$(id).css('left', winW/2-$(id).width()/2);
				$(id).css('top',  winH/2-$(id).height()/2);
				
				//transition effect
				$(id).fadeIn(2000); 
			
			});
			
			//if mask is clicked
			$('#mask').click(function () {
				var editedNewsContent = $(currentPopupNewsId + " > div" ).html();
				// console.log(editedNewsContent);
				var editedNewsContent = highlight(editedNewsContent);
				// console.log(editedNewsContent);
				var dispalayDivId = currentPopupNewsId + "_dispalay";
				$(dispalayDivId).html(editedNewsContent.string);
				console.log("span" + currentPopupNewsId);
				console.log($("span" + currentPopupNewsId).html());
				console.log(editedNewsContent.length);
				$("span" + currentPopupNewsId).html(editedNewsContent.length);
				$(this).hide();
				$('.edit-news-modal-window').hide();
			});
		});

		document.addEventListener('DOMContentLoaded', function () {
		    var buttons = document.querySelectorAll('.btn-save-news-to-file');
    		for (var i = buttons.length - 1; i >= 0; i--) { 
    			buttons[i].addEventListener("click", function () {
    				var id = this.getAttribute("id");
    				console.log("aaaaa" + id);
    				var newsElement = document.getElementById("text_"+ id);
    				var oMyBlob = new Blob([newsElement.innerHTML], {type : 'text/html'}); // the blob
					var downloadUrl = URL.createObjectURL(oMyBlob);
    				var div = document.getElementById("div_"+ id);

    				var isAalreadyExist = true;
    				var a = document.getElementById("a_"+ id);
    				if (a == null){
    					a = document.createElement('a');
    					isAalreadyExist = false;
    				}
    				a.id = "a_" + id;
		            a.title = "Download free!";
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
		// header('Content-type: text/plain; charset=utf-8');

		include 'utils.php';
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
			$input = getHiddenModalWindow($news).getNewsDivs($news);
			echo $input;
		}else{
			echo "Aaaaa, капец какой-то  - интеренет умер.";
		}
	?>

	<!-- Mask to cover the whole screen -->
	<div id="mask"></div>
</body>
</html>