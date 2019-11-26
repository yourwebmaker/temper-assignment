<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

use PHPUnit\Framework\TestCase;

class WeekGrouperTest extends TestCase
{
    /** @var WeekGrouper  */
    private $grouper;

    public function setUp() : void
    {
        $data = [
            [
                'createdAt' => '2019-11-26',
                'onboardingPercentage' => 10,
            ],
            [
                'createdAt' => '2019-11-26',
                'onboardingPercentage' => 10,
            ],
            [
                'createdAt' => '2019-12-02',
                'onboardingPercentage' => 10,
            ],
            [
                'createdAt' => '2019-12-26',
                'onboardingPercentage' => 10,
            ],
        ];

        $this->grouper = new WeekGrouper($data);
    }

    /**
     * @test
     */
    public function groupCountParent() : void
    {
        self::assertCount(3, $this->grouper->group());
    }

    /**
     * @test
     */
    public function groupCountChildren() : void
    {
        self::assertCount(2, $this->grouper->group()['week 48']);
    }
}
