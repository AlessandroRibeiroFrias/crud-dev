<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use Psr\Http\Message\ResponseInterface as Response;

class EditDevAction extends DevAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $devId = (int) $this->resolveArg('id');
        $dev = $this->getFormData();

        $result = $this->devRepository->editDeveloper($devId, $dev) ? 'Developer Alterado com Sucesso' : 'Erro ao cadastrar Developer';

        $this->logger->info("Alteração de Developer");
        return $this->respondWithData($result);
    }
}