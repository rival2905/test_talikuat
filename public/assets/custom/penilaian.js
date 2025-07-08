var tableA = 4;
var tableB = 17;
var tableC = 6;
var tableD = 6;
let bobotA, bobotB, bobotC, bobotD;
var colom = 0;
const indicatorA = [
    "Pengajuan Jadwal Pelaksanaan Pekerjaan sesuai dengan jadwal",
    "Pengajuan laporan Kajian Teknis sesuai dengan jadwal",
    "Pengajuan Program Mutu sesuai dengan jadwal",
    "Pelaksanaan Mobilisasi sesuai dengan jadwal",
];
const indicatorB = [
    "Pengajuan Shop Drawing sesuai dengan jadwal",
    "Pengajuan uji bahan sesuai dengan jadwal",
    "Pengajuan Request sesuai dengan jadwal",
    "Jumlah dan kualifikasi pekerja sesuai dengan Request",
    "Jumlah, Jenis, dan kapasitas alat sesuai dengan Request",
    "Kualitas dan kuantitas pasokan bahan sesuai dengan Request",
    "Volume hasil pekerjaan sesuai dengan target",
    "Tidak terjadi masalah pada peralatan",
    "Tidak terjadi masalah dalam penyediaan bahan",
    "Tidak terjadi perbaikan pekerjaan akibat kegagalan hasil pekerjaan atau uji hasil pekerjaan tidak memenuhi syarat",
    "Kelengkapan K3 untuk pekerja Terpenuhi",
    "Pengendalian Lalu Lintas terpenuhi",
    "Tidak terjadi kecelakaan kerja",
    "Tidak menerima surat teguran berkaitan dengan pelaksanaan pekerjaan",
    "Sosialisasi/Pemberitahuan ke lingkungan sekitar pekerjaan dilakukan",
    "Tidak ada Komplain/Permasalahan dengan Lingkungan sekitar",
    "Progres Item Pekerjaan tidak mengalami keterlambatan",
];
const indicatorC = [
    "Progres Pekerjaan Tidak mengalami keterlambatan",
    "Tidak dalam kontrak kritis",
    "Pengajuan Laporan Harian sesuai dengan jadwal",
    "Pengajuan Back Up Kualitas sesuai dengan jadwal",
    "Pengajuan Back Up Kuantitas sesuai dengan jadwal",
    "Pengajuan MC sesuai dengan jadwal",
];
const indicatorD = [
    "Tidak melewati masa pelaksanaan",
    "Tidak terjadi perubahan signifikan antara kuantitas hasil Kajian Teknis dengan kuantitas akhir",
    "Pengajuan As Built Drawing sesuai dengan jadwal",
    "Pengajuan Pernyataan Akhir pekerjaan (lengkap dengan back up) sesuai dengan jadwal",
    "Pengajuan Jaminan Pemeliharaan Sesuai jadwal",
    "Pengajuan Jadwal Pemeliharaan sesuai jadwal",
];

$(document).ready(() => {
    $el = $(document).find("input[name=bobot]");
    colom = $el.length;
    if ($("#disableAll").val() == "disable") {
        bobotB = newRefeshBobot(tableB);
        bobotC = newRefeshBobot(tableC);
        bobotD = newRefeshBobot(tableD);
        $("input[name=bobot_b]").val(bobotB.toFixed(2));
        $("input[name=bobot_c]").val(bobotC.toFixed(2));
        $("input[name=bobot_d]").val(bobotD.toFixed(2));
        getValue("tableB", "B");
        getValue("tableC", "C");
        getValue("tableD", "D");
    } else {
        bobotA = refeshBobot(tableA);
        bobotB = refeshBobot(tableB);
        bobotC = refeshBobot(tableC);
        bobotD = refeshBobot(tableD);
        $("input[name=bobot_a]").val(bobotA.toFixed(2));
        $("input[name=bobot_b]").val(bobotB.toFixed(2));
        $("input[name=bobot_c]").val(bobotC.toFixed(2));
        $("input[name=bobot_d]").val(bobotD.toFixed(2));
    }

    $.each($el, (i, v) => {
        v.checked = true;
    });
});

