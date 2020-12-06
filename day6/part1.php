<?php

$lines = array_map('trim', file('input.txt'));

$answers = [];
$current = '';
foreach ($lines as $line) {
  if ($line) {
    $current .= $line;
  } else {
    $answers[] = trim($current);
    $current = '';
  }
}
if ($current) {
  $answers[] = $current;
}

$sum = 0;
foreach ($answers as $answer) {
#  printf("Input was %s which deduped is %s of length %d\n", $answer, dedupe($answer), strlen(dedupe($answer)));
  $sum += strlen(dedupe($answer));
}

printf("The sum of the unique yes answers is %d\n", $sum);


function dedupe($string) {
  $list = str_split($string);
  return implode('', array_unique($list));
}

