<?php
declare(strict_types=1);

namespace App\Application\Actions\Dev;

use Psr\Http\Message\ResponseInterface as Response;

class ViewDevAction extends DevAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $devId = (int) $this->resolveArg('id');
        $dev = $this->devRepository->findDevOfId($devId);
        $this->logger->info("Developer `${devId}` was viewed.");

        return $this->respondWithData($dev);
    }
}
