<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use Psr\Http\Message\ResponseInterface as Response;

class NewDevAction extends DevAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $dev = $this->getFormData();

        $result = $this->devRepository->newDeveloper($dev) ? 'Developer Cadastro com Sucesso' : 'Erro ao cadastrar Developer';

        $this->logger->info("Cadastro de novo Developer");
        return $this->respondWithData($result);
    }
}