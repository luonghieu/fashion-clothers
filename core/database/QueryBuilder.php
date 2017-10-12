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
	// public function commonSelectAll($tbl)
	// {
	// 	$statement=$this->pdo->prepare("select * from {$tbl}");
	// 	$statement->execute();
	// 	return $statement->fetchAll(PDO::FETCH_CLASS);

	// }
	// public function commonGetItemById($tbl,$id)
	// {
	// 	$statement=$this->pdo->prepare("select * from {$tbl} where id={$id}");
	// 	$statement->execute();
	// 	return $statement->fetchAll(PDO::FETCH_CLASS);
	// }

	// public function commonInsert($tbl,$parameters)
	// {
	// 	$sql=sprintf(
	// 		'insert into %s(%s) value(%s)',
	// 		$tbl,
	// 		implode(',',array_keys($parameters)),
	// 		':'.implode(', :',array_keys($parameters))
	// 		);

	// 	try{

	// 		$statement=$this->pdo->prepare($sql);
	// 		return $statement->execute($parameters);
	// 	}catch(Exception $e){
	// 		die('Something wrong !');
	// 	}

	// }
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
			} else {
				$statement->bindValue($i,$value,PDO::PARAM_STR);
			}
		}

		return $statement->execute();	
	}


	public function query_fetch($query)
	{
		$statement=$this->pdo->prepare($query);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
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

	// $stmt = $conn->prepare('INSERT INTO users (name, email, age) values (:name, :mail, :age)');`
// //Gán các biến (lúc này chưa mang giá trị) vào các placeholder theo tên của chúng
// $stmt->bindParam(':name', $name);
	// $stmt->execute();
}
?>