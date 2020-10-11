<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteDevAction extends DevAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $devId = (int) $this->resolveArg('id');

         $result = $this->devRepository->deleteDeveloper($devId) ? 'Developer deletado com sucesso' : 'Erro ao deletar Developer';

        $this->logger->info("Developer deletado.");
        return $this->respondWithData($result);
    }
}
