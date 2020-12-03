<?php

$lines = array_filter(array_map('trim', file('input.txt')));

$width = strlen($lines[0]);
$terrain = [];
foreach ($lines as $y => $line) {
  for ($x = 0; $x < strlen($line); $x++) {
    $terrain[$y][$x] = $line[$x];
  }
}

function traverse($right, $down) {
  global $terrain;
  global $width;
  $trees = 0;
  $pos = 0;
  for ($y = 0; $y < count($terrain); $y += $down) {
    if ($terrain[$y][$pos % $width] == '#') {
      $trees++;
    }
    $pos += $right;
  }
  return $trees;
}

var_dump(
  traverse(1, 1) *
  traverse(3, 1) *
  traverse(5, 1) *
  traverse(7, 1) *
  traverse(1, 2)
);

