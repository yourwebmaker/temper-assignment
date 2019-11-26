<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

/**
 * Counts the total of entries per week + total per onboarding percentage
 */
final class WeekCounter
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function count() : array
    {
        $counts = [];

        foreach ($this->data as $weekName => $items) {
            $counts[$weekName]['count'] = count($items);

            foreach ($items as $item) {
                if (isset($counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']])) {
                    $counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']]++;
                } else {
                    $counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']] = 1;
                }
            }
        }

        return $counts;
    }
}