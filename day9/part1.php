<?php

$lines = array_map('trim', file('input.txt'));
#$lines = array_map('trim', file('input_test.txt'));

$preamble = [];
$size = 25;

foreach ($lines as $number) {
  if (count($preamble) == $size) {
    printf("Testing if %d is in the preamble\n", $number);
    if (!contains_sum($preamble, $number)) {
      printf("Found an invalid number: %d\n", $number);
      exit;
    }
  } else {
    printf("Initiating the preamble with %d\n", $number);
  }

  $preamble[] = $number;
  if (count($preamble) > $size) {
    $removed = array_shift($preamble);
    printf("Loading the preamble with %d and removing %d\n", $number, $removed);
  }
}

printf("Did not find any invalid numbers in the list\n");

function contains_sum($list, $num) {
  for ($i = 0; $i < count($list); $i++) {
    for ($j = 0; $j < count($list); $j++) {
      if ($i != $j) {
        if ($num == $list[$i] + $list[$j]) {
          printf(" - %d is the sum of %d and %d\n", $num, $list[$i], $list[$j]);
          return true;
        }
      }
    }
  }
  return false;
}
