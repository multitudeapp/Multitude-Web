<html>
    <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <?php

        require("station.php");
        $con = mysqli_connect("localhost","root","temppassword123!","maindb");
        if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "SELECT `station`, COUNT(*) as freq FROM `responses` GROUP BY `station`";
		$result = mysqli_query($con, $sql);
		$rows = mysqli_num_rows($result);
		$stations = array();
		$count = 0;
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
        
        $rowsString = '[';
        for ($i = 0; $i < count($stations) - 1; $i++)
		{
			$rowsString = $rowsString."['".$stations[$i]->name."',".round($stations[$i]->getRating()*100,0)."],";
		}
        $noOfStations = count($stations) - 1;
        $rowsString = $rowsString."['".$stations[$noOfStations]->name."',".round($stations[$noOfStations]->getRating()*100,0)."]]";
        echo $rowsString;
    ?>
    <script type="text/javascript">
        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Stations');
            data.addColumn('number', 'Feedback');
            data.addRows(<?php echo $rowsString; ?>);

            // Set chart options
            var options = {'title':'Test',
                            'width':500,
                            'height':500};
                           
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
  </head>
  
  <body>
	<div id="chart_div"></div>
  </body>
</html>