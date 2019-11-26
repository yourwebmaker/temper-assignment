<?php
$csvRows = file(__DIR__ . '/../data/export.csv');
$data = [];
foreach ($csvRows as $i => $csvRow) {

    [$userId, $dateCreatedTime, $step] = str_getcsv($csvRow, ';');

    if ($i === 0 || empty($step)) {
        continue;
    }

    $weekNumber = (DateTimeImmutable::createFromFormat('Y-m-d', $dateCreatedTime))->format('W');
    $weekKey = 'week ' . $weekNumber;

    if (isset($data[$weekKey]['total'])) {
        $data[$weekKey]['total']++;
    } else {
        $data[$weekKey]['total'] = 1;
    }

    if (isset($data[$weekKey]['steps'][$step]['total'])) {
        $data[$weekKey]['steps'][$step]['total']++;
    } else {
        $data[$weekKey]['steps'][$step]['total'] = 1;
    }
}

$mappedData = array_map(static function ($week) {
    ksort($week['steps']);
    return array_map(static function ($step) use ($week){
        $step['percentage'] = ($step['total'] /  $week['total']) * 100;
        return $step;
    }, $week['steps']);
}, $data);

$chartData = [];
foreach ($mappedData as $weekName => $week) {
    $chartData[$weekName] = [
        'name' => $weekName,
    ];

    $chartData[$weekName]['data'][0] = [0, 100];

    foreach ($week as $stepName => $step) {
        $chartData[$weekName]['data'][] = [(int) $stepName, (float) $step['percentage']];
    }
}

echo json_encode(array_values($chartData));