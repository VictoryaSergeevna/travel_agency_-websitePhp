<?php
class Tour
{
	public $country;
   public $city;
    public $hotel;
    public $stars;
    public $cost;
    function __construct(){}
   
public function __get($property)
	{
		if (property_exists($this, $property))
		{
			return $this->$property;
		}
	}
	public function __set($property, $value)
	{
		if (property_exists($this, $property))
		{
			$this->$property = $value;
		}
	}
}

class Database
{
	private $host='localhost';
	private $user='root';
	private $pass='';
	private $dbname='travels';
	private $link;

	function __construct(){}

	public static function createDatabase($dbname)
	{
		$database = new self();
		$database->dbname=$dbname;
		return $database;
	}

	function connect(){
		$this->link=mysqli_connect($this->host,$this->user,$this->pass) or die('Connection error');
		mysqli_select_db($this->link,$this->dbname) or die("Open error ".$this->dbname);
		mysqli_query($this->link,"set names 'utf8'");	
	}

	function query($queryString){
		$this->connect();
		
		$result = mysqli_query($this->link, $queryString) or die("Error " . mysqli_error($this->link));
		mysqli_close($this->link);
		return $result;
	}

	
}
   

?>
 

