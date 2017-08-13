<canvas id="graph-<?php echo $obj['name']?>"></canvas>
<script>
$(function() {
    window.<?php echo $obj['name']; ?> = new Chart(document.getElementById("graph-<?php echo $obj['name']; ?>").getContext("2d"), {
        type: 'line',
        data: {
            labels: [<?php echo $labels; ?>],
            datasets: [{
                label: "<?php echo ucfirst($obj['name']); ?>",
                lineTension: 0.175,
                backgroundColor: '#2E3136',
                borderColor: '#BB1050',
                data: [<?php echo $obj['data']; ?>],
                fill: false,
                pointRadius: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            bezierCurve: false,
            responsive: true,
            title:{
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            legend: {
                display: false
            },
            showXLabels: 3,
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return null;
                        }
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    }
                }]
            }
        }
    });
});
</script>