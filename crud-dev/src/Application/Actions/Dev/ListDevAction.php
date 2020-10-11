<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use Psr\Http\Message\ResponseInterface as Response;

class ListDevAction extends DevAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $devs = $this->devRepository->findAll();

        $this->logger->info("Todos os Developers Visualizados");

        return $this->respondWithData($devs);
    }
}
