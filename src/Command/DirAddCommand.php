<?php

namespace App\Command;

use App\Manager\TagManager;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'kadu:tags:dir:add',
    description: 'Add a short description for your command',
)]
class DirAddCommand extends AbstractKaduCommand
{
    public function __construct(TagManager $tagManager)
    {
        parent::__construct($tagManager);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('directory', InputArgument::REQUIRED, 'The directory path.')
            ->addOption(
                'include-files',
                'i',
                InputOption::VALUE_NONE,
                'If the files in that directory should be recursively included.'
            )
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'If the files in that directory should be recursively included.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);

        try {
            $wasOk = $this->tagManager->addDirectory(
                $input->getArgument('directory'),
                $input->getOption('include-files'),
                $input->getOption('force')
            );
        } catch (Exception $ex) {
            $this->io->error($ex->getMessage());

            return Command::FAILURE;
        }

        if (!$wasOk) {
            $this->io->warning('The given directory already exists in the file.');
            return Command::FAILURE;
        }
        $this->io->success('Directory added to the fie.');

        return Command::SUCCESS;
    }
}
