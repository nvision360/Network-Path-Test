<?php
require("helper/Dijkstra.php");
calculate();

function calculate() {
	$filename = 'latency.csv';
	$the_big_array = [];
	if (($h = fopen("{$filename}", "r")) !== FALSE) 
	{
		while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
		{
			$the_big_array[] = $data;		
		}
		fclose($h);
	}else	{
		echo "CSV file not found";
	}
	echo "\n\nPlease enter details eg: A B 1000\n\n";
	$input = readline();

	if(strtolower($input) == "quit"){
		exit();
	}

	$userInput = explode(" ", $input);

	$a = $userInput[0];
	$b = $userInput[1];
	$milliSeconds= $userInput[2];

	$fromPosition = positions($a, strlen($a));
	$toPosition = positions($b, strlen($b));

	$g = new Graph();
	for($i=1; $i<count($the_big_array); $i++){
	  $g->addedge($the_big_array[$i][0], $the_big_array[$i][1], $the_big_array[$i][2]);
	}
}
?>