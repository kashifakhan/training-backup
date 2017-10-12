<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 12/10/17
 * Time: 12:56 PM
 */
$this->title='Graph';
?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">


    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
        var data = google.visualization.arrayToDataTable([
            ['Product SKU(s)', 'Quantity Sold'],
            <?
            foreach ($orders as $key => $value)
            {
                echo '['."'".$value['SKU']."'".','.$value['count'].'],';
            }
            ?>
        ]);
        var options = {
            chart: {
                title: 'Top selling products',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('order_div'));

        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawAreaChart);
    function drawAreaChart()
    {
        var data = google.visualization.arrayToDataTable([
            ['Month',  'Revenue(in $)'], //['Month',  'Revenue(in $)','Orders'],
            <?
            foreach ($revenue as $key => $value)
            {
                echo '['."'".$key."'".','.$value['revenue'].'],'; //echo '['."'".$key."'".','.$value['revenue'].','.$value['order'] .'],';
            }
            ?>
        ]);
        var options = {
            chart: {
                title: 'Company Performance',
            },
            bars: 'vertical' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('Revenue_div'));

        chart.draw(data, options);
    }
</script>
<div id="order_div" style="width: 45%; height: 700px; float: left;margin-left: 2%;"></div>
<div id="Revenue_div" style="width: 45%; height: 700px; float: left;margin-left: 2%;"></div>

</script>
</body>
    </html>
