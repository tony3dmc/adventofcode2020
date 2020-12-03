<?php

$numbers = array_filter(array_map('trim', file('input.txt')));

foreach ($numbers as $left) {
  foreach ($numbers as $right) {
    if ($left + $right == 2020) {
      var_dump($left * $right);
      exit;
    }
  }
}

