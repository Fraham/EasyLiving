<?php 
	$file = "update.bat";
	exec($file.' 2>&1', $output);
	foreach($output as $line)
		echo "$line <br>";
?>