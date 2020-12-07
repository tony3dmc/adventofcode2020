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
    $bags[$bag] = $quantity;
  }

  $rules[$container] = $bags;
}

function search_for($key, $rules, &$matches) {
  foreach ($rules as $container => $contents) {
    if (isset($contents[$key])) {
      $matches[$container] = true;
      search_for($container, $rules, $matches);
    }
  }
}

$matches = [];
search_for('shiny gold', $rules, $matches);
var_dump(array_keys($matches));

