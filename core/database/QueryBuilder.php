<?php
namespace core\database; 
use \PDO;
class QueryBuilder
{	
	protected $pdo;

	public function __construct($pdo) 
	{
		$this->pdo=$pdo;
	}
	public function query_excute($query)
	{
		$statement=$this->pdo->prepare($query);
		return $statement->execute();	
	}

	public function query_excute_params($query,$params)
	{
		$statement=$this->pdo->prepare($query);
		$i=0;
		foreach ($params as $key => $value) {
			$i++;
			if(is_int($value))
			{
				$statement->bindValue($i,$value,PDO::PARAM_INT);
			}else{
				$statement->bindValue($i,$value,PDO::PARAM_STR);
			}
		}

		return $statement->execute();	
	}

	public function query_fetch_params($query,$params)
	{
		$statement=$this->pdo->prepare($query);
		$i=0;
		foreach ($params as $key => $value) {
			$i++;
			if(is_int($value))
			{
				
				$statement->bindValue($i,$value,PDO::PARAM_INT);
			} else {
				$statement->bindValue($i,$value,PDO::PARAM_STR);
			}

		}
		$statement->execute();		
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}


	public function query_fetch($query)
	{
		$statement=$this->pdo->prepare($query);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}
}
?>