<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$username=$_POST['username'];
	$password=$_POST['password'];

	require_once('config.php');
	
	$sql_getpass="SELECT password from users where username='$username'";
	$my_res=mysqli_query($con,$sql_getpass);
	$my_row=mysqli_fetch_row($my_res);

	if(password_verify($password,$my_row[0])){
		$sql="SELECT *from users where username='$username'";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_row($res);

		$response["value"]=1;
		$response["message"]='Login Successfully';
		$result=array();

		server kampus
		array_push($result,array('id_user'=>$row[0],'id_role'=>$row[7],'username'=>$row[1],'password'=>$row[3],'email'=>$row[2],'id_peg'=>$row[8],'id_pel'=>$row[9]));

		//server lokal
		/*array_push($result,array('id_user'=>$row[0],'id_role'=>$row[1],'username'=>$row[2],'password'=>$row[4],'email'=>$row[3],'id_peg'=>$row[8],'id_pel'=>$row[9]));
*/

		echo json_encode(array("value"=>1,"result"=>$result));
	}else{
		$response["value"]=0;
		$response["message"]='Login Failed Username or Password is not correct';
		echo json_encode($response);
	}

	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>