//get count collom checked
function countColom(el, parent, index) {
    switch (parent) {
        case "A":
            el ? tableA++ && colom++ : tableA-- && colom--;
            bobotA = refeshBobot(tableA);
            bobotB = refeshBobot(tableB);
            bobotC = refeshBobot(tableC);
            bobotD = refeshBobot(tableD);
            $("input[name=bobot_a]").val(bobotA.toFixed(2));
            $("input[name=bobot_b]").val(bobotB.toFixed(2));
            $("input[name=bobot_c]").val(bobotC.toFixed(2));
            $("input[name=bobot_d]").val(bobotD.toFixed(2));
            getValue("tableA", "A");
            getValue("tableB", "B");
            getValue("tableC", "C");
            getValue("tableD", "D");
            el
                ? $(`input[name='text_a${index}']`).val(indicatorA[index - 1])
                : $(`input[name='text_a${index}']`).val("");
            break;

        case "B":
            el ? tableB++ && colom++ : tableB-- && colom--;
            if ($("#disableAll").val() == "disable") {
                bobotB = newRefeshBobot(tableB);
                bobotC = newRefeshBobot(tableC);
                bobotD = newRefeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            } else {
                bobotA = refeshBobot(tableA);
                $("input[name=bobot_a]").val(bobotA.toFixed(2));
                getValue("tableA", "A");
                bobotB = refeshBobot(tableB);
                bobotC = refeshBobot(tableC);
                bobotD = refeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            }
            el
                ? $(`input[name='text_b${index}']`).val(indicatorB[index - 1])
                : $(`input[name='text_b${index}']`).val("");
            break;
        case "C":
            el ? tableC++ && colom++ : tableC-- && colom--;
            if ($("#disableAll").val() == "disable") {
                bobotB = newRefeshBobot(tableB);
                bobotC = newRefeshBobot(tableC);
                bobotD = newRefeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            } else {
                bobotA = refeshBobot(tableA);
                $("input[name=bobot_a]").val(bobotA.toFixed(2));
                getValue("tableA", "A");

                bobotB = refeshBobot(tableB);
                bobotC = refeshBobot(tableC);
                bobotD = refeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            }
            el
                ? $(`input[name='text_c${index}']`).val(indicatorC[index - 1])
                : $(`input[name='text_c${index}']`).val("");

            break;
        case "D":
            el ? tableD++ && colom++ : tableD-- && colom--;
            if ($("#disableAll").val() == "disable") {
                bobotB = newRefeshBobot(tableB);
                bobotC = newRefeshBobot(tableC);
                bobotD = newRefeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            } else {
                bobotA = refeshBobot(tableA);
                $("input[name=bobot_a]").val(bobotA.toFixed(2));
                getValue("tableA", "A");
                bobotB = refeshBobot(tableB);
                bobotC = refeshBobot(tableC);
                bobotD = refeshBobot(tableD);
                $("input[name=bobot_b]").val(bobotB.toFixed(2));
                $("input[name=bobot_c]").val(bobotC.toFixed(2));
                $("input[name=bobot_d]").val(bobotD.toFixed(2));
                getValue("tableB", "B");
                getValue("tableC", "C");
                getValue("tableD", "D");
            }
            el
                ? $(`input[name='text_d${index}']`).val(indicatorD[index - 1])
                : $(`input[name='text_d${index}']`).val("");
            break;
    }
}

