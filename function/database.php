<?php  
class database{ 
  
	public $host = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "db_jual";
	public $koneksi = "";

function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error(); 
		}
	}  
}


?>