<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$tahun=$_POST['tahun'];
	require_once('config.php');
	//Cek email uniq
	$sql="SELECT r.id_reservasi_tipe,DATE_FORMAT(tgl_check_in,'%Y') as year,DATE_FORMAT(tgl_check_in,'%M') as month, tk.tipe_kamar,count(rr.id_ruangan_reservasi) as Total from reservasiruangan rr join kamar k on rr.id_kamar=k.id_kamar join tipekamar tk on k.id_tipe_kamar=tk.id_tipe_kamar join reservasi r on r.id_reservasi=rr.id_reservasi where DATE_FORMAT(tgl_check_in,'%Y')='$tahun' group by r.id_reservasi_tipe,tk.tipe_kamar";
	$res=mysqli_query($con,$sql);
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('Reservationtype'=>$row[0],'Year'=>$row[1],'Month'=>$row[2],'RoomType'=>$row[3],'Total'=>$row[4]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>