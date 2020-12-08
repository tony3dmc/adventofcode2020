<?php

$lines = array_map('trim', file('input.txt'));

$ops = [];
foreach ($lines as $line) {
  list($instruction, $value) = explode(' ', $line);
  $ops[] = [
    'instruction' => $instruction,
    'value' => (int)$value,
    'executions' => 0
  ];
}

foreach ($ops as $k => $op) {
  $newops = $ops;
  switch($op['instruction']) {
    case 'acc':
      continue;
    case 'jmp':
      $newops[$k]['instruction'] = 'nop';
      break;
    case 'nop':
      $newops[$k]['instruction'] = 'jmp';
      break;
  }
  $ret = execute($newops);
  if ($ret) {
    var_dump($ret);
    exit;
  }
}


function execute($ops) {
  $i = 0;
  $acc = 0;
  $op = $ops[0];
  while ($op['executions'] <= 1) {
    if ($ops[$i]['executions'] == 1) {
      return false;
    }
    $ops[$i]['executions']++;
    $op = $ops[$i];
    if ($op['instruction'] == 'jmp') {
      $i += $op['value'];
      continue;
    }
    if ($op['instruction'] == 'acc') {
      $acc += $op['value'];
    }
    $i++;

    if ($i == count($ops) - 1) {
      return $acc;
    }
  }
}
