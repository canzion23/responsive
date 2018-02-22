<?php
    /*
        Include the `fusioncharts.php` file that contains functions to embed the charts.
    */
    include("includes/helper.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link  rel="stylesheet" type="text/css" href="css/style_grafica.css" />

   <!-- You need to include the following JS file to render the chart.
   When you make your own charts, make sure that the path to this JS file is correct.
   Else, you will get JavaScript errors. -->

   <script src="js/fusioncharts.js"></script>
   <!--<script <src="js/themes/fusioncharts.theme.zune.js"></script>-->
</head>
<body>
<?php

   // Form the SQL query that returns the top 10 most populous countries
   $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 10";

   // Execute the query, or else return the error message.
   $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

   // If the query returns a valid response, prepare the JSON string
   if ($result) {
      // The `$arrData` array holds the chart attributes and data
      $arrData = array(
          "chart" => array(
            "caption" => "Comportamiento de celdas",
            "showValues" => "1",
            "theme" => "ocean"
            )
         );

      $arrData["data"] = array();

// Push the data into the array
      while($row = mysqli_fetch_array($result)) {
         array_push($arrData["data"], array(
            "label" => $row["Name"],
            "value" => $row["Population"]
            )
         );
      }

      /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

      $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

      $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

      // Render the chart
      $columnChart->render();

      // Close the database connection
      $dbhandle->close();
   }

?>
        <header class="header">
            <h1>Sistema de Información Bypass</h1>
        </header>
        <menu class="topnav">
            <a href="#" >Home</a>
            <a href="#" >Grafico</a>
            <a href="#" >Historial</a>
        </menu>

        <div class="row">
            <div class="column side">
                <h2>Side</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
            </div>
            <div class="column middle">
                <h2>Main Content</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
                <div id="contenedor">
            <div id="chart-1"><!-- Fusion Charts will render here--></div>            
        </div>
            </div>
            <div class="column side">
                <h2>Side</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
            </div>
        </div>

        
    </body>

</html>