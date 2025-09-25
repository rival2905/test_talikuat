@extends('layouts.app')
@section('content')

<div class="card rounded-4 shadow-lg border-0">
    <div class="card-body p-4">
        <div class="card-block">
            @csrf
            @foreach($file_init as $file)
            <div class="row border p-3 m-2 rounded-3 shadow-sm">
                <div class="col p-3">
                    <label for="{{$file->name}}" class="fw-bold">{{$file->label}}</label>
                    <div class="input-group mb-3 d-flex">
                        @if (Auth::user()->userDetail->role != 7)
                        <input type="file" class="form-control" name="{{$file->name}}" accept="application/pdf" onchange="fileValidation(this)" id="{{$file->name}}" />
                        <button class="btn btn-success ms-2" type="button" data-id="{{$file->name}}" onclick="handleSumbit(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Upload">
                            <i class="bx bx-upload"></i>
                        </button>
                        @endif
                        @if(count($file->file) <= 0)
                        <p class="text-danger ms-2">Belum ada file</p>
                        @endif
                    </div>

                    @foreach($file->file as $f)
                    <div class="row mb-1">
                        <div class="col d-flex align-items-center">
                            <a href="{{ route('show.file.dataumum',['id'=>$data->id,'file'=>$f->file_name] ) }}" target="_blank" class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download">
                                {{$f->file_name}}
                            </a>
                            @if (Auth::user()->userDetail->role != 7)
                            <button class="btn btn-danger btn-sm" type="button" onclick="deleteModal(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete File" data-bs-id="{{$data->id}}" data-bs-file="{{$f->file_name}}">
                                <i class="bx bx-trash"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <div class="form-group">
                        <span class="text-danger">
                            <strong id="{{$file->name . '_'}}file_error"></strong>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="progress" id="{{$file->name.'_progress'}}"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal Delete File -->
<div class="modal fade" id="modalDeleteFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="modalDeleteFileLabel">Delete File</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus file ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="formDeleteFile">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function fileValidation(file) {
    const fileId = file.id;
    const fileInput = document.getElementById(fileId);
    const allowedExtensions = /(\.pdf)$/i;

    if (!allowedExtensions.exec(fileInput.value)) {
        $("#" + fileId + "_file_error").html("File type hanya diperbolehkan PDF");
        return false;
    } else {
        $("label[for='" + fileId + "']").html(fileInput.files[0].name);
        $("#" + fileId + "_file_error").html("");
        return true;
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function handleSumbit(el) {
    const fileId = el.dataset.id;
    const fileInput = document.getElementById(fileId);

    if (fileValidation(fileInput)) {
        const formData = new FormData();
        formData.append("file", fileInput.files[0]);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("file_name", fileId);

        $.ajax({
            url: "{{ route('store.file.dataumum',$data->id) }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#" + fileId + "_progress").show().html(
                    '<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%"></div>'
                );
            },
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", e => {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        $("#" + fileId + "_progress .progress-bar").css("width", percentComplete + "%").html(Math.round(percentComplete) + "%");
                    }
                });
                return xhr;
            },
            success: async function(data) {
                $("#" + fileId + "_progress").hide();
                $("#" + fileId + "_file_error").html('<div class="alert alert-success">' + data.message + '</div>');
                await sleep(1000);
                location.reload();
            },
            error: function() {
                $("#" + fileId + "_file_error").html("Terjadi kesalahan, silahkan coba lagi atau hubungi admin");
            }
        });
    }
}

function deleteModal(el) {
    const id = $(el).attr('data-bs-id');
    const fileName = encodeURIComponent($(el).attr('data-bs-file'));
    const uri = "{{ url('data-umum/deletefile') }}/" + id + "/" + fileName;
    $("#formDeleteFile").attr('action', uri);
    $("#modalDeleteFile").modal("show");
}

$(document).ready(function() {
    $(".progress").hide();
    [...document.querySelectorAll(".js-noMenu")].forEach(el => el.addEventListener('contextmenu', e => e.preventDefault()));
});
</script>
@endsection
