<?php
function integerPartitions($n) {
    $result = [];
    partitionHelper($n, $n, [], $result);
    return $result;
}

function partitionHelper($n, $max, $prefix, &$result) {
    if ($n == 0) {
        $result[] = $prefix;
        return;
    }

    for ($i = min($max, $n); $i >= 1; $i--) {
        partitionHelper($n - $i, $i, array_merge($prefix, [$i]), $result);
    }
}

function printPartitions($partitions) {
    foreach ($partitions as $partition) {
        echo implode(' ', $partition) . "\n";
    }
}
$argc=[0,99];
if ($argc > 1) {
    $n = intval($argc[1]);
    if ($n < 1 || $n >= 100) {
        echo "Input must be a positive integer less than 100.\n";
    } else {
        $start_time = microtime(true);

        // Use dynamic programming to generate partitions
        $partitions = integerPartitions($n);

        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;

        if ($execution_time > 3) {
            echo "Execution time exceeded 3 seconds: $execution_time seconds.\n";
        } else {
            usort($partitions, function ($a, $b) {
                for ($i = 0; $i < min(count($a), count($b)); $i++) {
                    if ($a[$i] != $b[$i]) {
                        return $b[$i] - $a[$i];
                    }
                }
                return count($b) - count($a);
            });
            printPartitions($partitions);
            echo "Execution time: $execution_time seconds.\n";
        }
    }
} else {
    echo "Please provide a positive integer less than 100 as an argument.\n";
}
?>