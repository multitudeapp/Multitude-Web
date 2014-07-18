<html>
    <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="wordcloud.js"></script>
<?php
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
			echo '<input id="list" value="'.implode($messages, ' ').'"></input>';
            $rowsTables = "[['".implode($messages, "'],['")."']]";
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
            var optiones = {'showRowNumber':true,
                            'alternatingRowStyle':true,
                            'width':700};
                           
            var charts = new google.visualization.Table(document.getElementById('table_div'));
            charts.draw(datas, optiones);
        }
        
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Response');
            data.addColumn('number', 'Number');
            data.addRows(<?php echo $rowsString; ?>);

            // Set chart options
            var options = {'title':'<?php echo $stationName; ?>',
                            'width':500,
                            'height':500,
                            'is3D':true,
                            'colors': ['#29d629','#FF0000'],
                            'backgroundColor':'black',
                            'titleTextStyle':{color:'white',fontName:'cursive',fontSize:'30'},
                            'legendTextStyle':{color:'white',fontName:'Gadget'},
                            };
                           
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
  </head>
  
  <body>
	<div id="chart_div"></div>
    <div><canvas id="canvvas"></canvas></div>
    Messages: <br />
    <div id="table_div"></div>
  </body>
</html>