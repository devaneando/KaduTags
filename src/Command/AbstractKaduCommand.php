<?php

namespace App\Command;

use App\Manager\TagManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class AbstractKaduCommand extends Command
{
    protected TagManager $tagManager;
    protected InputInterface $input;
    protected OutputInterface $output;
    protected SymfonyStyle $io;

    public function __construct(TagManager $tagManager)
    {
        parent::__construct();
        $this->tagManager = $tagManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        $outputStyle = new OutputFormatterStyle('black', null);
        $output->getFormatter()->setStyle('black', $outputStyle);

        $outputStyle = new OutputFormatterStyle('blue', null);
        $output->getFormatter()->setStyle('blue', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-blue', null);
        $output->getFormatter()->setStyle('bright-blue', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-cyan', null);
        $output->getFormatter()->setStyle('bright-cyan', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-green', null);
        $output->getFormatter()->setStyle('bright-green', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-magenta', null);
        $output->getFormatter()->setStyle('bright-magenta', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-red', null);
        $output->getFormatter()->setStyle('bright-red', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-white', null);
        $output->getFormatter()->setStyle('bright-white', $outputStyle);

        $outputStyle = new OutputFormatterStyle('bright-yellow', null);
        $output->getFormatter()->setStyle('bright-yellow', $outputStyle);

        $outputStyle = new OutputFormatterStyle('cyan', null);
        $output->getFormatter()->setStyle('cyan', $outputStyle);

        $outputStyle = new OutputFormatterStyle('gray', null);
        $output->getFormatter()->setStyle('gray', $outputStyle);

        $outputStyle = new OutputFormatterStyle('green', null);
        $output->getFormatter()->setStyle('green', $outputStyle);

        $outputStyle = new OutputFormatterStyle('magenta', null);
        $output->getFormatter()->setStyle('magenta', $outputStyle);

        $outputStyle = new OutputFormatterStyle('red', null);
        $output->getFormatter()->setStyle('red', $outputStyle);

        $outputStyle = new OutputFormatterStyle('white', null);
        $output->getFormatter()->setStyle('white', $outputStyle);

        $outputStyle = new OutputFormatterStyle('yellow', null);
        $output->getFormatter()->setStyle('yellow', $outputStyle);

        $this->io = new SymfonyStyle($input, $output);

        return Command::SUCCESS;
    }
}
