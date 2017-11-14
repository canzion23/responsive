<?php

 /* Include the `includes/fusioncharts.php` file that contains functions to embed the charts.*/

 include("includes/helper.php");
?>
<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart</title>
  	<link  rel="stylesheet" type="text/css" href="css/style_grafica.css" />

	  <!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->

  	<script src="js/fusioncharts.js"></script>
   </head>
   <body>
  	<?php

     	// Get the country code from the GET parameter
     	$countryCode = $_GET["Country"];

     	// Form the SQL query that returns the top 10 most populous cities in the selected country
     	$cityQuery = "SELECT Name, Population FROM City WHERE CountryCode = ? ORDER BY Population DESC LIMIT 10";

     	// Prepare the query statement
     	$cityPrepStmt = $dbhandle->prepare($cityQuery);

     	// If there is an error in the statement, exit with an error message
     	if($cityPrepStmt === false) {
        	exit("Error while preparing the query to fetch data from City Table. ".$dbhandle->error);
     	}

     	// Bind the parameters to the query prepared
     	$cityPrepStmt->bind_param("s", $countryCode);

     	// Execute the query
     	$cityPrepStmt->execute();

     	// Get the results from the query executed
     	$cityResult = $cityPrepStmt->get_result();

     	// If the query returns a valid response, prepare the JSON string
     	if ($cityResult) {

        	/* Form the SQL query that will return the country name based on the country code. The result of the above query contains only the country code. The country name is needed to be rendered as a caption for the chart that shows the 10 most populous cities */

        	$countryNameQuery = "SELECT Name FROM Country WHERE Code = ?";

        	// Prepare the query statement
        	$countryPrepStmt = $dbhandle->prepare($countryNameQuery);

        	// If there is an error in the statement, exit with an error message
        	if($countryPrepStmt === false) {
           	exit("Error while preparing the query to fetch data from Country Table. ".$dbhandle->error);
        	}

        	// Bind the parameters to the query prepared
        	$countryPrepStmt->bind_param("s", $countryCode);

        	// Execute the query
        	$countryPrepStmt->execute();

        	// Bind the country name to the variable `$countryName`
        	$countryPrepStmt->bind_result($countryName);

        	// Fetch the result from prepared statement
        	$countryPrepStmt->fetch();

        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
                    "caption" => "Top 10 Most Populous Cities in ".$countryName,
                    "showValues"=> "0",
                    "theme"=> "zune"
              	)
           	);

        	$arrData["data"] = array();

			// Push the data into the array
        	while($row = $cityResult->fetch_array()) {
                array_push($arrData["data"], array(
              	"label" => $row["Name"],
              	"value" => $row["Population"]
              	)
           	);
        	}

           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

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
<a href="country.php">Atras</a>
    <div id="chart-1"><!-- Fusion Charts will render here--></div>
</div>
   </body>
</html>