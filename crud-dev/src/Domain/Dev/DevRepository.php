<?php
declare(strict_types=1);

namespace App\Domain\Dev;

interface DevRepository
{
    /**
     * @return Dev[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Dev
     * @throws DevNotFoundException
     */
    public function findDevOfId(int $id);

    /**
     * @param Object $dev
     * @return Message
     * @throws DevNotFoundException
     */
    public function newDeveloper($dev);

    /**
     * @param int $id, Object $dev
     * @return Message
     * @throws DevNotFoundException
     */
    public function editDeveloper(int $id, $dev);

    /**
     * @param int $id
     * @return Message
     * @throws DevNotFoundException
     */
    public function deleteDeveloper(int $id);
}
