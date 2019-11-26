<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

use DateTimeImmutable;

final class WeekGrouper
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function group() : array
    {
        $groups = [];

        foreach ($this->data as $datum) {
            $weekNumber = (DateTimeImmutable::createFromFormat('Y-m-d', $datum['createdAt']))->format('W');
            $weekName = 'week ' . $weekNumber;
            $groups[$weekName][] = $datum;
        }

        return $groups;
    }
}