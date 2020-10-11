<?php 
namespace App\Infrastructure\Persistence\Dev;

use App\Infrastructure\Persistence\Dev\InMemoryDevRepository;

class InMemoryDevRepositoryDuble extends InMemoryDevRepository{

	public function findAll():array{
		return array(
			array(
				'id_developers' => 1,
				'nome' => 'Developer 1',
				'sexo' => 'M',
				'idade' => 23,
				'hobby' => 'Gamer',
				'datanascimento' => '1996-12-17',
			),
			array(
				'id_developers' => 2,
				'nome' => 'Developer 2',
				'sexo' => 'M',
				'idade' => 25,
				'hobby' => 'Gamer',
				'datanascimento' => '1990-12-17',
			)
		);
	}

	public function findDevOfId($id){
		return array(
			'id_developers' => 1,
			'nome' => 'Developer 1',
			'sexo' => 'M',
			'idade' => 23,
			'hobby' => 'Gamer',
			'datanascimento' => '1996-12-17'
		);
	}

}
?>