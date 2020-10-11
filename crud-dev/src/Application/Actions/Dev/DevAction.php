<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use App\Application\Actions\Action;
use App\Domain\Dev\DevRepository;
use Psr\Log\LoggerInterface;

abstract class DevAction extends Action
{
    /**
     * @var DevRepository
     */
    protected $devRepository;

    /**
     * @param LoggerInterface $logger
     * @param DevRepository  $devRepository
     */
    public function __construct(LoggerInterface $logger, DevRepository $devRepository)
    {
        parent::__construct($logger);
        $this->devRepository = $devRepository;
    }
}
