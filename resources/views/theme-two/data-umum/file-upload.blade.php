@extends('layouts.app') @section('content')

<div class="card">
    <div class="card-body">
        <div class="card-block">
            @csrf @foreach($file_init as $file)
            <div class="row border p-3 m-2">
                <div class="col p-3">
                    <label for="file">{{$file->label}}</label>
                    <div class="input-group mb-3 d-flex">
                        @if (Auth::user()->userDetail->role != 7)
                        <div class="custom-file">
                            <input type="file" class="form-control" name="{{$file->name}}" accept="application/pdf" onchange="fileValidation(this)" id="{{$file->name}}" />
                        </div>
                        @endif
                        @if(count($file->file) < 0)
                        <P class="text-danger" style="margin-left: 10px">Belum ada file</P>
                        @endif
                        @if (Auth::user()->userDetail->role != 7)
                        <div class="input-group-append ms-3">
                            <button class="btn btn-success" type="button" data-id="{{$file->name ?? $file->file_label.'_upload'}}" onclick="handleSumbit(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Upload">
                                <i class="bx bx-upload"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                 
                        
                        @foreach($file->file as $file)
                        <div class="row">
                              <div class="col">
                                <a href="{{ route('show.file.dataumum',['id'=>$data->id,'file'=>$file->file_name] ) }}" data-bs-id="{{$data->id}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Download" style="margin-right: 10px">
                                    {{$file->file_name}}
                                </a>
                                <button class="btn btn-danger" type="button" onclick="deleteModal(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Delete File" data-bs-id="{{$data->id}}"data-bs-file="{{$file->file_name}}" >
                                    <i class="bx bx-trash"></i>
                            </button>
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
<div class="modal fade" id="modalDeleteFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDeleteFileLabel">
                    Delete File
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus file ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <form action="" method="get" id="formDeleteFile">
                    @method('DELETE')
                    <button  type="submit" class="btn btn-danger">Delete</button>
                </form>
            
            </div>
        </div>
    </div>
</div>
@endsection @section('scripts')
<script>
    function fileValidation(file) {

        var fileId = file.id;
        var fileInput = document.getElementById(file.id);
        var filePath = fileInput.value;
        var allowedExtensions = /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $("#" + fileId + "_file_error").html(
                "File type Hanya diperbolehkan PDF"
            );
            return false;
        } else {
            $("label[for='" + fileId + "']").html(fileInput.files[0].name);
            $("#" + fileId + "_file_error").html("");
            return true;
        }
    }

    function sleep(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    function handleSumbit(el) {
        var fileId = el.dataset.id.replace("_upload", "");
        console.log(el.dataset);
        var fileInput = document.getElementById(fileId);
        if (fileValidation(fileInput)) {
            var formData = new FormData();
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
                    $("#" + fileId + "_progress").show();
                    $("#" + fileId + "_progress").html(
                        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>'
                    );
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            var percentComplete = (e.loaded / e.total) * 100;
                            $("#" + fileId + "_progress .progress-bar").css(
                                "width",
                                percentComplete + "%"
                            );
                            $("#" + fileId + "_progress .progress-bar").html(
                                percentComplete + "%"
                            );
                        }
                    });
                    return xhr;
                },

                success: async function(data) {
                    $("#" + fileId + "_progress").html(
                        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>'
                    );
                    $("#" + fileId + "_progress").hide();
                    $("#" + fileId + "_upload").hide();
                    $("#" + fileId + "_file_error").html("");
                    $("#" + fileId + "_file_error").html(
                        '<div class="alert alert-success" role="alert">' +
                        data.message +
                        "</div>"
                    );
                    await sleep(1000);
                    location.reload();
                },
                error: function(data) {
                    $("#" + fileId + "_file_error").html(
                        "Terjadi kesalahan, silahkan coba lagi atau hubungi admin"
                    );
                },
            });
        }
    }
    function deleteModal(el) {
     
        const uri = "{{route('deletefile.dataumum',[0,1])}}".replace('0',$(el).attr('data-bs-id'));
        const form =  $("#formDeleteFile").attr('action',encodeURI(uri.replace('/1','/'+$(el).attr('data-bs-file'))));
        $("#modalDeleteFile").modal("show");
      }
    [...document.querySelectorAll(".js-noMenu")].forEach( el => 
        el.addEventListener('contextmenu', e => e.preventDefault())
    );
    $(document).ready(function() {
        $(".progress").hide();
    });
    
</script>
@endsection