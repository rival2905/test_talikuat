var uptd = $("#uptd").val();
const today = new Date();
const nextWeek = new Date(today);
nextWeek.setDate(nextWeek.getDate() + 7);
$("#date-start").val(today.toISOString().slice(0, 10));
$("#date-end").val(nextWeek.toISOString().slice(0, 10));
$("#status").text("Status : " + $("#date").val());

$("#date").change(() => {
    $("#status").text("Status : " + $("#date").val());
    $("tbody").empty();
    render();
});

$("#uptd").change(() => {
    uptd = $("#uptd").val();
    if (uptd == "all") {
        $("#unor").text(
            "SEMUA UNIT PELAKSANA TEKNIS DINAS (UPTD) WILAYAH PELAYANAN"
        );
    } else {
        $("#unor").text(
            "UNIT PELAKSANA TEKNIS DINAS (UPTD) WILAYAH PELAYANAN  - " +
                convertNumbertoRomawi(uptd - 1)
        );
    }
    $("tbody").empty();
    $("body").addClass("loading");
    render();
});
$(document).ready(() => {
    $("body").removeClass("loading");
    $("#unor").text(
        "UNIT PELAKSANA TEKNIS DINAS (UPTD) WILAYAH PELAYANAN  - " +
            convertNumbertoRomawi(uptd - 1)
    );
    render();
});
async function render() {
    $.post(apiUrl, { uptd: uptd }, (res) => {
        const data = res.data;
        console.log(data);
        let no = 1;
        for (let i = 0; i < data.length; i++) {
            let minggu = diffDate(data[i].tgl_spmk, $("#date").val());
            var keterangan =
                data[i].laporan_konsultan[minggu - 1] == undefined
                    ? `Laporan Minggu Ke ${minggu} Belum Diupload`
                    : "";
            const rencana = getRencana(data[i], minggu);

            const realisasi = getRealisasi(data[i], minggu);

            var deviasiText = getDeviasi(rencana, realisasi);
            var paketIsDone = checkTglSpmk(
                data[i].tgl_spmk,
                data[i].detail_with_jadual.lama_waktu - 1
            );
            $("tbody").append(
                "<tr>" +
                    "<td>" +
                    no +
                    "</td>" +
                    '<td style="text-align:left;">' +
                    data[i].nm_paket +
                    "</td>" +
                    "<td>" +
                    data[i].detail_with_jadual.panjang_km +
                    "</td>" +
                    '<td style="text-align:left;">' +
                    data[i].detail_with_jadual.kontraktor.nama +
                    "</td>" +
                    "<td>" +
                    data[i].tgl_spmk +
                    "<br/>" +
                    new Date(data[i].tgl_spmk)
                        .addDays(data[i].detail_with_jadual.lama_waktu - 1)
                        .toISOString()
                        .substring(0, 10) +
                    "</td>" +
                    "<td>" +
                    data[i].detail_with_jadual.lama_waktu +
                    " Hari" +
                    "</td>" +
                    '<td style="text-align:left;">1. ' +
                    data[i].detail_with_jadual.nilai_kontrak +
                    "<br/>2. " +
                    data[i].tgl_kontrak +
                    "<br/>3.<br/>4. </td>" +
                    '<td style="text-align:left;">' +
                    data[i].detail_with_jadual.konsultan.name +
                    "<br/>" +
                    "<strong>Site Engineer</strong>" +
                    "<br/>" +
                    data[i].detail_with_jadual.konsultan.se +
                    "</td>" +
                    "<td>" +
                    minggu +
                    "</td>" +
                    "<td>" +
                    data[i].detail_with_jadual.jadualDetail.toFixed(2) +
                    "</td>" +
                    "<td>" +
                    realisasi +
                    "</td>" +
                    "<td>" +
                    deviasiText +
                    "</td>" +
                    `<td>${
                        paketIsDone == 100
                            ? "Paket Pekerjaan Sudah Selesai"
                            : ""
                    }</td></tr>`
            );

            //${paketIsDone ? keterangan : ""}

            tenagaAhli = "";
            no++;
        }
        $("body").removeClass("loading");
    });
}

function convertNumbertoRomawi(number) {
    var romawi = ["I", "II", "III", "IV", "V", "VI"];

    return romawi[number];
}
Date.prototype.addDays = function (days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
};
function diffDate(tglSpmk, now) {
    const date1 = new Date(tglSpmk);
    const date2 = new Date(now);
    const result = Math.abs(date1 - date2);
    const day = Math.ceil(result / (1000 * 60 * 60 * 24));
    return parseInt(day / 7) + 1;
}

function getDeviasi(rencana, realisasi) {
    var val = (rencana - realisasi).toFixed(3);
    if (val.includes("-")) {
        return `<span style="color:green;">${val.replace("-", "+")}</span>`;
    } else if (val == "0.000") {
        return `<span style="color:green;">${val}</span>`;
    } else {
        return `<span style="color:red;">-${val}</span>`;
    }
}

function checkTglSpmk(spmk, jmlHari) {
    const date1 = new Date(spmk).addDays(jmlHari);
    const date2 = new Date();
    return date1.getTime() > date2.getTime();
}

function getRencana(data, minggu) {
    if (data.laporan_uptd_aproved.length == 0) {
        return 0;
    } else {
        return data.laporan_uptd_aproved[minggu - 1] == undefined
            ? data.laporan_uptd_aproved.at(-1).rencana
            : data.laporan_uptd_aproved[minggu - 1].rencana;
    }
}

function getRealisasi(data, minggu) {
    if (data.laporan_uptd_aproved.length == 0) {
        return 0;
    } else {
        return data.laporan_uptd_aproved[minggu - 1] == undefined
            ? data.laporan_uptd_aproved.at(-1).realisasi
            : data.laporan_uptd_aproved[minggu - 1].realisasi;
    }
}
