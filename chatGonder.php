<?php
	/*
	$lastvisit = $_COOKIE["lachatlv"];
	setcookie("lachatlv", time());
	*/

    $fn = "chat.txt";

    if(isset($_POST["t"])){
		 $tur = $_POST["t"]; //1:gönder 2:al
	}else{
		$tur="0";
	}
	if(isset($_POST["m"])){
		$msg = $_POST["m"];
	}else{
		$msg="";
	}
	
	function getLines($file)
	{
		$f = fopen($file, 'rb');
		$lines = 0; $buffer = '';

		while (!feof($f)) {
			$buffer = fread($f, 8192);
			$lines += substr_count($buffer, "\n");
		}

		fclose($f);

		if (strlen($buffer) > 0 && $buffer[-1] != "\n") {
			++$lines;
		}
		return $lines;
	}
	
	
	if ($tur == "1") {
		if ($msg != "") {
			$myfile = fopen("chat.txt", "r") or die("Unable to open file!");
			if(getLines("chat.txt")>1000){
				$out="Sohbet 1000 satıra ulaştığından silinmiştir.";
			}else{
				$out = fread($myfile,filesize("chat.txt"))."\n".substr($msg,0,1000);
				$out = str_replace("\'", "'", $out);
				$out = str_replace("\\\"", "\"", $out);
			}
			$myfile = fopen("chat.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $out);
			fclose($myfile);
			echo getLines("chat.txt");
		}
	}else if ($tur == "2") {
		    $myfile = fopen("chat.txt", "r") or die("Unable to open file!");
			echo fread($myfile,filesize("chat.txt"));
			fclose($myfile);
	}

?>
