<?php

declare(strict_types = 1);

// Your Code

function pre(mixed $print): void{
  print '<pre>';
  print '<div class="left-right">';
  print '<div class="lr-element"><h3>print_r</h3>';
  print_r($print);
  print '</div>';
  print '<div class="lr-element"><h3>var_dump</h3>';
  var_dump($print);
  print '</div>';
  print '<div class="lr-element"><h3>var_export</h3>';
  var_export($print);
  print '</div>';
  print '</pre>';
}

function files_to_array_in(string $dir): array{
  $array = [];
  $a_dir = scandir($dir);
  foreach($a_dir as $data){
    $pathData = $dir . $data;
    if(is_file($pathData))
      $array[] = $pathData;
  }
  return $array;
}

$lines = [];
$a_files = files_to_array_in(FILES_PATH . DIRECTORY_SEPARATOR);
$array_draft = [];
foreach ($a_files as $file) {
  $file = fopen($file, 'r');
  while ($line = fgetcsv($file)) {
    $lines[] = $line;
    foreach ($line as $key => $value) {
      $array_draft[$key][] = $value;
    }
  }
}

unset($lines[0]);
$lines = array_values($lines);
foreach($lines as &$line){
  $tempDate = explode('/', $line[0]);
  $date = date_create("$tempDate[2]-$tempDate[0]-$tempDate[1]");
  $line[0] = date_format($date,"M j, Y");
  //Green/Red

}

$allMoney = [];

foreach ($array_draft[3] as $key => $money) {
  $money = str_replace(['$', ','], '', $money);
  if (intval($money)){
    $money = floatval($money);
    $allMoney[] = $money;
  }
}

function netTotal(array $allMoney): float{
  $total = 0;
  foreach ($allMoney as $value) {
    $total += $value;
  }
  return $total;
}

function getIncomes(array $allMoney): int|float
{
  $income = 0;
  foreach($allMoney as $value){
    if($value>0)
      $income += $value;
  }
  return $income;
}

function getExpenses(array $allMoney): int|float
{
  $income = 0;
  foreach($allMoney as $value){
    if($value<0)
      $income += $value;
  }
  return $income;
}

function arrayToTable(array $array): void{
  foreach($array as $line){
    
    print '<tr>';
    foreach($line as $key => $value){
      if($key<3)
        echo '<th>',$value,'</th>';
      else{
        $money = str_replace(['$', ','], '', $value);
        if (floatval($money)){
          if($money>0)
            echo '<th style="color: green">',$value,'</th>';
          else
          echo '<th style="color: red">',$value,'</th>';
        }
        else
        echo '<th>',$value,'</th>';
      }
    }
    print '</tr>';
  }
}

