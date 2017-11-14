<?php
/*Include the `fusioncharts.php` file that contains functions
	to embed the charts.
*/
include("includes/helper.php");
?>

<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
	  <link  rel="stylesheet" type="text/css" href="css/style_grafica.css" />

	<!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->

      <script src="js/fusioncharts.js"></script>
   </head>
   <body>
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT Name, Population, Code FROM Country ORDER BY Population DESC LIMIT 10";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
                    "caption" => "Top 10 Most Populous Countries",
                    "showValues"=> "0",
                    "theme"=> "zune"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array

        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
                "label" => $row["Name"],
                "value" => $row["Population"],
                "link" => "countryDrillDown.php?Country=".$row["Code"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}

  	?>
        <header>
            <h1>Sistema de Información Bypass</h1>
        </header>
        <div id="contenedor">
            <div id="chart-1"><!-- Fusion Charts will render here--></div>
        </div>
   </body>
</html>