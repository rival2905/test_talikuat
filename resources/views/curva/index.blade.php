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
        const urlApi = "{{ route('get-data-progress', $id) }}";
        try {
            $.ajax({
                url: urlApi,
                method: "GET",
                async: false
            }).done(function(response) {

                const rencana = response.data.rencana.map((item) => item.nilai);
                const realisasi = response.data.realisasi.map((item) => parseFloat(item.nilai));
                const cumulativeSum = (
                    (sum) => (value) =>
                    (sum += value)
                )(0);
                const realisasiSum = realisasi.map(cumulativeSum);
                console.log(realisasi);
                console.log(realisasiSum);

                const labels = response.data.tanggal;
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Rencana',
                        data: rencana,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }, {
                        label: 'Realisasi',
                        data: realisasiSum,
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
            });

        } catch (error) {
            console.log(error);

        }
    </script>
</body>

</html>