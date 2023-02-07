$(document).ready(() => {
    $("#request").DataTable({
        responsive: true,
        columns: [
            { responsivePriority: 4 },
            { responsivePriority: 3 },
            { responsivePriority: 2 },
            { responsivePriority: 1 },
            { responsivePriority: 5 },
            { responsivePriority: 6 },
            { responsivePriority: 7 },
            { responsivePriority: 8 },
        ],
    });
});
$("#exampleModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data("whatever");
    var modal = $(this);
    modal.find(".modal-title").text("New message to " + recipient);
    modal.find(".modal-body input").val(recipient);
});

function rederModalCatatan(el) {
    var fileDirlap = $(el).data("img-dirlap");
    var filePPK = $(el).data("img-ppk");
    var catatanDirlap = $(el).data("dirlap") ?? "Tidak ada catatan";
    var catatanPPK = $(el).data("ppk") ?? "Tidak ada catatan";
    $("#filePPK").attr("src", filePPK);
    $("#fileDirlap").attr("src", fileDirlap);
    $("#catatanPPK").val(catatanPPK);
    $("#catatanDirlap").val(catatanDirlap);
}

function rederModalDetail(el) {
    const data = $(el).data("data");
    console.log(data);
    $("#exampleModalApproval").find("form").attr("action", $(el).data("url"));
    const dataRole = $(el).data("role");
    const bahan = data.detail_bahan;
    const jmf = data.detail_bahan_j_m_f;
    const peralatan = data.detail_peralatan;
    const tenagaKerja = data.detail_tenaga_kerja;
    $("#role").val(dataRole);
    $("#kegiatan").val(data.data_umum_detail.data_umum.nm_paket);
    $("#diajukan_tgl").val(data.tgl_request);
    $("#lokasi_sta").val(data.lokasi_sta);
    $("#jenis_pekerjaan").val(data.jadual.nmp + " " + data.jadual.uraian);
    $("#perkiraan_volume").val(data.volume);
    $("#pelaksanaan_tgl").val(data.tgl_dikerjakan);
    $("#shopDrawing").attr(
        "src",
        "/admin/file-request/" + data.file_shopdrawing
    );
    console.log(data.respon_dirlap);
    $("#catatan_ppk").val(data.respon_ppk);
    $("#catatan_dirlap").val(data.respon_dirlap);

    if (bahan) {
        for (let i = 0; i < bahan.length; i++) {
            $("#tableBahan")
                .find("tbody")
                .html(
                    `<tr>
                    <td>${bahan[i].bahan_material}</td>
                    <td>${bahan[i].satuan}</td>
                    <td>${bahan[i].volume}</td>
                    `
                );
        }
    } else {
        $("#tableBahan")
            .find("tbody")
            .html(
                "<tr><td colspan='3' class='text-center'>Tidak ada bahan material</td></tr>"
            );
    }

    if (jmf) {
        for (let i = 0; i < jmf.length; i++) {
            $("#tableJMF")
                .find("tbody")
                .html(
                    `<tr>
                    <td>${jmf[i].bahan_jmf}</td>
                    <td>${jmf[i].satuan}</td>
                    <td>${jmf[i].volume}</td>
                    `
                );
        }
    } else {
        $("#tableJmf")
            .find("tbody")
            .html(
                "<tr><td colspan='3' class='text-center'>Tidak ada bahan material jmf</td></tr>"
            );
    }

    if (peralatan) {
        for (let i = 0; i < peralatan.length; i++) {
            $("#tablePeralatan")
                .find("tbody")
                .html(
                    `<tr>
                    <td>${peralatan[i].jenis_peralatan}</td>
                    <td>${peralatan[i].jumlah}</td>
                    <td>${peralatan[i].satuan}</td>
                    `
                );
        }
    } else {
        $("#tablePeralatan")
            .find("tbody")
            .html(
                "<tr><td colspan='3' class='text-center'>Tidak ada perlatan</td></tr>"
            );
    }

    if (tenagaKerja) {
        for (let i = 0; i < tenagaKerja.length; i++) {
            $("#tableTenagaKerja")
                .find("tbody")
                .html(
                    `<tr>
                    <td>${tenagaKerja[i].tenaga_kerja}</td>
                    <td>${tenagaKerja[i].jumlah}</td>
                    `
                );
        }
    } else {
        $("#tableTenagaKerja")
            .find("tbody")
            .html(
                "<tr><td colspan='2' class='text-center'>Tidak ada tenaga kerja</td></tr>"
            );
    }
}

function checkCatatan() {
    const val = $('input[type="radio"]:checked').val();
    if (val == "1") {
        $("#catatan").removeAttr("required");
    } else {
        $("#catatan").attr("required", "required");
    }
}
