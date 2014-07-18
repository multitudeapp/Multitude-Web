<?php
	//phpinfo();
	// Start of stupid code
	$rand = rand(0,100);
	if ($rand == 0) {
		echo '<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" />';
	}
	// End
	require("station.php");
	require("db.php");
	if (!isset($_GET['action'])) {
		$_GET['action'] = "";
	}
	
	if ($_GET['action'] == "list") {
		echo date('Y-m-d H:i:s');
		$sql = "SELECT `station`, COUNT(*) as freq FROM `responses` GROUP BY `station`";
		$result = mysqli_query($con, $sql);
		$rows = mysqli_num_rows($result);
		$stations = array();
		while ($array = mysqli_fetch_array($result)) {
			$station = new Station($array[0]);
			array_push($stations, $station);
		}
		
		foreach ($stations as &$station) {
			$sql = "SELECT COUNT(*) as freq FROM `responses` WHERE feedback = 1 AND station = '".$station->name."'";
			$result = mysqli_query($con, $sql);
			$value = mysqli_fetch_object($result);
			$station->positive = $value->freq;;
		}
		
		foreach ($stations as &$station) {
			$sql = "SELECT COUNT(*) as freq FROM `responses` WHERE feedback = 0 AND station = '".$station->name."'";
			$result = mysqli_query($con, $sql);
			$value = mysqli_fetch_object($result);
			$station->negative = $value->freq;;
		}
		
		//print_r($stations);
		
		echo "<table><tr>";
		for ($i = 0; $i < count($stations); $i++)
		{
			if ($i % 4 == 0) {
				echo "</tr><tr>";
			}
			echo '<td><div id="'.$stations[$i]->name.'"><span class="name"><a href="details.php?station='.$stations[$i]->name.'">'.$stations[$i]->name.'</a></span> | <span class="rating">'.round($stations[$i]->getRating()*100,0).'</span></div></td>';
		}
		echo "</table>";
		?>
		
		<script>
			setTimeout('location.reload()',1000);
			var ele = document.getElementsByClassName('name');
			//for (var x in ele) {
			for (var i = 0; i < ele.length; i++) {
				var rating = ele[i].parentNode.childNodes[2].innerHTML;
				ele[i].parentNode.style.background = getColor(rating);
			}
			
			function getColor(percent) {
				var R = parseInt((100 - percent)/100 * 255);
				var G = parseInt((0 + percent)/100 * 255);
				var B = 0;
				return "rgb(" + R + "," + G + "," + B + ")";
			}
		</script>
		
		<?php
	} else if ($_POST["action"] == "add") {
		header('Content-Type: application/json');
		$feedback = htmlspecialchars($_POST['feedback']);
		$station = htmlspecialchars($_POST['station']);
		if (!isset($_POST['message'])) {
			$_POST['message'] = "";
		}
		$message = htmlspecialchars($_POST['message']);
		$sql = "INSERT INTO responses (`UID`, `timestamp`, `station`, `feedback`, `message`) VALUES (NULL,  NULL, '".$station."', ".$feedback.", '".$message."');";
		$result = mysqli_query($con, $sql);
		if ($result) {
			$array = array("status" => "success");
		} else {
			$array = array("status" => "failure");
		}
		echo json_encode($array);
		
		//$rows = mysqli_num_rows($result);
		//echo $result;
		
	} else if ($_POST['action'] == "add"){
	
	}
	
?>
	