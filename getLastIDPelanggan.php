<?php  
require_once('config.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
	$sql="SELECT *from  pelanggan order by id_pel DESC limit 1";
	$res=mysqli_query($con,$sql);
	$result=array();
	while($row=mysqli_fetch_array($res)){
		array_push($result,array('id_pel'=>$row[0],'id_role'=>$row[1],'email'=>$row[2],'nama'=>$row[3],'no_identitas'=>$row[4],'telp'=>$row[5],'alamat'=>$row[6]));
	}
	echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}
?>