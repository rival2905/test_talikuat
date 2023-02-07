let massPopChart;
async function nonAdendum(res) {
    const dataUmum = res;
    console.log(dataUmum);
    const spmk = new Date(dataUmum.tgl_spmk);
    const weeks = sortDateAsWeek(getTermin(dataUmum.detail.lama_waktu), spmk);
    const jadualAwal = await sortJadual(
        dataUmum.jadual_details.jadual_items_details,
        weeks
    );
    const laporan = sortLaporan(dataUmum.laporan_approved, weeks.length);
    const rencanaKonsultan = dataUmum.laporan_konsultan.map((v) => v.rencana);
    const realisasiKonsultan = dataUmum.laporan_konsultan.map(
        (v) => v.realisasi
    );
    render(
        jadualAwal,
        laporan,
        "",
        weeks,
        rencanaKonsultan,
        realisasiKonsultan
    );
}
var dataJadualGlobal = [];

function render(
    sumJadual,
    laporan,
    jadualAdendum,
    jmlMinggu,
    rencanaKonsultan,
    realisasiKonsultan
) {
    $("body").removeClass("loading");
    const minggu = [];
    for (let i = 0; i < jmlMinggu.length; i++) {
        minggu.push("Minggu Ke " + [i + 1]);
    }
    let chart = $("#chartCurva");
    const datasets = [
        {
            label: "Rencana",
            data: sumJadual,
            fill: false,
            borderColor: "#005eff",
        },
        {
            label: "Realisasi",
            data: laporan,
            fill: false,
            borderColor: "#ff0000",
        },
        {
            label: "Rencana Konsultan",
            data: rencanaKonsultan,
            fill: false,
            borderColor: "#fbff00",
        },
        {
            label: "Realisasi Konsultan",
            data: realisasiKonsultan,
            fill: false,
            borderColor: "#09ff00",
        },
    ];

    massPopChart = new Chart(chart, {
        type: "line",
        data: {
            labels: minggu,
            datasets,
        },
        options: {},
    });
    $(jmlMinggu).each((i, v) => {
        $("#dataJadual").append(`
        <div class="col-sm-2" data-toggle="tooltip" data-placement="top" title="Klik Untuk Melihat Detail Jadual">
        <a href="#" style="color:black;" data-toggle="modal" data-target="#jadualDetail" onclick="renderDetailJadual(${i})">
        <div class="border p-2 m-1">
        <p>
        ${convertDate(jmlMinggu[i]).toISOString().slice(0, 10)} / ${convertDate(
            jmlMinggu[i]
        )
            .addDays(6)
            .toISOString()
            .slice(0, 10)} </p> 
           ${sumJadual[i]}
        </div>
        </a>
    </div>
    `);
        $("#dataRealisasi").append(`
    <div class="col-sm-2" data-toggle="tooltip" data-placement="top" title="Klik Untuk Melihat Detail Realisasi">
    <div class="border p-2 m-1">
    <p>
    ${convertDate(jmlMinggu[i]).toISOString().slice(0, 10)} / ${convertDate(
            jmlMinggu[i]
        )
            .addDays(6)
            .toISOString()
            .slice(0, 10)} </p>
        ${laporan[i] == undefined ? 0 : laporan[i]}
    </div>
    </div>
    `);
    });
}

const sortJadual = async (jadual, weeks) => {
    const dataJadual = [];
    const arr = Object.values(jadual);
    const sortedJadual = [];
    const sumJadual = [];

    $(arr).each((i, v) => {
        dataJadual.push(...v.detail);
    });
    for (let i = 0; i < weeks.length; i++) {
        const tesData = dataJadual.filter((v) => {
            return (
                v.tanggal >= convertDate(weeks[i]).toISOString().slice(0, 10) &&
                v.tanggal <=
                    convertDate(weeks[i]).addDays(6).toISOString().slice(0, 10)
            );
        });
        sortedJadual.push(tesData);
    }
    console.log(sortedJadual);
    dataJadualGlobal.push(sortedJadual);
    $(sortedJadual).each((i, v) => {
        sumJadual.push(v.sum("nilai"));
    });
    const sumCumulative = sumJadual.map(cumulativeSum);
    for (let i = 0; i < sumCumulative.length; i++) {
        sumCumulative[i] = parseFloat(sumCumulative[i]).toFixed(3);
    }

    return sumCumulative;
};

// get minggu
function getTermin(hari) {
    let minggu = hari / 7;
    return Number.isInteger(minggu) ? minggu : parseInt(minggu + 1);
}
// get date from weeks
function sortDateAsWeek(week, spmk) {
    let u = 0;
    let tglWeek = [];
    for (let i = 0; i < week; i++) {
        if (tglWeek.length == 0) {
            tglWeek.push(spmk.toISOString().slice(0, 10));
            //tglWeek.push(date.addDays(8).toISOString().slice(0, 10));
        } else {
            tglWeek.push(
                convertDate(tglWeek[u]).addDays(7).toISOString().slice(0, 10)
            );
            u++;
        }
    }
    return tglWeek;
}
function sortLaporan(laporan, weeks) {
    const arr = Object.values(laporan);
    const sumLaporan = Array(weeks).fill(0);

    $(arr).each((i, v) => {
        sumLaporan[v.minggu_ke - 1] += parseFloat(v.volume);
    });
    $(sumLaporan).each((i, v) => {
        sumLaporan[i] = parseFloat(v).toFixed(3);
    });
    for (let i = sumLaporan.length - 1; i >= 1; i--) {
        if (sumLaporan[i] == sumLaporan[i - 1]) {
            sumLaporan.splice(i, 1);
        } else {
            break;
        }
    }
    return sumLaporan;
}

Date.prototype.addDays = function (days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
};
function convertDate(date) {
    return new Date(date);
}
const cumulativeSum = (
    (sum) => (value) =>
        (sum += value)
)(0);
const tes = (
    (sum) => (value) =>
        (sum += value)
)(0);
const laporanSum = (
    (sum) => (value) =>
        (sum += value)
)(0);
Array.prototype.sum = function (prop) {
    var total = 0;
    for (var i = 0, _len = this.length; i < _len; i++) {
        total += parseFloat(this[i][prop], 0);
    }

    return total;
};
// function createVariables(jmlAdendum) {
//   var adendum = [];

//   for (var i = 0; i < jmlAdendum; ++i) {
//     adendum[i] = [];
//   }

//   return adendum;
// }
function getRandomColor() {
    var color = [
        "#f6ff00",
        "#00ff08",
        "#ff00e6",
        "#ff9100",
        "#7a7a7a",
        "#00ffb7",
        "#de691b",
    ];
    return color;
}

function renderDetailJadual(index) {
    const data = dataJadualGlobal[0][index];
    $("#jadualDetail table").DataTable().destroy();
    $("#jadualDetail table tbody").empty();
    data.forEach((v, i) => {
        if (v == undefined) {
            $("#jadualDetail").find("tbody").append(`
            <tr>
           <td>
            Tidak Ada Jadual
            </td>
            </tr>
            `);
        } else {
            $("#jadualDetail").find("tbody").append(`
        <tr>
        <td>${v.tanggal}</td>
        <td>${v.nmp + " - " + v.uraian}</td>
        <td>${formatRupiah(v.harga_satuan, "Rp. ")}</td>
        <td>${v.volume}</td>
        <td>${v.satuan}</td>
        <td>${v.bobot}</td>
        <td>${v.koefisien}</td>
        </tr>
        `);
        }
    });
    $("#jadualDetail table").DataTable().draw();
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
