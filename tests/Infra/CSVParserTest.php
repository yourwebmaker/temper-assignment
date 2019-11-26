<?php

declare(strict_types=1);

namespace Temper\Assignment\Infra;

use PHPUnit\Framework\TestCase;

class CSVParserTest extends TestCase
{
    /** @var CSVParser */
    private $parser;

    public function setUp() : void
    {
        $this->parser = new CSVParser(__DIR__ . '/../../data/export.csv');
    }

    /**
     * @test
     */
    public function shouldSkipFirstLine() : void
    {
        $parsed = $this->parser->parse();
        self::assertNotEquals('created_at', $parsed[0]['createdAt']);
        self::assertNotEquals('onboarding_perentage', $parsed[0]['onboardingPercentage']);
    }
}
