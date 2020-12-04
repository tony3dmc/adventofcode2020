<?php

#$lines = array_map('trim', file('input_test.txt'));
$lines = array_map('trim', file('input.txt'));

$required_keys = ['byr', 'ecl', 'eyr', 'hcl', 'hgt', 'iyr', 'pid', 'cid'];
$passports = [];
$current = '';
foreach ($lines as $line) {
  if ($line) {
    $current .= $line . ' ';
  } else {
    $passports[] = trim($current);
    $current = '';
  }
}

$valid = 0;
foreach ($passports as $passport) {
  $parts = preg_split('/\s+/', $passport);
  $entities = [];
  foreach ($parts as $part) {
    list($k, $v) = explode(':', $part);
    $entities[$k] = $v;
  }
  if (!isset($entities['cid'])) {
    $entities['cid'] = '';
  }
  $missing = array_diff($required_keys, array_keys($entities));
  if (!$missing) {
    $valid++;
  }
}

echo "There are $valid valid passports from the " . count($passports) . " total\n";
