
<script>
        var sline = {
        chart: {
            height: 350,
            type: 'line',
            zoom: {
            enabled: false
            },
            toolbar: {
            show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        series: [{
            name: "Sales",
            data: [
                    '{{ $sales[1] }}', '{{  $sales[2] }}','{{  $sales[3] }}','{{  $sales[4] }}','{{  $sales[5] }}',
                    '{{  $sales[6] }}', '{{  $sales[7] }}','{{  $sales[8] }}','{{  $sales[9] }}','{{  $sales[10] }}','{{  $sales[11] }}', '{{ $sales[12] }}'
                ]
        }],
        title: {
            text: 'Monthly Sales Trend for the Year {{ $date->format('Y') }}',
            align: 'center'
        },
        grid: {
            row: {
            colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        }
        }

        var chart = new ApexCharts(
        document.querySelector("#sales-chart"),
        sline
        );

        chart.render();
 </script>
