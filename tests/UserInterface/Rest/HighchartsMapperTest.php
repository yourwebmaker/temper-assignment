<?php

declare(strict_types=1);

namespace Temper\Assignment\UserInterface\Rest;

use PHPUnit\Framework\TestCase;
use Temper\Assignment\UserInterface\Rest\HighchartsMapper;

class HighchartsMapperTest extends TestCase
{
    /** @var HighchartsMapper */
    private $mapper;

    public function setUp() : void
    {
        $data = [
            'week 48' => [
                10 => ['count' => 3, 'percentage' => 50.0,],
                20 => ['count' => 1, 'percentage' => 16.666666666666664,],
                30 => ['count' => 2, 'percentage' => 33.33333333333333,],
            ],
            'week 49' => [
                10 => ['count' => 2, 'percentage' => 28.57142857142857,],
                50 => ['count' => 2, 'percentage' => 28.57142857142857,],
                99 => ['count' => 2, 'percentage' => 28.57142857142857,],
            ],
            'week 50' => [
                11 => ['count' => 1, 'percentage' => 25.0,],
                15 => ['count' => 1, 'percentage' => 25.0,],
                99 => ['count' => 2, 'percentage' => 50.0,],
            ],
        ];

        $this->mapper = new HighchartsMapper($data);
    }

    /**
     * @test
     */
    public function firsItemCoordinatesIs0And100(): void
    {
        self::assertEquals([0, 100], $this->mapper->map()[0]['data'][0]);
    }

    /**
     * @test
     */
    public function nameIsAdded() : void
    {
        self::assertEquals('week 48', $this->mapper->map()[0]['name']);
    }

    /**
     * @test
     */
    public function elementsAreMappedToCoordinates() : void
    {
        self::assertEquals([10, 50], $this->mapper->map()[0]['data'][1]);
    }
}

