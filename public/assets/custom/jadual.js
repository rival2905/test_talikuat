let massPopChart;
async function nonAdendum(res) {
    console.log(res);
    let dataUmum = res.data_umum;
    let spmk = new Date(dataUmum.tgl_spmk);
    let weeks = sortDateAsWeek(getTermin(dataUmum.detail.lama_waktu), spmk);
    let jadualAwal = await sortJadual(res.curva, weeks);
    render(jadualAwal, [], "", weeks);
    jadualAwal = [];
}
const dataJadualGlobal = [];

function render(sumJadual, laporan, jadualAdendum, jmlMinggu) {
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
            tension: 0.1,
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
        <div class="col-sm-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Klik Untuk Melihat Detail Jadual">
        <a href="#" style="color:black;" data-bs-toggle="modal" data-bs-target="#jadualDetail" onclick="renderDetailJadual(${i})">
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
    });
}

const sortJadual = async (jadual, weeks) => {
    const dataJadual = [];
    const arr = Object.values(jadual);
    const sortedJadual = [];
    const sumJadual = [];

    $(arr).each((i, v) => {
        $(v).each((index, value) => {
            dataJadual.push(value);
        });
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
        console.log(v);
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
        <td>${formatRupiah(v.harga_satuan_rp ?? v.harga_satuan, "Rp. ")}</td>
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
    var number_string = angka.toString().replace(/[^,\d]/g, ""),
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
    $('[data-bs-toggle="tooltip"]').tooltip();
});
