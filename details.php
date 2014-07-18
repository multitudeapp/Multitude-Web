<html>
    <head>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="wordcloud.js"></script>
<?php
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
	require("station.php");
	require("db.php");
	if (isset($_GET['station'])) {
		$station = htmlspecialchars($_GET['station']);
		$sql = "SELECT * FROM `responses` WHERE `station` = '".$station."';";
		$result = mysqli_query($con, $sql);
		$rows = mysqli_num_rows($result);
		if ($rows != 0) {
			//echo '<script type="text/javascript" src="wordcloud.js"></script>';
			$station = new Station($station);
			$sql = "SELECT COUNT(*) as freq FROM `responses` WHERE feedback = 1 AND station = '".$station->name."'";
			$result = mysqli_query($con, $sql);
			$value = mysqli_fetch_object($result);
			$station->positive = $value->freq;;

			$sql = "SELECT COUNT(*) as freq FROM `responses` WHERE feedback = 0 AND station = '".$station->name."'";
			$result = mysqli_query($con, $sql);
			$value = mysqli_fetch_object($result);
			$station->negative = $value->freq;;
		
		
			// HI KENNETH. IMPT VARS HERE
			$yes = $station->positive;
			$no = $station->negative;
			$total = $station->getTotal();
            $stationName = $station->name;
			//echo "<br /> Positive: " . $yes;
			//echo "<br /> Negative: " . $no;
            $rowsString = "[['Positive (".$yes.")',".$yes."],['Negative (".$no.")',".$no."]]";
			// WORD CLOUD??
			
			// Messages
			
			$sql = "SELECT * FROM `responses` WHERE station = '".$station->name."';";
			$result = mysqli_query($con, $sql);
			$rows = mysqli_num_rows($result);
			$messages = array();
			while($array = mysqli_fetch_array($result)) {
				if (!$array['message'] == "") {
					array_push($messages, $array['message']);
				}
			}
			//echo '<input id="list" value="'.implode($messages, ' ').'"></input>';
            $rowsTables = "[['".implode($messages, "'],['")."']]";
            //Backend done
            //Presenting on webpage part
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
					echo '<span class="bigicon '.$code.'">'.substr($result, 0, 2).'</span>';
            }
            
            echo '<img src="Multitude.png" width="300" height="100"/><table><tr><td>';
            displayLogo($station -> name, $mainStationArray);
            echo '</td><td><b class="detailname">'.$station->name.'</b><br />';
            if (round($station->getRating()*100,0) < 50) {
                echo '<b class="detailnamebad">'.round($station->getRating()*100,0).'%</b>';
            } else {
                echo '<b class="detailnamegood">'.round($station->getRating()*100,0).'%</b>';
            }
            
		}
	}
?>
<script type="text/javascript">
		function outside(arr) {
			var x = getElementsAndFreq(arr);
			var result = new Array();
			for (var i = 0; i < x[0].length; i++) {
				result.push(new Array(x[0][i], x[1][i]));
			}
			return result;
		}
		function getElementsAndFreq(arr) {
			var a = [], b = [], prev;

			arr.sort();
			for ( var i = 0; i < arr.length; i++ ) {
				if ( arr[i] !== prev ) {
					a.push(arr[i]);
					b.push(1);
				} else {
					b[b.length-1]++;
				}
				prev = arr[i];
			}

			return [a, b];
		}

        google.load('visualization', '1.0', {'packages':['corechart','table']});
        google.setOnLoadCallback(drawChart);
        google.setOnLoadCallback(drawTableMessage);
        var canvas = document.getElementById('canvvas');
        var list = document.getElementById('list').value.split(' ');
		
		drawCanvas();
        
        function drawCanvas(){
            if (WordCloud.isSupported) {
				
                var options = {'color':'rgb(0,0,0)',
                                'backgroundColor':'rgb(255,255,255)',
								'list':outside(list)
								
								
								
							  };
                WordCloud(canvas, options)
            }
            
        }
        
        function drawTableMessage() {
            var datas = new google.visualization.DataTable();
            datas.addColumn('string', 'Response');
            datas.addRows(<?php echo $rowsTables; ?>);

            // Set chart options
            var optiones = {'alternatingRowStyle':true,
                            'width':910};
                           
            var charts = new google.visualization.Table(document.getElementById('table_div'));
            charts.draw(datas, optiones);
        }
        
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Response');
            data.addColumn('number', 'Number');
            data.addRows(<?php echo $rowsString; ?>);

            // Set chart options
            var options = {'title':'',//<?php echo $stationName; ?>',
                            'width':250,
                            'height':250,
                            'pieHole':0.8,
                            'legend':{position:'none'},
                            'pieSliceText':'none',
                            'colors': ['#29d629','#FF0000'],
                            };
                           
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
  </head>
  
  <body>
    </td>
    <td>
    <div id="chart_div"></div>
    </td></tr></table><br/>
    <div id="table_div"></div>
  </body>
</html>