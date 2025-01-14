<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Command;

use Stringkey\MapperBundle\Services\MapperService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mapper:mapped-entities:update',
    description: 'Reloads the list of mappable entities',
)]
class UpdateMappableEntitiesCommand extends Command
{
    public function __construct(private readonly MapperService $mapperService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->mapperService->updateEntityMapping();

        return Command::SUCCESS;
    }
}