function getValue(el, table) {
    switch (table) {
        case "A":
            if (el == "tableA") {
                const element = $(`#${el}`).find("input[type=radio]:checked");
                $.each(element, (i, v) => {
                    const parent = $(v).parent().parent().parent().parent();

                    const value =
                        $(v).val() == "ya" ? getNilai("A", tableA) : 0;
                    if (parent.find("input[type=checkbox]").is(":checked")) {
                        parent.find("input[type=text]").val(value.toFixed(2));
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(value);
                        totalNilaiTable(parent);
                    } else {
                        parent.find("input[type=text]").val(0);
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(0);
                        totalNilaiTable(parent);
                    }
                });
            } else {
                const element = $(el).parent().parent().parent().parent();
                if (element.find("input[type=checkbox]").is(":checked")) {
                    const value = el.value == "ya" ? getNilai("A", tableA) : 0;
                    element.find("input[type=text]").val(value.toFixed(2));
                    element
                        .find("input[type='hidden'][class='temp']")
                        .val(value);
                    totalNilaiTable(element);
                }
            }

            break;
        case "B":
            if (el == "tableB") {
                const element = $(`#${el}`).find("input[type=radio]:checked");
                $.each(element, (i, v) => {
                    const parent = $(v).parent().parent().parent().parent();
                    const value =
                        $(v).val() == "ya" ? getNilai("B", tableB) : 0;
                    if (parent.find("input[type=checkbox]").is(":checked")) {
                        parent.find("input[type=text]").val(value.toFixed(2));
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(value);
                        totalNilaiTable(parent);
                    } else {
                        parent.find("input[type=text]").val(0);
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(0);
                        totalNilaiTable(parent);
                    }
                });
            } else {
                const element = $(el).parent().parent().parent().parent();
                if (element.find("input[type=checkbox]").is(":checked")) {
                    const value = el.value == "ya" ? getNilai("B", tableB) : 0;
                    element.find("input[type=text]").val(value.toFixed(2));
                    element
                        .find("input[type='hidden'][class='temp']")
                        .val(value);

                    totalNilaiTable(element);
                }
            }

            break;
        case "C":
            if (el == "tableC") {
                const element = $(`#${el}`).find("input[type=radio]:checked");
                $.each(element, (i, v) => {
                    const parent = $(v).parent().parent().parent().parent();
                    const value =
                        $(v).val() == "ya" ? getNilai("C", tableC) : 0;
                    if (parent.find("input[type=checkbox]").is(":checked")) {
                        parent.find("input[type=text]").val(value.toFixed(2));
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(value);
                        totalNilaiTable(parent);
                    } else {
                        parent.find("input[type=text]").val(0);
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(0);
                        totalNilaiTable(parent);
                    }
                });
            } else {
                const element = $(el).parent().parent().parent().parent();
                if (element.find("input[type=checkbox]").is(":checked")) {
                    const value = el.value == "ya" ? getNilai("C", tableC) : 0;
                    element.find("input[type=text]").val(value.toFixed(2));
                    element
                        .find("input[type='hidden'][class='temp']")
                        .val(value);
                    totalNilaiTable(element);
                }
            }

            break;
        case "D":
            if (el == "tableD") {
                const element = $(`#${el}`).find("input[type=radio]:checked");
                $.each(element, (i, v) => {
                    const parent = $(v).parent().parent().parent().parent();
                    const value =
                        $(v).val() == "ya" ? getNilai("D", tableD) : 0;
                    if (parent.find("input[type=checkbox]").is(":checked")) {
                        parent.find("input[type=text]").val(value.toFixed(2));
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(value);
                        totalNilaiTable(parent);
                    } else {
                        parent.find("input[type=text]").val(0);
                        parent
                            .find("input[type='hidden'][class='temp']")
                            .val(0);
                        totalNilaiTable(parent);
                    }
                });
            } else {
                const element = $(el).parent().parent().parent().parent();
                if (element.find("input[type=checkbox]").is(":checked")) {
                    const value = el.value == "ya" ? getNilai("D", tableD) : 0;
                    element.find("input[type=text]").val(value.toFixed(2));
                    element
                        .find("input[type='hidden'][class='temp']")
                        .val(value);
                    totalNilaiTable(element);
                }
            }

            break;
    }
}

//refesh bobot
function refeshBobot(table) {
    let bobot = (100 / colom) * table;
    return bobot;
}
function newRefeshBobot(table) {
    let newbobot = (100 / colom) * table;
    return newbobot;
}

//get nilai from bobot
function getNilai(table, valueTable) {
    let bobot;
    switch (table) {
        case "A":
            bobot = bobotA;
            break;

        case "B":
            bobot = bobotB;
            break;
        case "C":
            bobot = bobotC;
            break;
        case "D":
            bobot = bobotD;
            break;
    }
    return bobot / valueTable;
}

function totalNilaiTable(el) {
    let sum = 0.0;
    $value = $(el).parent().find("input[type='hidden'][class='temp']");
    $.each($value, (i, v) => {
        let nilai = v.value == "" ? 0 : v.value;
        sum += parseFloat(nilai);
    });
    $(el)
        .parent()
        .find("input[type='text'][name*='total']")
        .val(sum.toFixed(2));
}
$("#submit").on("click", () => {
    ajaxPost($(this));
});

function ajaxPost(element) {
    var form = $("#penilaianForm");
    var data = $(form).serialize();
    $.ajax({
        type: "POST",
        url: "https://tk.temanjabar.net/api/penilaian/penyedia",
        //url: "http://tk.-api.test/api/penilaian/penyedia",
        data: data,
        cache: false,
        beforeSend: function () {
            $("#loader").modal("show");
        },
        success: function (res) {
            window.location = "laporan_harian.php?sukses=simpan-data";
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr, ajaxOptions, thrownError);
        },
        complete: function () {
            $("#loader").modal("hide");
        },
    });
}
