<?php  
require_once('config.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
	$sql="SELECT s.id_season,s.tanggal_mulai,s.tanggal_selesai,s.nama_season,s.harga,t.tipe_kamar FROM season s join tipeKamar t on s.id_tipe_kamar=t.id_tipe_kamar 
	where s.tanggal_mulai>=sysdate() or sysdate()<=s.tanggal_selesai order by s.id_season asc ";
	$res=mysqli_query($con,$sql);
	$result=array();
	while($row=mysqli_fetch_array($res)){
		array_push($result,array('id_season'=>$row[0],'tanggal_mulai'=>$row[1],'tanggal_selesai'=>$row[2],'nama_season'=>$row[3],'harga'=>$row[4],'tipe_kamar'=>$row[5]));
	}
	echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}
?>