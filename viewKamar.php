<?php  
require_once('config.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
	$sqlRoom="SELECT k.id_kamar,k.id_kasur,h.alamat,k.nomor_ruangan,k.lantai,t.tipe_kamar,k.kapasitas,k.harga,k.deskripsi,k.status_merokok,k.status_tersedia from kamar k join hotel h on k.id_hotel=h.id_hotel join tipekamar t on k.id_tipe_kamar=t.id_tipe_kamar order by k.id_kamar asc";
	$sqlFasilitas="SELECT f.id_fasilitas,h.alamat,f.nama_fasilitas,f.harga,f.deskripsi,f.status_tersedia from fasilitas f join hotel h on f.id_hotel=h.id_hotel order by f.id_fasilitas asc";
	$resRoom=mysqli_query($con,$sqlRoom);
	$resFasilitas=mysqli_query($con,$sqlFasilitas);
	$resultRoom=array();
	$resultFasilitas=array();

	while($row=mysqli_fetch_array($resRoom)){
		array_push($resultRoom,array('id_kamar'=>$row[0],'id_kasur'=>$row[1],'alamat'=>$row[2],'nomor_ruangan'=>$row[3],'lantai'=>$row[4],'tipe_kamar'=>$row[5],'kapasitas'=>$row[6],'harga'=>$row[7],'deskripsi'=>$row[8],'status_merokok'=>$row[9],'status_tersedia'=>$row[10]));
	}
	while($row=mysqli_fetch_array($resFasilitas)){
		array_push($resultFasilitas,array('id_fasilitas'=>$row[0],'alamat'=>$row[1],'nama_fasilitas'=>$row[2],'harga'=>$row[3],'deskripsi'=>$row[4],'status_tersedia'=>$row[5]));
	}
	echo json_encode(array("value"=>1,"result"=>$resultRoom,"values"=>2,"results"=>$resultFasilitas));
	mysqli_close($con);
}
?>