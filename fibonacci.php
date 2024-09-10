<?php

function fibSeq($n) {
	if($n < 1) return "Input must be greater than 0";

	$fib = [0,1];

	for($i = 2; $i < $n; $i++) {
		$fib[] = $fib[$i - 1] + $fib[$i - 2];
	}

	return implode(", ", array_slice($fib, 0, $n));
}

$input = 5;
$result = fibSeq($input);
echo "Input: " . $input . " Output: " . $result;

