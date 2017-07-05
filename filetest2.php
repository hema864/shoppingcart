<?php
header("content-type:image/jpeg");
		$data=file_get_contents("products/".$_GET["a"]);
		 echo $data;
		?>
		
		