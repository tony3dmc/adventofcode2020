<?php

$lines = array_filter(array_map('trim', file('input.txt')));

$width = strlen($lines[0]);
$terrain = [];
foreach ($lines as $y => $line) {
  for ($x = 0; $x < strlen($line); $x++) {
    $terrain[$y][$x] = $line[$x];
  }
}

$trees = 0;
$pos = 0;
for ($y = 0; $y < count($terrain); $y ++) {
  if ($terrain[$y][$pos % $width] == '#') {
    $trees++;
  }
  $pos += 3;
}
var_dump($trees);


