<?

$hostname = "localhost:3306";
$username = "akiselev";
$password = "ktototam4";
$dbName = "akiselev";


$conn=mysql_connect($hostname,$username,$password) OR DIE("�� ���� ������� ���������� ");

mysql_select_db($dbName) or die(mysql_error());  


?>