<?php
declare(strict_types=1);

namespace App\Domain\Dev;

use JsonSerializable;

class Dev implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $sexo;

    /**
     * @var int
     */
    private $idade;

     /**
     * @var string
     */
    private $hobby;

     /**
     * @var string
     */
    private $datanascimento;

    /**
     * @param int|null  $id
     * @param string    $nome
     * @param string      $sexo
     * @param int       $idade
     * @param string    $hobby
     * @param string      $datanascimento
     */
    public function __construct(?int $id, string $nome, string $sexo, int $idade, string $hobby, string $datanascimento)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->sexo = strtoupper($sexo);
        $this->idade = $idade;
        $this->hobby = $hobby;
        $this->datanascimento = $datanascimento;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getSexo(): string
    {
        return $this->sexo;
    }

    /**
     * @return int
     */
    public function getIdade(): int
    {
        return $this->int;
    }

    /**
     * @return string
     */
    public function getHobby(): string
    {
        return $this->hobby;
    }

    /**
     * @return string
     */
    public function getDataNascimento(): string
    {
        return $this->hobby;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'sexo' => $this->sexo,
            'idade' => $this->idade,
            'hobby' => $this->hobby,
            'datanascimento' => $this->datanascimento,
        ];
    }
}
