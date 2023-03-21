<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="modal fade" id="roleAkses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="roleAksesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{route('user-manajement.set-role')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="roleAksesLabel">Anda Belum Memiliki Role Akses</h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Role Akses</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="2">Admin-PPK</option>
                                <option value="5">PPK</option>
                                <option value="6">Kepala-UPTD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>UPTD</label>
                            <select name="uptd_id" id="uptd_id" class="form-control" required>
                                <option value="">Pilih UPTD</option>
                                @foreach ($uptd as $item)
                                <option value="{{$item->id}}">{{$item->nama_uptd}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="ppk">
                            <label>PPK</label>
                            <select name="ppk_id" id="ppk_id" class="form-control" required>
                                <option value="">Pilih PPK</option>
                                @foreach ($ppk as $item)
                                <option value="{{$item->user_id}}">{{$item->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            $('#roleAkses').modal('show');
            $('#ppk').hide();
            $('#role').change(function() {
                if ($(this).val() == 2) {
                    $('#ppk').show();
                } else {
                    $('#ppk').hide();
                }
            });
        });
    </script>
</body>

</html>