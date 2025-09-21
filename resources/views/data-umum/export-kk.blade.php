<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap5.css">

    <title>
        REKAPITULASI KELENGKAPAN DOKUMEN ADMINISTRASI PEKERJAAN KONSTRUKSI TAHUN ANGGARAN {{ $year }}
    </title>
</head>

<body class="container">
<h1 class="text-center">
   REKAPITULASI KELENGKAPAN DOKUMEN ADMINISTRASI PEKERJAAN KONSTRUKSI TAHUN ANGGARAN {{ $year }}
</h1>

<table id="example" class="display table table-striped" style="width:100%">
    
    <thead>
    <tr>
        <th>UPTD</th>
        <th>Nama Kegiatan</th>
        <th>PPK</th>
        <th class="text-center">Lengkap</th>
        <th class="text-center">Tidak Lengkap</th>
        <th class="text-center">Tidak Ada</th>
        <th class="text-center">Penilaian</th>
        <th>Predikat</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data_umums as $no => $data)
        <tr>
            <td class="text-center">{{ $data->uptd_id }}</td>
            <td class="text-uppercase">{{$data->nm_paket}}</td>
            <td>{{$data->detail->ppk->nama ?? ''}}</td>
            <td class="text-center">{{ $data->completeCategories()->count() }}</td>
            <td class="text-center">{{ $data->notCompleteCategories()->count() }}</td>
            <td class="text-center">{{ $data->nothingCategories()->count() }}</td>
            <td class="text-center">
                @if ($data->duDc()->where('is_active', 1)->count() >0)
                {{$data->nkk ?? '0'}}%
                @else
                    Undefine!!
                @endif
            </td>
            @php
                $predicat = 'D';
                if ($data->nkk >= 90) $predicat = 'A';
                elseif ($data->nkk >= 80) $predicat = 'AB';
                elseif ($data->nkk >= 70) $predicat = 'B';
                elseif ($data->nkk >= 60) $predicat = 'BC';
                elseif ($data->nkk >= 50) $predicat = 'C';
            @endphp
            <td class="text-center">
                @if ($data->duDc()->where('is_active', 1)->count() >0)
                {{$predicat}}
                @else
                    Undefine!!
                @endif
            </td>
        </tr>

        @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>UPTD</th>
        <th>Nama Kegiatan</th>
        <th>PPK</th>
        <th>Lengkap</th>
        <th>Tidak Lengkap</th>
        <th>Tidak Ada</th>
        <th>Penilaian</th>
        <th>Predikat</th>
      </tr>
    </tfoot>
          
        
</table>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>

<script>
    $('#example').DataTable({
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 
                {
                    extend: 'excelHtml5',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row h[r^="H"]', sheet).attr('s', '2');
                        $('row g[r^="G"]', sheet).attr('s', '2');

                        // Loop over the cells in column `C`
                        $('row c[r^="H"]', sheet).each(function () {
                            // Get the value
                            if ($('is t', this).text() != 'A') {
                                $(this).attr('s', '20');
                            }
                        });
                    }
                }, 
                {
                    extend: 'pdfHtml5',
                    download: 'open'
                }
                , 'print']
        }
    }
});
</script>

</body>

</html>