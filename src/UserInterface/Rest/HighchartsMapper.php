<?php

declare(strict_types=1);

namespace Temper\Assignment\UserInterface\Rest;

final class HighchartsMapper
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function map() : array
    {
        $chartData = [];
        foreach ($this->data as $weekName => $week) {
            $chartData[$weekName] = [
                'name' => $weekName,
            ];

            $chartData[$weekName]['data'][0] = [0, 100];

            foreach ($week as $stepName => $step) {
                $chartData[$weekName]['data'][] = [(int) $stepName, (float) $step['percentage']];
            }
        }

        return array_values($chartData);
    }
}