<?php

$lines = array_map('trim', file('input.txt'));

$search = [ 'shiny gold' ];

$rules = [];
foreach ($lines as $line) {
  list($container, $definition) = explode(' contain ', $line);
  $container = substr($container, 0, -5);

  $bags = [];
  foreach (explode(', ', $definition) as $rule) {
    list($quantity, $bag) = explode(' ', $rule, 2);
    $bag = preg_replace('/ bags?.?$/', '', $bag);
    if ($bag != 'other') {
      $bags[$bag] = $quantity;
    }
  }

  $rules[$container] = $bags;
}

function sum_contents($key, $rules, &$sum, $depth = 0) {
  if (!$rules[$key]) {
    return;
  }
  printf("%s Processing %s\n", str_repeat(' ', $depth), implode(',', array_keys($rules[$key])));
  foreach ($rules[$key] as $bag => $count) {
    printf("%s - Adding %d %s bags\n", str_repeat(' ', $depth), $count, $bag);
    $sum += $count;
    for ($i = 0; $i < $count; $i++) {
      sum_contents($bag, $rules, $sum, $depth + 1);
    }
  }
}


$sum = 0;
sum_contents('shiny gold', $rules, $sum);
var_dump($sum);

