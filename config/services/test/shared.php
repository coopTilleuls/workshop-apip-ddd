<?php

declare(strict_types=1);

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Symfony\Messenger\MessengerCommandBus;
use App\Shared\Infrastructure\Symfony\Messenger\MessengerQueryBus;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(QueryBusInterface::class)
        ->class(MessengerQueryBus::class)
        ->public();

    $services->set(CommandBusInterface::class)
        ->class(MessengerCommandBus::class)
        ->public();
};
