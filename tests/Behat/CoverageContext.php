<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\PHP;

/**
 * Behat coverage.
 *
 * @author eliecharra
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @copyright Adapted from https://gist.github.com/eliecharra/9c8b3ba57998b50e14a6
 */
final class CoverageContext implements Context
{
    /**
     * @var CodeCoverage
     */
    private static $coverage;

    /**
     * @BeforeSuite
     */
    public static function setup(): void
    {
        $filter = new Filter();
        if (method_exists($filter, 'includeDirectory')) {
            $filter->includeDirectory(__DIR__.'/../../src');
            self::$coverage = new CodeCoverage((new Selector())->forLineCoverage($filter), $filter);

            return;
        }

        $filter->addDirectoryToWhitelist(__DIR__.'/../../src'); // @phpstan-ignore-line
        self::$coverage = new CodeCoverage(null, $filter); // @phpstan-ignore-line
    }

    /**
     * @AfterSuite
     */
    public static function teardown(): void
    {
        $feature = getenv('FEATURE') ?: 'behat';
        (new PHP())->process(self::$coverage, __DIR__."/../../build/coverage/coverage-{$feature}.cov");
    }

    /**
     * @BeforeScenario
     */
    public function before(BeforeScenarioScope $scope): void
    {
        self::$coverage->start("{$scope->getFeature()->getTitle()}::{$scope->getScenario()->getTitle()}");
    }

    /**
     * @AfterScenario
     */
    public function after(): void
    {
        self::$coverage->stop();
    }
}
