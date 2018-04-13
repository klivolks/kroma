<?php
	class input{
		function post($field){
			$db = new db;
			$con = $db->connect();
			if(isset($_POST[$field])){
				$data=mysqli_real_escape_string($con,$_POST[$field]);
			}
			else{
				$data='';
			}
			return $data;
		}
		function get($field){
			$db = new db;
			$con = $db->connect();
			if(isset($_GET[$field])){
				$data=mysqli_real_escape_string($con,$_GET[$field]);
			}
			else{
				$data='';
			}
			return $data;
		}
		function ip(){
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
		function device(){
			$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
			$os_platform    =   "Unknown OS Platform";
			$os_array       =   array(
									'/windows nt 6.3/i'     =>  'Windows 8.1',
									'/windows nt 6.2/i'     =>  'Windows 8',
									'/windows nt 6.1/i'     =>  'Windows 7',
									'/windows nt 6.0/i'     =>  'Windows Vista',
									'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
									'/windows nt 5.1/i'     =>  'Windows XP',
									'/windows xp/i'         =>  'Windows XP',
									'/windows nt 5.0/i'     =>  'Windows 2000',
									'/windows me/i'         =>  'Windows ME',
									'/win98/i'              =>  'Windows 98',
									'/win95/i'              =>  'Windows 95',
									'/win16/i'              =>  'Windows 3.11',
									'/macintosh|mac os x/i' =>  'Mac OS X',
									'/mac_powerpc/i'        =>  'Mac OS 9',
									'/linux/i'              =>  'Linux',
									'/ubuntu/i'             =>  'Ubuntu',
									'/iphone/i'             =>  'iPhone',
									'/ipod/i'               =>  'iPod',
									'/ipad/i'               =>  'iPad',
									'/android/i'            =>  'Android',
									'/blackberry/i'         =>  'BlackBerry',
									'/webos/i'              =>  'Mobile'
								);
			foreach ($os_array as $regex => $value) { 
				if (preg_match($regex, $user_agent)) {
					$os_platform    =   $value;
				}
			}   
			return $os_platform;
		}
		function browser(){
			$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
			$browser        =   "Unknown Browser";
			$browser_array  =   array(
									'/msie/i'       =>  'Internet Explorer',
									'/firefox/i'    =>  'Firefox',
									'/safari/i'     =>  'Safari',
									'/chrome/i'     =>  'Chrome',
									'/opera/i'      =>  'Opera',
									'/netscape/i'   =>  'Netscape',
									'/maxthon/i'    =>  'Maxthon',
									'/konqueror/i'  =>  'Konqueror',
									'/mobile/i'     =>  'Handheld Browser'
								);
			foreach ($browser_array as $regex => $value) { 
				if (preg_match($regex, $user_agent)) {
					$browser    =   $value;
				}
			}
			return $browser;
		}
		function image($folder,$file_name){
			$target_dir = "img/".$folder."/";
			$file=sha1(basename($_FILES[$file_name]["name"]))."_".time().".".strtolower(pathinfo(basename($_FILES[$file_name]["name"]),PATHINFO_EXTENSION));
			$target_file = $target_dir . $file;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES[$file_name]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if ($_FILES[$file_name]["size"] > 500000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			} else {
				if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
					return $file;
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		}
		function url(){
			return $_SERVER['REQUEST_URI'];
		}
	}
?>