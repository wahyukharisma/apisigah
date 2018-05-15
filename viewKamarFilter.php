<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$alamat=$_POST['alamat'];
	$tgl_check_in=$_POST['tgl_check_in'];
	$tgl_check_out=$_POST['tgl_check_out'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT * from kamar k join hotel h on k.id_hotel=h.id_hotel join reservasiruangan r on k.id_kamar=r.id_kamar join tipekamar t on k.id_tipe_kamar=t.id_tipe_kamar join jeniskasur j on k.id_kasur=j.id_kasur where h.alamat='$alamat' and '$tgl_check_in' NOT between r.tgl_check_in AND r.tgl_check_out and '$tgl_check_out' not between r.tgl_check_in AND r.tgl_check_out order by k.nomor_ruangan asc";
	$res=mysqli_query($con,$sql);
	$result=array();
	while($get=mysqli_fetch_array($res)){
		array_push($result,array('nomor_ruangan'=>$get[3],'lantai'=>$get[4],'kapasitas'=>$get[6],'harga'=>$get[7],'deskripsi'=>$get[8],'status_merokok'=>$get[9],'alamat'=>$get[13],'tipe_kamar'=>$get[24],'jenis_kasur'=>$get[26]));
	}
	echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>