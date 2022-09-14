<?php

declare(strict_types=1);

namespace App\Tests\Subscription\Acceptance;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

final class SubscriptionCrudTest extends ApiTestCase
{
    private static Connection $connection;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::bootKernel();

        static::$connection = static::getContainer()->get(Connection::class);

        (new Application(static::$kernel))
            ->find('doctrine:database:create')
            ->run(new ArrayInput(['--if-not-exists' => true]), new NullOutput());

        (new Application(static::$kernel))
            ->find('doctrine:schema:update')
            ->run(new ArrayInput(['--force' => true]), new NullOutput());
    }

    protected function setUp(): void
    {
        static::bootKernel();
        static::$connection->executeStatement('TRUNCATE subscription');
    }

    public function testCreateSubscription(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }

    public function testDeleteSubscription(): void
    {
        $this->markTestSkipped('It\'s your turn now!');
    }
}
