<?php
	session_start();
	include("../con_db.php");
	$result = array();
	
	//check username duplicate
	$strSQLchk = "SELECT a.user_id, a.confirm, b.game_id
				FROM n_team_member
				WHERE user_id = '" . $_SESSION["mem_id"] . "'
					AND a.team_id = b.id
					AND ( confirm = '1' OR confirm = '2' )
					AND b.game_id = '". $_GET["g"] ."'";
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);
	
	if(empty($num)){
		$SQL = "UPDATE n_team_member
				SET confirm = '1' 
				WHERE id = '". $_GET["t"] ."'	";
					
		$objQuery = mysql_query($SQL);
		
		if($objQuery){
			echo "<script>alert ('คุณได้เข้าทีมเรียบร้อยแล้ว') </script>";
		echo "<script>window.location='../team.php'</script>";	
			
		}else{
			echo "<script>alert ('คุณไม่สามารถเข้าทีมได้') </script>";
		echo "<script>window.location='../team.php'</script>";	
		}
	}else{
		echo "<script>alert ('คุณได้สังกัดทีมใดทีมหนึ่งอยู่แล้ว') </script>";
		echo "<script>window.location='../team.php'</script>";	
	}
	
	
	
	mysql_close($link);
	
?>