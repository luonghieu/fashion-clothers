<?php 
namespace app\models;
use core\App;
use \PDO;
use app\models\Model;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;

class Products_info extends Model
{
	public static $table="products_info";

	public static function getAllPagination($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select * from products_info limit ?, ?';
		return App::get('database')->query_fetch_params($query,array('start'=>$start,'limit'=>$limit));
	}

	public static function updateActive($id,$active)
	{
		$parameters['active']=$active;
		$parameters['id']=$id;
		$query='UPDATE products_info SET active=? WHERE id=?';
		return App::get('database')->query_excute_params($query,$parameters);
	}

}


?>