<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>High Chart</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>

</head>
<body>
<div class="flex-center position-ref full-height">

    <div id="container"></div>
</div>

<script>
    Highcharts.chart('container', {

        title: {
            text: 'Progressed of Onboarding Flow. 2016/07-2016/08'
        },
        chart: {
            type: 'spline'
        },
        xAxis: {
            title: {
                text: 'Complete Percentage'
            },
            categories: [0, 20, 40, 50, 70, 90, 99, 100]
        },
        yAxis: {
            title: {
                text: 'Users'
            },
            min: 0,
            max: <?= $user_count ?>
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 0,
            }
        },

        series: <?php echo $series;?>,

        /* responsive: {
             rules: [{
                 condition: {
                     maxWidth: 500
                 },
                 chartOptions: {
                     legend: {
                         layout: 'horizontal',
                         align: 'center',
                         verticalAlign: 'bottom'
                     }
                 }
             }]
         }*/

    });
</script>
</body>
</html>
