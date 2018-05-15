<?php  
require_once('config.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
	$sql="SELECT * FROM users order by id_role ASC";
	$res=mysqli_query($con,$sql);
	$result=array();
	while($row=mysqli_fetch_array($res)){
		array_push($result,array('id_user'=>$row[0],'id_role'=>$row[1],'username'=>$row[2],'password'=>$row[3],'email'=>$row[4],'id_peg'=>$row[5],'id_pel'=>$row[6]));
	}
	echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}
?>