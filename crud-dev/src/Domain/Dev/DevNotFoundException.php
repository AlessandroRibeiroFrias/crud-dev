<?php
declare(strict_types=1);

namespace App\Domain\Dev;

use App\Domain\DomainException\DomainRecordNotFoundException;

class DevNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'Nao existe esse developer.';
}
