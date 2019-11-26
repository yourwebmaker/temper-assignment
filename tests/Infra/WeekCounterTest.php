<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

use PHPUnit\Framework\TestCase;

class WeekCounterTest extends TestCase
{
    /** @var WeekCounter */
    private $counter;

    public function setUp() : void
    {
        $data = [
            'week 48' => [
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 10,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 10,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 10,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 20,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 30,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 30,],
            ],
            'week 49' => [
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 10,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 10,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 50,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 50,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 99,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 100,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 99,],
            ]
        ];

        $this->counter = new WeekCounter($data);
    }

    /**
     * @test
     */
    public function countPerWeek(): void
    {
        self::assertEquals(6, $this->counter->count()['week 48']['count']);
        self::assertEquals(7, $this->counter->count()['week 49']['count']);
    }

    /**
     * @test
     */
    public function countPerOnboardingPercentage(): void
    {
        self::assertEquals(3, $this->counter->count()['week 48']['onboardingPercentagesCounts'][10]);
        self::assertEquals(2, $this->counter->count()['week 48']['onboardingPercentagesCounts'][30]);

        self::assertEquals(3, $this->counter->count()['week 49']['onboardingPercentagesCounts'][100]);
        self::assertEquals(2, $this->counter->count()['week 49']['onboardingPercentagesCounts'][99]);
    }
}

