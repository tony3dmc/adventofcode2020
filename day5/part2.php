<?php

$lines = array_filter(array_map('trim', file('input.txt')));

$ids = [];
foreach ($lines as $pass) {
  $ids[] = getId(getCol($pass), getRow($pass));
}

sort($ids);
printf("All seats: %s\n", implode(', ', $ids));

$last = array_shift($ids);
foreach ($ids as $id) {
  if ($id != $last + 1) {
    printf("The missing seat is %d\n", $last + 1);
    break;
  }
  $last = $id;
}

function getCol($pass) {
  return subdivide(substr($pass, 0, 7), 'F', 'B');
}

function getRow($pass) {
  return subdivide(substr($pass, 7, 3), 'L', 'R');
}

function subdivide($pass, $left, $right) {
  $min = 0;
  $max = (2 ** strlen($pass)) - 1;
  for ($i = 0; $i < strlen($pass); $i++) {
    $half = ($max - $min + 1) / 2;
    if ($pass[$i] == $left) {
      $max -= $half;
    } elseif ($pass[$i] == $right) {
      $min += $half;
    }
  }
  return $min;
}

function getId($col, $row) {
  return $col * 8 + $row;
}
