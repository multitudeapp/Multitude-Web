<?php
	//phpinfo();
	// Start of stupid code
	$rand = rand(0,100);
	if ($rand == 0) {
		echo '<img src="http://scienceblogs.com/gregladen/files/2012/12/Beautifull-cat-cats-14749885-1600-1200.jpg" />';
	}
	// End
	require("station.php");
	$con = mysqli_connect("overpowered.cloudapp.net","root","temppassword123!","maindb");
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if (!isset($_GET['action'])) {
		$_GET['action'] = "";
	}
	
	if ($_GET['action'] == "list") {
		
		$mainStationArray = 
			array(
				"NS" => array(
							"NS1" => "Jurong East",
							"NS2" => "Bukit Batok",
							"NS3" => "Bukit Gombak",
							"NS4" => "Choa Chu Kang",
							"NS5" => "Yew Tee",
							"NS6" => "Sungei Kadut",
							"NS7" => "Kranji",
							"NS8" => "Marsiling",
							"NS9" => "Woodlands",
							"NS10" => "Admiralty",
							"NS11" => "Sembawang",
							"NS12" => "Canberra",
							"NS13" => "Yishun",
							"NS14" => "Khatib",
							"NS15" => "Yio Chu Kang",
							"NS16" => "Ang Mo Kio",
							"NS17" => "Bishan",
							"NS18" => "Braddell",
							"NS19" => "Toa Payoh",
							"NS20" => "Novena",
							"NS21" => "Newton",
							"NS22" => "Orchard",
							"NS23" => "Somerset",
							"NS24" => "Dhoby Ghaut",
							"NS25" => "City Hall",
							"NS26" => "Raffles Place",
							"NS27" => "Marina Bay",
							"NS28" => "Marina South Pier"
							),
				"EW" => array(
							"EW1" => "Pasir Ris",
							"EW2" => "Tampines",
							"EW3" => "Simei",
							"EW4" => "Tanah Merah",
							"EW5" => "Bedok",
							"EW6" => "Kembangan",
							"EW7" => "Eunos",
							"EW8" => "Paya Lebar",
							"EW9" => "Aljunied",
							"EW10" => "Kallang",
							"EW11" => "Lavender",
							"EW12" => "Bugis",
							"EW13" => "City Hall",
							"EW14" => "Raffles Place",
							"EW15" => "Tanjong Pagar",
							"EW16" => "Outram Park",
							"EW17" => "Tiong Bahru",
							"EW18" => "Redhill",
							"EW19" => "Queenstown",
							"EW20" => "Commonwealth",
							"EW21" => "Buona Vista",
							"EW22" => "Dover",
							"EW23" => "Clementi",
							"EW24" => "Jurong East",
							"EW25" => "Chinese Garden",
							"EW26" => "Lakeside",
							"EW27" => "Boon Lay",
							"EW28" => "Pioneer",
							"EW29" => "Joo Koon",
							"EW30" => "Gul Circle",
							"EW31" => "Tuas Crescent",
							"EW32" => "Tuas West Road",
							"EW33" => "Tuas Link",
							"CG1" => "Expo",
							"CG2" => "Changi Airport"
						),
				"NE" => array(
							"NE1" => "HarbourFront",
							"NE2" => "Keppel",
							"NE3" => "Outram Park",
							"NE4" => "Chinatown",
							"NE5" => "Clarke Quay",
							"NE6" => "Dhoby Ghaut",
							"NE7" => "Little India",
							"NE8" => "Farrer Park",
							"NE9" => "Boon Keng",
							"NE10" => "Potong Pasir",
							"NE11" => "Woodleigh",
							"NE12" => "Serangoon",
							"NE13" => "Kovan",
							"NE14" => "Hougang",
							"NE15" => "Buangkok",
							"NE16" => "Sengkang",
							"NE17" => "Punggol"
						),
				"CC" => array(
							"CC1" => "Dhoby Ghaut",
							"CC2" => "Bras Basah",
							"CC3" => "Esplanade",
							"CC4" => "Promenade",
							"CC5" => "Nicoll Highway",
							"CC6" => "Stadium",
							"CC7" => "Mountbatten",
							"CC8" => "Dakota",
							"CC9" => "Paya Lebar",
							"CC10" => "MacPherson",
							"CC11" => "Tai Seng",
							"CC12" => "Bartley",
							"CC13" => "Serangoon",
							"CC14" => "Lorong Chuan",
							"CC15" => "Bishan",
							"CC16" => "Marymount",
							"CC17" => "Caldecott",
							"CC18" => "Bukit Brown",
							"CC19" => "Botanic Gardens",
							"CC20" => "Farrer Road",
							"CC21" => "Holland Village",
							"CC22" => "Buona Vista",
							"CC23" => "one-north",
							"CC24" => "Kent Ridge",
							"CC25" => "Haw Par Villa",
							"CC26" => "Pasir Panjang",
							"CC27" => "Labrador Park",
							"CC28" => "Telok Blangah",
							"CC29" => "HarbourFront",
							"CE1" => "Bayfront",
							"CE2" => "Marina Bay"
						),
				"DT" => array(
							"DT1" => "Bukit Panjang",
							"DT2" => "Cashew",
							"DT3" => "Hillview",
							"DT4" => "Hume Avenue",
							"DT5" => "Beauty World",
							"DT6" => "King Albert Park",
							"DT7" => "Sixth Avenue",
							"DT8" => "Tan Kah Kee",
							"DT9" => "Botanic Gardens",
							"DT10" => "Stevens",
							"DT11" => "Newton",
							"DT12" => "Little India",
							"DT13" => "Rochor",
							"DT14" => "Bugis",
							"DT15" => "Promenade",
							"DT16" => "Bayfront",
							"DT17" => "Downtown",
							"DT18" => "Telok Ayer",
							"DT19" => "Chinatown",
							"DT20" => "Fort Canning",
							"DT21" => "Bencoolen",
							"DT22" => "Jalan Besar",
							"DT23" => "Bendemeer",
							"DT24" => "Geylang Bahru",
							"DT25" => "Mattar",
							"DT26" => "MacPherson",
							"DT27" => "Ubi",
							"DT28" => "Kaki Bukit",
							"DT29" => "Bedok North",
							"DT30" => "Bedok Reservoir",
							"DT31" => "Tampines West",
							"DT32" => "Tampines",
							"DT33" => "Tampines East",
							"DT34" => "Upper Changi",
							"DT35" => "Expo"
						),
				"TS" => array(
							"TS1" => "Woodlands North",
							"TS2" => "Woodlands",
							"TS3" => "Woodlands South",
							"TS4" => "Springleaf",
							"TS5" => "Lentor",
							"TS6" => "Mayflower",
							"TS7" => "Bright Hill",
							"TS8" => "Upper Thomson",
							"TS9" => "Caldecott",
							"TS10" => "Mount Pleasant",
							"TS11" => "Stevens",
							"TS12" => "Napier",
							"TS13" => "Orchard Boulevard",
							"TS14" => "Orchard",
							"TS15" => "Great World",
							"TS16" => "Havelock",
							"TS17" => "Outram Park",
							"TS18" => "Maxwell",
							"TS19" => "Shenton Way",
							"TS20" => "Marina Bay",
							"TS21" => "Marina South",
							"TS22" => "Gardens by the Bay"
						)
				);
		echo date('Y-m-d H:i:s');
		?>
		
		<table width="90%">
			<tr>
				<td align="left">
					<img src="MultitudeLogo.png" height="100px" />
				</td>
				<td>
				</td>
				<td align="right">
				Search
				</td>
			<!-- </tr> Intentionally removed -->
			<?php
				if(isset($_GET['line'])) {
					$line = htmlspecialchars($_GET['line']);
					$filter = "WHERE `station` = 'IGNORETHIS";
					foreach ($mainStationArray[$line] as &$station) {
						$filter = "' OR `station` = '".$station;
					}
					$filter .= "'";
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
				
				
				
				// Start displaying 
				function displayLogo($name, $mainArray) {
					
					
					//for ($i = 0; $i < count($mainArray); $i++) { // For every line
					foreach ($mainArray as $temp) {
						
						//$temp = $mainArray[$i];
						foreach ($temp as $key => $value) {
							if ($value == $name) {
								echo $key;
							}
						}
						
						/*
						for ($j = 0; $j < count($temp); $j++) { // For every station
							
							if ($temp[$j] == $name) {
								echo key($temp[$j]);
							}
							
						}
						*/
						
					
					}
					
					
					/*
					
					foreach ($mainArray as &$line) {
						$code = array_search($name, $line);
						echo "<script>alert('I am looking for ".$name." which has a code of ".$code."');</script>";
					}
					//if ($code != "") {
						echo $code . " | ";
					//}
					
					*/
				}
				
				
				for ($i = 0; $i < count($stations); $i++) {
					$station = $stations[$i];
					if ($i % 3 == 0) {
						echo "</tr><tr>";
					}
					echo "<td>";
					displayLogo($station->name, $mainStationArray);
					echo '<span class="name">'.$station->name.'</span>';
					echo '<span class="rating">'.round($station->getRating()*100,0).'%</span>';
					echo "</td>";
				
				}
			?>
		</table>
		
		
		<?php
		
		
		
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
	