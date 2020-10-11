<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Dev;

use App\Domain\Dev\Dev;
use App\Domain\Dev\DevNotFoundException;
use App\Domain\Dev\DevRepository;
use App\Infrastructure\Connection\DBConnection;

class InMemoryDevRepository implements DevRepository
{
    /**
     * @var Dev[]
     */
    private $devs;
    protected $table;

    /**
     * InMemoryDevRepository constructor.
     *
     * @param array|null $devs
     */
    public function __construct(array $devs = null)
    {
        // $this->devs = $devs ?? [
        //     1 => new Dev(1, 'Alessandro Ribeiro Frias', 'M', 23, 'Gamer', '1996-12-17')
        // ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sql = "
            SELECT
                 id_developers 
                , nome 
                , sexo
                , idade
                , hobby
                , datanascimento
            FROM
                dev.developers
        ";

        $row = DBConnection::getInstance()
            ->prepare($sql)
            ->execute()
            ->fetchAll();

        if (!$row) {
            throw new DevNotFoundException();
        }

        return $row;
    }

    /**
     * {@inheritdoc}
     */
    public function findDevOfId(int $id)
    {
        $sql = "
            SELECT
                 id_developers 
                , nome 
                , sexo
                , idade
                , hobby
                , datanascimento
            FROM
                dev.developers
            WHERE
                id_developers = :ID
        ";

        $row = DBConnection::getInstance()
            ->prepare($sql)
            ->bindValues(
                [
                    'ID' => $id,
                ]
            )
            ->execute()
            ->fetch();



        if (!$row) {
            throw new DevNotFoundException();
        }

        return $row;
    }

    public function newDeveloper($dev)
    {
        $nome           = $dev->nome            ? $dev->nome            : false;
        $sexo           = $dev->sexo            ? $dev->sexo            : false;
        $idade          = $dev->idade           ? $dev->idade           : false;
        $hobby          = $dev->hobby           ? $dev->hobby           : false;
        $datanascimento = $dev->datanascimento ? $dev->datanascimento   : false;


        $sql = "
            INSERT INTO dev.developers
                (
                  nome
                  , sexo
                  , idade
                  , hobby
                  , datanascimento
                )
            VALUES 
                (
                    :NOME
                    , :SEXO
                    , :IDADE
                    , :HOBBY
                    , :DATANASCIMENTO
                )
        ";

        $rowsAffected = DBConnection::getInstance()
            ->prepare($sql)
            ->bindValues(
                [
                    'NOME' => $nome
                    , 'SEXO' => $sexo
                    , 'IDADE' => $idade
                    , 'HOBBY' => $hobby
                    , 'DATANASCIMENTO' => $datanascimento
                ]
            )
            ->execute()
            ->rowCount();

        if (!$rowsAffected) {
            throw new DevNotFoundException();
        }

        return $rowsAffected;
    }

    public function editDeveloper($id, $dev)
    {
        $id_developer   = $id ? $id : false;

        if(!$id_developer){
            throw new DevNotFoundException();
        }

        $nome           = $dev->nome            ? $dev->nome            : false;
        $sexo           = $dev->sexo            ? $dev->sexo            : false;
        $idade          = $dev->idade           ? $dev->idade           : false;
        $hobby          = $dev->hobby           ? $dev->hobby           : false;
        $datanascimento = $dev->datanascimento  ? $dev->datanascimento  : false;


        $sql = "
            UPDATE dev.developers
            SET
                nome = :NOME
                , sexo = :SEXO
                , idade = :IDADE
                , hobby = :HOBBY
                , datanascimento = :DATANASCIMENTO
                
            WHERE
                id_developerS = :IDDEVELOPER
        ";

        $rowsAffected = DBConnection::getInstance()
            ->prepare($sql)
            ->bindValues(
                [
                    'NOME' => $nome
                    , 'SEXO' => $sexo
                    , 'IDADE' => $idade
                    , 'HOBBY' => $hobby
                    , 'DATANASCIMENTO' => $datanascimento
                    , 'IDDEVELOPER' => $id_developer
                ]
            )
            ->execute()
            ->rowCount();

        if (!$rowsAffected) {
            throw new DevNotFoundException();
        }

        return $rowsAffected;
    }

    public function deleteDeveloper($id)
    {
        $id_developer   = $id ? $id : false;

        if(!$id_developer){
            throw new DevNotFoundException();
        }

        $sql = "
            DELETE 
                FROM dev.developers
            WHERE 
                id_developerS = :IDDEVELOPER
        ";

        $rowsAffected = DBConnection::getInstance()
            ->prepare($sql)
            ->bindValues(
                [
                    'IDDEVELOPER' => $id_developer
                ]
            )
            ->execute()
            ->rowCount();

        if (!$rowsAffected) {
            throw new DevNotFoundException();
        }

        return $rowsAffected;
    }
}
