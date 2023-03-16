<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <canvas id="curva"></canvas>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let dataJson = '{!! json_encode($data) !!}';
        dataJson = JSON.parse(dataJson);
        console.log(dataJson);
        const rencana = dataJson.rencana.map((item) => item.nilai);
        const realisasi = dataJson.realisasi.map((item) => item.nilai);
        console.log(realisasi);
        const labels = dataJson.tanggal;
        const data = {
            labels: labels,
            datasets: [{
                label: 'My First Dataset',
                data: rencana,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }, {
                label: 'My First Dataset',
                data: realisasi.sort(),
                fill: false,
                borderColor: 'red',
                tension: 0.1
            }],
            options: {
                responsive: true,
                hover: {
                    mode: 'label'
                },
                scales: {
                    y: {
                        max: 100
                    }

                }
            }
        };
        const config = {
            type: 'line',
            data: data,
        };

        new Chart(
            document.getElementById('curva'),
            config
        );
    </script>
</body>

</html>