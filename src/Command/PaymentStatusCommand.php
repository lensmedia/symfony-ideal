<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Command;

use Lens\Bundle\IdealBundle\Ideal\Exception\ErrorResponse;
use Lens\Bundle\IdealBundle\Ideal\Ideal;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(name: self::NAME)]
class PaymentStatusCommand extends Command
{
    public const NAME = 'lens:ideal:payment:status';

    public function __construct(
        private readonly Ideal $ideal,
    ) {
        parent::__construct(self::NAME);
    }

    protected function configure(): void
    {
        $this->setHelp('Check the status of an iDEAL payment.');
        $this->addArgument('id', InputArgument::REQUIRED, 'The iDEAL payment ID (numeric).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $payment = $input->getArgument('id');
        if (!$payment) {
            $io->error('Payment ID is required.');

            return Command::INVALID;
        }

        if (!ctype_digit($payment)) {
            $io->error('Payment ID should be a number.');

            return Command::INVALID;
        }

        try {
            $status = $this->ideal->payments->status($payment);

            $io->section('Response');
            $io->text(json_encode(
                $status->response->toArray(),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
            ));

            return Command::SUCCESS;
        } catch (ErrorResponse $error) {
            $io->error(sprintf(
                '[%d] Error %d: %s',
                $error->getCode(),
                $error->statusCode,
                $error->getMessage(),
            ));

        } catch (Throwable $throwable) {
            $io->error(sprintf(
                'Error %d: %s',
                $throwable->getCode(),
                $throwable->getMessage(),
            ));
        }

        return Command::FAILURE;
    }
}
