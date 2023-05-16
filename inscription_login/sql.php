<?php
function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

if(isLocalhost()){
	$servername = "localhost:3306";
	$username = "root";
	$password = "";
}
else{
	$servername = "zikosfnprojetweb.mysql.db";
	$username = "zikosfnprojetweb";
	$password = "bJZGZgrQz2h5";
}

try {
  $conn = new PDO("mysql:host=$servername;dbname=zikosfnprojetweb", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>