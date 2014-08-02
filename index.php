<?php
	require("station.php");
	require("db.php");
	if (!isset($_GET['action'])) {
		$_GET['action'] = "";
	}
	if ($_GET['action'] == "list") {
		?>
		<html>
			<head>				
				<link rel="stylesheet" href="assets/css/foundation.css" type="text/css" />
				<link rel="stylesheet" href="assets/css/normalize.css" type="text/css" />
				<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
				<title>Multitude Control Panel</title>
			</head>
			<body>
				<div id="container">
					<header class="row"> 
						<img id="banner-logo" src="Multitude.png" height="100px"/>            
							<form method="get" id="search">
								<input name="filter" type="text" size="40" placeholder="Search" />
							</form>            
							<!-- DEPRECRATED: Testing new search bar
							<form method="GET">
								<input name="filter"></input>
								<input type="submit" value="Search"></input>
								<input type="hidden" name="action" value="list"></input>
							</form>
							-->
					</header>
					<table>
						<?php
							if(isset($_GET['filter'])) {
								$line = htmlspecialchars($_GET['filter']);
								$filter = "WHERE `station` LIKE '%".$line."%'";
								
							} else {
								$filter = "";
							}
							$sql = "SELECT `station`, COUNT(*) as freq FROM `responses` ".$filter." GROUP BY `station`";
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
							function displayLogo($name, $mainArray) {
								$result = "";
								foreach ($mainArray as $temp) {
									foreach ($temp as $key => $value) {
										if ($value == $name) {
											$result = $key;
											break;
										}
									}
									if ($result != "") {
										break;
									}
								}
								$code = substr($result, 0, 2);
								echo '<p class="icon stn-code '.$code.'">'.$result.'</p>';
							}


							for ($i = 0; $i < count($stations); $i++) {
								$station = $stations[$i];
								if ($i % 3 == 0) {
									echo "</tr><tr>";
								}
								echo '<td class="btn" onclick="window.location=\'details.php?station='.urlencode($station->name).'\';">';
								displayLogo($station->name, $mainStationArray);
								echo '<h3 class="name">'.$station->name.'</h3>';
								echo '<p class="rating">'.round($station->getRating()*100,0).'%</p>';
								echo "</td>";
							
							}
						?>
					</table>
				</div>
				<script>
					setTimeout('location.reload()',30000);
					var ele = document.getElementsByClassName('name');
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
					if (!isset($_POST['reply'])) {
						$_POST['reply'] = "";
					}
					$message = htmlspecialchars($_POST['message']);
					$reply = htmlspecialchars($_POST['reply']);
					$sql = "INSERT INTO responses (`UID`, `timestamp`, `station`, `feedback`, `message`, `replyTo`) VALUES (NULL,  NULL, '".$station."', ".$feedback.", '".$message."', '".$reply."');";
					$result = mysqli_query($con, $sql);
					if ($result) {
						$array = array("status" => "success");
					} else {
						$array = array("status" => "failure");
					}
					echo json_encode($array);
				} else {
					echo("Invalid Action defined");
				}
			?>
	
