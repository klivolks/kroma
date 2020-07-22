<?php
class db{
	function connect(){
		date_default_timezone_set('Asia/Kolkata');
		include($_SERVER["DOCUMENT_ROOT"].'/database.php');
		$con=mysqli_connect($host,$user,$password,$database);
		return $con;
	}
	function get($table,$columns,$condition){
		$con = $this->connect();
		$query="SELECT $columns FROM $table $condition";
		$sql = mysqli_query($con,$query);
		$data=array();
		while($rw=mysqli_fetch_array($sql)){
			$data['result'][] = $rw;
		}
		$data['query']=$query;
		$data['error'] = mysqli_error($con);
		return $data;
	}
	function insert($table,$data){
		$columns = '';
		$value = '';
		$i=0;
		foreach($data as $key=>$val){
			if($i>0){
				$columns.=',';
				$value.=',';
			}
			$columns.="`$key`";
			$value.="'$val'";
			$i++;
		}
		$con=$this->connect();
		$now=date('Y-m-d H:i:s');
		$sql="INSERT INTO $table($columns,`created_at`,`updated_at`) VALUES($value,'$now','$now')";
		mysqli_query($con,$sql);
		$id=mysqli_insert_id($con);
		return $id;
	}
	function update($table,$data,$id){
		$string='';
		$i=0;
		foreach($data as $key=>$val){
			if($i>0){
				$string.=',';
			}
			if(is_float($val)){
				$string.="`$key`=$val";
			}
			else{
				$string.="`$key`='$val'";
			}
			$i++;
		}
		$con=$this->connect();
		$now=date("Y-m-d H:i:s");
		$sql="UPDATE $table SET $string,`updated_at`='$now' WHERE `id`=$id";
		$result=mysqli_query($con,$sql);
		$e['error'] = mysqli_error($con);
		$e['query'] = $sql;
		return $e;
	}
	function delete($table,$id){
		$con=$this->connect();
		$sql="DELETE FROM $table WHERE `id`=$id";
		$sql=mysqli_query($con,$sql);
	}
	function escape($string){
		$string = mysqli_real_escape_string($this->connect(),$string);
		return $string;
	}
	function query($query){
		$con=$this->connect();
		$sql=mysqli_query($con,$query);
		return $sql;
	}
	function version(){
		$con=$this->connect();
		$v = mysqli_get_server_info($con);
		return $v;
	}
}
?>