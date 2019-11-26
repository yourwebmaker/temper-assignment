<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

final class CSVParser
{
    /** @var array */
    private $csvRows;

    public function __construct(string $csvPath)
    {
        $this->csvRows = file($csvPath);
    }

    public function parse() : array
    {
        $data = [];

        foreach ($this->csvRows as $i => $csvRow) {
            $csvRowData =  str_getcsv($csvRow, ';');
            $onboardingPercentage = $csvRowData[2];

            if ($i === 0 || empty($onboardingPercentage)) {
                continue;
            }

            $data[] = [
                'createdAt' => $csvRowData[1],
                'onboardingPercentage' => $onboardingPercentage,
            ];
        }

        return $data;
    }
}