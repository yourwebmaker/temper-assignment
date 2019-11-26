<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

use PHPUnit\Framework\TestCase;

class WeekCounterTest extends TestCase
{
    /** @var WeekPercentageCalculator */
    private $calculator;

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
            ],
            'week 50' => [
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 99,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 99,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 11,],
                ['createdAt' => '2019-11-26', 'onboardingPercentage' => 15,],
            ]
        ];

        $this->calculator = new WeekPercentageCalculator($data);
    }

    /**
     * @test
     */
    public function countPerWeek(): void
    {
        self::assertEquals(50, $this->calculator->count()['week 50'][99]['percentage']);
        self::assertEquals(25, $this->calculator->count()['week 50'][11]['percentage']);
        self::assertEquals(25, $this->calculator->count()['week 50'][15]['percentage']);
    }

    /**
     * @test
     */
    public function keysAreSorted() : void
    {
        self::assertEquals([11,15,99], array_keys($this->calculator->count()['week 50']));
    }
}

