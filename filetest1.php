<?php
header("content-type:image/jpeg");
        
		$data=file_get_contents("./".$_GET["a"]);
		 echo $data;
		?>
		
		