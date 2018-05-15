<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
	
	require_once('config.php');
	
	$tahun=$_POST['tahun'];
	//Cek email uniq
	$sql="SELECT p.nama,sum(t.jumlah_uang) as totalPay,count(r.id_reservasi) as poin from reservasi r join pelanggan p on r.id_pel=p.id_pel join transaksi t on r.id_reservasi=t.id_reservasi where r.id_reservasi_status=2 and DATE_FORMAT(r.tgl_reservasi,'%Y')='2018' or r.id_reservasi_status=4 and DATE_FORMAT(r.tgl_reservasi,'%Y')='2018' group by p.nama order by 3 desc limit 5";
	$res=mysqli_query($con,$sql);
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('nama'=>$row[0],'totalPay'=>$row[1],'poin'=>$row[2]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>