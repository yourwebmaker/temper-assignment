<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

/**
 * Counts the total of entries per week + total per onboarding percentage
 */
final class WeekPercentageCalculator
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function count() : array
    {
        return array_map(static function ($week) {
            ksort($week['onboardingPercentagesCounts']);
            return array_map(static function ($step) use ($week){
                $step['percentage'] = ($step['count'] /  $week['count']) * 100;
                return $step;
            }, $week['onboardingPercentagesCounts']);
        }, $this->countOnboardingPercentages());
    }

    private function countOnboardingPercentages() : array
    {
        $counts = [];

        foreach ($this->data as $weekName => $items) {
            $counts[$weekName]['count'] = count($items);

            foreach ($items as $item) {
                if (isset($counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']]['count'])) {
                    $counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']]['count']++;
                } else {
                    $counts[$weekName]['onboardingPercentagesCounts'][$item['onboardingPercentage']]['count'] = 1;
                }
            }
        }

        return $counts;
    }
}