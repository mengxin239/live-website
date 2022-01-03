<?php
include "config.php";
if($_GET["request"]=="getupdate"){
$con=mysqli_connect($hostname,$username,$password,$database);
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}
$result = mysqli_query($con,"select * from datas order by id DESC");
for($i=1;$i<11;$i++){
	$data[$i]["name"]="";
	$data[$i]["text"]="";
}
$i=1;
while($row = mysqli_fetch_array($result))
{
	$data[$i]["name"]=$row["name"];
	$data[$i]["text"]=$row["text"];
	$i++;
	if($i>11){
		break;
	}
}
mysqli_close($con);
echo $data[10]["name"].":".$data[10]["text"]."<br>";
echo $data[9]["name"].":".$data[9]["text"]."<br>";
echo $data[8]["name"].":".$data[8]["text"]."<br>";
echo $data[7]["name"].":".$data[7]["text"]."<br>";
echo $data[6]["name"].":".$data[6]["text"]."<br>";
echo $data[5]["name"].":".$data[5]["text"]."<br>";
echo $data[4]["name"].":".$data[4]["text"]."<br>";
echo $data[3]["name"].":".$data[3]["text"]."<br>";
echo $data[2]["name"].":".$data[2]["text"]."<br>";
echo $data[1]["name"].":".$data[1]["text"]."<br>";
}
if($_GET["request"]=="send"){
	if($_GET["sure"]=="false"){
		exit();
	}
	// 创建连接
	$conn = new mysqli($hostname, $username, $password, $database);
	// 检测连接
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	} 
	 
	$sql = "INSERT INTO datas (name, text)
	VALUES ('".$_GET['user']."', '".$_GET['data']."')";
	 
	if ($conn->query($sql) === TRUE) {
	    echo "评论发送成功";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
if($_GET["request"]=="islive"){
	exec("curl -Ls http://".$srsip.":".$srsport."/api/v1/streams",$return);
	$decode=json_decode($return[0],true);
	if($decode['streams'][0]['publish']['active']){
		echo "True";
	} else {
		echo "False";
	}
}
?>
