function addRow(idTable) {
    var table;
    switch (idTable) {
        case "tableBahanMaterial":
            table = document.getElementById("tableBahanMaterial");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML =
                '<div class="col"><input class="form-control" type="text" name="bahan_material[]" /></div>';
            cell2.innerHTML =
                '<div class="col"><input class="form-control" type="number" name="volume_bahan[]" step="0.001" /></div>';
            cell3.innerHTML =
                '<div class="col"><input class="form-control" type="text" name="satuan_bahan[]" /></div>';

            break;
        case "peralatan":
            table = document.getElementById("peralatan");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML =
                '<div class="col"><input class="form-control" type="text" name="jenis_peralatan[]" /></div>';
            cell2.innerHTML =
                '<div class="col"><input class="form-control" type="number" name="jumlah_peralatan[]" step="0.001" /></div>';
            break;

        case "bahanHotmix":
            table = document.getElementById("bahanHotmix");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);

            cell1.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="bahan_hotmix[]"
            />
            </div>`;

            cell2.innerHTML = `<div class="col">
                <input
                    class="form-control"
                    type="text"
                    name="no_dump_truck[]"
                />
            </div>`;
            cell3.innerHTML = `<div class="col">
                <input
                    class="form-control"
                    type="text"
                    name="waktu_datang[]"
                />
            </div>`;
            cell4.innerHTML = `<div class="col">
                <input
                    class="form-control"
                    type="text"
                    name="waktu_hampar[]"
                />
            </div>`;
            cell5.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="suhu_datang[]"
            />
             </div>`;
            cell6.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="suhu_hampar[]"
            />
            </div>`;
            cell7.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="p_m[]"
            />
            </div>`;
            cell8.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="l_m[]"
            />
             </div>`;
            cell9.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="t_gembur_m[]"
            />
            </div>`;
            break;
        case "bahanBetonReadyMix":
            table = document.getElementById("bahanBetonReadyMix");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = `<div class="col">
                <input
                    class="form-control"
                    type="text"
                    name="bahan_beton_ready_mix[]"
                />
            </div>`;
            cell2.innerHTML = `<div class="col">
                <input
                    class="form-control"
                    type="text"
                    name="no_truck_mixer[]"
                />
            </div>`;
            cell3.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="waktu_datang[]"
            />
        </div>`;
            cell4.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="waktu_curah[]"
            />
        </div>`;
            cell5.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="slump_test[]"
            />
        </div>`;
            cell6.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="satuan_beton[]"
            />
        </div>`;
            break;
        case "tenagaKerja":
            table = document.getElementById("tenagaKerja");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);

            cell1.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="tenaga_kerja[]"
            />
             </div>`;
            cell2.innerHTML = `<div class="col">
            <input
                class="form-control"
                type="text"
                name="jumlah[]"
            />
            </div>`;
            break;
    }
}
function removeRow(idTable) {
    var table;
    var rowDelete;
    switch (idTable) {
        case "tableBahanMaterial":
            table = $("#tableBahanMaterial tr");
            rowDelete = $("#tableBahanMaterial tr:last");
            break;

        case "peralatan":
            table = $("#peralatan tr");
            rowDelete = $("#peralatan tr:last");
            break;
        case "bahanHotmix":
            table = $("#bahanHotmix tr");
            rowDelete = $("#bahanHotmix tr:last");
            break;
        case "bahanBetonReadyMix":
            table = $("#bahanBetonReadyMix tr");
            rowDelete = $("#bahanBetonReadyMix tr:last");
            break;
        case "tenagaKerja":
            table = $("#tenagaKerja tr");
            rowDelete = $("#tenagaKerja tr:last");
            break;
    }

    if (table.length > 2) {
        rowDelete.remove();
    }
}
