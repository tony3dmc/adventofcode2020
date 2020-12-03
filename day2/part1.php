<?php

$lines = array_filter(array_map('trim', file('input.txt')));

echo "Test input checks....\n";
var_dump([
  isValid(1, 3, 'a', 'abcde'),
  isValid(1, 3, 'b', 'cdefg'),
  isValid(2, 9, 'c', 'cccccccc')
]);


$count = 0;
foreach ($lines as $line) {
  preg_match('/^(\d+)-(\d+) (\w+): (\w+)$/', $line, $m);
  if (isValid($m[1], $m[2], $m[3], $m[4])) {
    $count++;
  }
}

echo "There are $count valid passwords\n"; 

function isValid($min, $max, $letter, $password) {
  $no = substr_count($password, $letter);
  if ($no >= $min && $no <= $max) {
    return true;
  }
  return false;
}

