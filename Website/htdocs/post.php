<?php
	if (isset($_POST["msg"]))
	{
		require "connect.php";
		
		$newdata = $_POST["msg"];
		
		$sql = "INSERT INTO test (data)
		VALUES ('".$_POST["msg"]."')";
		
		if (!$conn->query($sql)) {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		//notify();
		echo date('Y-m-d H:i:s');
	}
	
	function notify()
	{
		$url = "dynamicTest.php";
		$data = array('update' => 'true');

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		var_dump($result);
	}
?>