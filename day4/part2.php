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
    if (validate($entities)) {
      $valid++;
    }
  }
}

function validate($e) {
  if (!(preg_match('/^\d{4}$/', $e['byr']) && $e['byr'] >= 1920 && $e['byr'] <= 2002)) {
    return false;
  }
  if (!(preg_match('/^\d{4}$/', $e['iyr']) && $e['iyr'] >= 2010 && $e['iyr'] <= 2020)) {
    return false;
  }
  if (!(preg_match('/^\d{4}$/', $e['eyr']) && $e['eyr'] >= 2020 && $e['eyr'] <= 2030)) {
    return false;
  }
  $height = substr($e['hgt'], 0, -2);
  $unit = substr($e['hgt'], -2, 2);
  if ($unit == 'cm' && ($height < 150 || $height > 193)) {
    return false;
  } elseif ($unit == 'in' && ($height < 59 || $height > 76)) {
    return false;
  } elseif ($unit != 'cm' && $unit != 'in') {
    return false;
  }
  if (!preg_match('/^#[a-f0-9]{6}$/', $e['hcl'])) {
    return false;
  }
  if (!in_array($e['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
    return false;
  }
  if (!preg_match('/^\d{9}$/', $e['pid'])) {
    return false;
  }
  return true;
}

echo "There are $valid valid passports from the " . count($passports) . " total\n";
