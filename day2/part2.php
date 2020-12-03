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

function isValid($pos1, $pos2, $letter, $password) {
  $has_pos1 = $password[$pos1-1] == $letter;
  $has_pos2 = $password[$pos2-1] == $letter;
  if ($has_pos1 + $has_pos2 == 1) {
    return true;
  }
  return false;
}

