<?php

$lines = array_map('trim', file('input.txt'));
#$lines = array_map('trim', file('input_test.txt'));

$ops = [];
foreach ($lines as $line) {
  list($instruction, $value) = explode(' ', $line);
  $ops[] = [
    'instruction' => $instruction,
    'value' => (int)$value,
    'executions' => 0
  ];
}

$i = 0;
$acc = 0;
$op = $ops[0];
while ($op['executions'] <= 1) {
  $ops[$i]['executions']++;
  $op = $ops[$i];
  printf("(%d) %s %s. Acc=%d\n", $i, $op['instruction'], $op['value'], $acc);
  if ($op['instruction'] == 'jmp') {
    $i += $op['value'];
    printf("Jumping %s\n", $op['value']);
    continue;
  }
  if ($op['instruction'] == 'acc') {
    $acc += $op['value'];
    printf("Accumulating %s. Acc=%d\n", $op['value'], $acc);
  }
  $i++;
}

