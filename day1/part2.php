<?php

$numbers = array_filter(array_map('trim', file('input.txt')));

foreach ($numbers as $left) {
  foreach ($numbers as $middle) {
    foreach ($numbers as $right) {
      if ($left + $middle + $right == 2020) {
        var_dump($left * $middle * $right);
        exit;
      }
    }
  }
}

