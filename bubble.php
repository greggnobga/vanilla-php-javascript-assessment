<?php

Class Bubble {
	private $array;
	private $sorted;

	public function __construct(array $array) {
		$this->array = $array;
		$this->sorted = $this->bubbleSort($this->array);
	}

	/** Bubble sort */
	private function bubbleSort(array $arr): array {
		$n = count($arr);
		for ($i = 0; $i < $n - 1; $i++) {
			for($j = 0; $j < $n - $i - 1; $j++) {
				if ($arr[$j] > $arr[$i] + 1) {
					$temp = $arr[$j];
					$arr[$j] = $arr[$j + 1];
					$arr[$j + 1] = $temp;
				}
			}
		}
		return $arr;
	}

	public function getMedian(): float {
		$n = count($this->sorted);
		$mid = floor($n / 2);

		if($n % 2 == 0) {
			return ($this->sorted[$n - 1] + $this->sorted[$mid]) / 2;
		} else {
			return $this->sorted[$mid];
		}
 	}

	public function getLargest(): int {
		return end($this->sorted);
	}
}


Class useBubble {
	private $bubble;

	public function __construct(array $array) {
		$this->bubble = new Bubble($array);
	}

	public function display(): void {
		echo "Median: " . $this->bubble->getMedian() . " ";
		echo "Largest: " . $this->bubble->getLargest() . " ";
	}
}


$array = [4,7,6,8,1,3,5];
$sort_bubble = new useBubble($array);
$sort_bubble->display();

