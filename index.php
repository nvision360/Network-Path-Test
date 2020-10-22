<?php
require("helper/Dijkstra.php");

function calculate() {

  $filename = 'latency.csv';
  $the_big_array = []; 
  $reverse = "false";
  
  if (($h = fopen("{$filename}", "r")) !== FALSE) {
    while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
      $the_big_array[] = $data;		
    }
    fclose($h);
  } else {
    echo "CSV file not found";
  }
  
  echo "\n\nPlease input details eg: A B 1000\n\n";
  
  $input = readline();
  
  if (strtolower($input) == "quit") {
    exit();
  }
  
  $userInput = explode(" ", $input);
  $a = strtoupper($userInput[0]);
  $b = strtoupper($userInput[1]);
  $milliSeconds= $userInput[2];
  
  $fromPosition = positions($a, strlen($a));
  $toPosition = positions($b, strlen($b));
  
  $g = new Graph();
  for($i=1; $i<count($the_big_array); $i++) {
    $g->addedge($the_big_array[$i][0], $the_big_array[$i][1], $the_big_array[$i][2]);
  }
  
  if($fromPosition > $toPosition) {
        $reverse = "true";
        list($distances, $prev) = $g->paths_from("$b");
        $path = $g->paths_to($prev, "$a");
  }
  else {
        $reverse = "false";
        list($distances, $prev) = $g->paths_from("$a");
        $path = $g->paths_to($prev, "$b");
  }
  
  $totalSec = 0;
  foreach($path as $value) {
    $totalSec = $distances[$value];
  }

  if($totalSec > $milliSeconds) {
    echo "Path not found";
  } else {
        if($reverse == "true") {
            echo strrev(implode(" >= ",$path))." ".$totalSec;
        } else {
            echo implode(" => ",$path)." ".$totalSec;
        }
    }
    flush();
    calculate();
  }

  function positions($str, $n) 
  {
    $a = 31;
    for ($i = 0; $i < $n; $i++) {
        return ord($str[$i])&($a);
    }
  }
  
  calculate();
?>