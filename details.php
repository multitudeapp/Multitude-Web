<html>
    <head>
    	<link rel="stylesheet" href="assets/css/foundation.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/normalize.css" type="text/css" />
    	<link rel="stylesheet" href="assets/css/style-detail.css" type="text/css" />
    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	</head>
<body>
	<div id="container">
	<header class="row">
		<a href="index.php?action=list"><img id="banner-logo" src="Multitude.png" height="100px"/></a>
	</header>
	<?php 		
	require("station.php");
	require("message.php");
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
            $rowsString = "[['Positive (".$yes.")',".$yes."],['Negative (".$no.")',".$no."]]";
			// WORD CLOUD??
			
			// Messages
			
			$sql = "SELECT * FROM `responses` WHERE station = '".$station->name."' ORDER BY `timestamp` DESC;";
			$result = mysqli_query($con, $sql);
			$rows = mysqli_num_rows($result);
			$messages = array();
			while($array = mysqli_fetch_array($result)) {
				if (!$array['message'] == "") {
					$message = new Message($array['UID'], $array['message'], $station->name, $array['timestamp'], $array['replyTo']);
					array_push($messages, $message);
				}
			}
			$messageString = "[['";
			if (count($messages) == 0) {
				echo "No detailed feedback has been given yet";
			} else {
				$messageTable = "<table id='feedback' align='center'>";
				foreach($messages as &$message) {
					$messageTable .= "<tr id='messages'><td class='message' id='message".$message->id."'><span class='message'>".$message->message."</span>";
					$messageTable .= "<br /><small class='timestamp'>".$message->timestamp."</small>";
					if ($message->replyTo != "") {
						$messageTable .= "<small class='response'>  In response to ".$message->replyTo.'</small>';
					} else {
						$messageTable .= "<small>   Added by Multitude app</small>";
					}
					echo '<script>alert("replyTo is '.$message->replyTo.'");</script>';
					$messageTable .= "</td></tr><tr><td class='comment'><input name='comment' id='comment".$message->id."'></input><input type='submit' class='submit' id='submit".$message->id."' value='Reply'></input></td></tr>";
					$messageString .= $message->message."'],['";
				}
				$messageString = substr($messageString, 0, strlen($messageString) - 3)."]";
				$messageTable .= "</table>";
			}
            //$rowsTables = "[['".implode($messages, "'],['")."']]";
			$rowsTables = $messageString;
			
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
					echo '<p class="bigicon '.$code.'">'.substr($result, 0, 2).'</p>';
            }
            displayLogo($station->name, $mainStationArray);

	?>
<?php
			
            echo '<table style="detailstable"><tr><td>';
            echo '</td><td><h3 class="detailname" id="station">'.$station->name.'</h3>';
            if (round($station->getRating()*100,0) < 66) {
                if (round($station->getRating()*100,0) < 33) {
                    echo '<p class="detailnamebad">'.round($station->getRating()*100,0).'%</p>';
                } else {
                    echo '<p class="detailnameavg">'.round($station->getRating()*100,0).'%</p>';
                }
            } else {
                echo '<p class="detailnamegood">'.round($station->getRating()*100,0).'%</p>';
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
        //google.setOnLoadCallback(drawTableMessage);
        //var canvas = document.getElementById('canvvas');
        //var list = document.getElementById('list').value.split(' ');
		
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
                            'height':250,
                            'pieHole':0.8,
                            'legend':{position:'none'},
                            'pieSliceText':'none',
                            'colors': ['#2fd09a','#bb4452'],
                            };
                           
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
  
    
    <div id="chart_div"></div>
    
    <div id="table_div"></div>
	
	<div id="messageTable"><?php echo $messageTable; ?></div>
	</div>
	<script type="text/javascript">
		var x = document.getElementsByClassName("message");
		for (var i = 0; i < x.length; i++) { // Create click event listener for all messages
			x[i].addEventListener("click", showCommentBox);
		}
		x = document.getElementsByClassName("submit"); 
		for (var i = 0; i < x.length; i++) { // Create click event listener for all buttons
			x[i].addEventListener("click", submit);
		}
		
		function showCommentBox() {
			console.log("Showing comment box " + this.id.substr(7));
			var y = document.getElementById("comment" + this.id.substr(7));
			y.parentNode.style.display = "inline-block";
		}
		function submit() {
			var id = this.id.substr(6);
			var station = document.getElementById("station").innerText;
			var feedback = 0;
			var message = document.getElementById("comment" + id).value;
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			console.log("Button " + id + " clicked.");
			xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					console.log(xmlhttp.responseText);
					window.location = window.location;
				}
			}
			xmlhttp.open("POST","index.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("action=add&feedback=" + feedback + "&station=" + station + "&message=" + message + "&reply=" + id);
			
		}
	</script>
  </body>
</html>
