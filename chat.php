<?php include 'conn.php'?>

<div class="back">
	<a href="home.php">back</a>
</div>
<?php
	include 'nav.php';


	$recv_id = $_GET['rec_id'];
	$sender_id = $_SESSION['user_id'];
	$sel = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $recv_id");


	while($row = mysqli_fetch_array($sel)){


	?>

	<h2><?php echo $row['user_name'] ?></h2>


	<div class="all_msg">

		<div id="data">

		</div>
	</div>

	<form id="msgForm" method="POST">
		<textarea id="input"></textarea>
		<input type="submit" value="send">
	</form>
	<?php

	}

 ?>

 <script type="text/javascript" >


 	//ajax for sending msg
 	var form = document.getElementById("msgForm");
 	var field = document.getElementById("input");
 	form.addEventListener("submit",send);
 	function send(e){
 		e.preventDefault();
 		xhr = new XMLHttpRequest();

 		var input = document.getElementById("input").value;

 		var names = "send="+input+"&sender="+<?php echo $_SESSION['user_id']; ?>+"&recv="+<?php echo $_GET['rec_id']; ?>;



 		xhr.open("POST","sendmsg.php",true);
 		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


 		xhr.onload = function(){
 			if (this.status == 200) {

 				field.value = "";
 				//document.getElementById("demo").innerHTML = this.responseText
 			}
 		}

 		xhr.send(names);



 	}





 	setInterval(getchat,300);

 	function getchat(){
 		xhr = new XMLHttpRequest();

 		var names = "sender="+<?php echo $_SESSION['user_id']; ?>+"&recv="+<?php echo $_GET['rec_id']; ?>;

 		xhr.open("POST","get.php",true);
 		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

 		xhr.onload = function(){
 			if (this.status == 200) {
 				document.getElementById("data").innerHTML = this.responseText;
 			}
 		}


 		xhr.send(names);

 	}






  </script>
