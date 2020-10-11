<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\Dev;

use App\Domain\Dev\Dev;
use App\Domain\Dev\DevNotFoundException;
use App\Infrastructure\Persistence\Dev\InMemoryDevRepositoryDuble;
use Tests\TestCase;

class InMemoryDevRepositoryTest extends TestCase
{
    public function testFindAll()
    {

        $devRepository = new InMemoryDevRepositoryDuble();

        $devs = $devRepository->findAll();

        $this->assertContains('Developer 2', $devs[1]);
    }

    public function testFindDevOfId()
    {

        $devRepository = new InMemoryDevRepositoryDuble();

        $devs = $devRepository->findDevOfId(1);


        $this->assertContains('Developer 1', $devs);

    }
}
