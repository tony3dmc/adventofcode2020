<?php

$lines = array_map('trim', file('input.txt'));

$answers = [];
$current = '';
$people = 0;
foreach ($lines as $line) {
  if ($line) {
    $current .= $line;
    $people++;
  } else {
    $answers[] = [$people, trim($current)];
    $current = '';
    $people = 0;
  }
}
if ($current) {
  $answers[] = [$people, $current];
}

$sum = 0;
foreach ($answers as $set) {
  list ($people, $answer) = $set;
  $sum += count_consensus($people, $answer);
}

printf("The sum of the unanimous yes answers is %d\n", $sum);


function count_consensus($people, $string) {
  $freq = [];
  for ($i = 0; $i < strlen($string); $i++) {
    if (!isset($freq[$string[$i]])) {
      $freq[$string[$i]] = 0;
    }
    $freq[$string[$i]]++;
  }
  return count(array_filter($freq, function($e) use ($people) { return $e == $people; }));
}

