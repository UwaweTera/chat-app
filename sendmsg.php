<?php
	include 'conn.php';

	if (isset($_POST['send'])) {
			$sender_id = $_POST['sender'];
			$recv_id = $_POST['recv'];
			$msg = $_POST['send'];
			$receiver_id = $recv_id;
			$ins = mysqli_query($conn,"INSERT INTO messages(FromUser,message,ToUser) VALUES('$sender_id','$msg','$receiver_id')");

			if (!$ins) {
				echo mysqli_error($conn);
			}else{
				echo "sended";
			}
		}

 ?>
