<?php

$servername="HOP";
$username="root";
$password="root";
$hostname="myswl:host=192.168.1.2";

$con = new mysqli($servername, $username, $password);


/*

#Fill our vars and run on cli
#$ php -f db-connect-test.php

$dbname = 'HOP';
$dbuser = 'root';
$dbpass = 'root';
$dbhost = 'mysql:host=192.168.1.2';

$connect = new mysqli($dbhost, $dbuser, $dbpass) or die("Can't connect to'$dbhost'");
mysql_select_db($dbname) or die("couldn't open the db '$dbname'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($test_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)){
	$tblCnt++;
	#echo $tbl[0]."<br />\n";
	}

if (!$tblCnt){
	echo "There are no tables<br />\n";
	}else{
	echo "There are $tblCnt tables<br />\n";
	}
*/
?>
