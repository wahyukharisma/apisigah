<?php
	require_once('config.php');
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$id_pel=$_POST['id_pel'];
		$sql=" SELECT r.kode_reservasi,r.tgl_reservasi,p.nama,p.alamat,rr.tgl_check_in,rr.tgl_check_out,r.dewasa,r.anak,tr.reservasi_tipe,sr.reservasi_status,h.alamat from reservasi r join pelanggan p on r.id_pel=p.id_pel join reservasiruangan rr on rr.id_reservasi=r.id_reservasi join hotel h on r.id_hotel=h.id_hotel join reservasistatus sr on r.id_reservasi_status=sr.id_reservasi_status join tipereservasi tr on r.id_reservasi_tipe=tr.id_reservasi_tipe where r.id_pel='$id_pel' and sr.id_reservasi_status='4'";
		$res=mysqli_query($con,$sql);
		$result=array();

		while($row=mysqli_fetch_array($res)){
			array_push($result,array('kodeReservasi'=>$row[0],'tgl_reservasi'=>$row[1],'nama'=>$row[2],'alamatPel'=>$row[3],'tgl_check_in'=>$row[4],'tgl_check_out'=>$row[5],
				'dewasa'=>$row[6],'anak'=>$row[7],'reservasiTipe'=>$row[8],'reservasiStatus'=>$row[9],'alamat'=>$row[10]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	}else{
		$response["value"]=0;
		$response["message"]='Network Connection Failed';
		echo json_encode($response);
	}
	mysqli_close($con);
?>