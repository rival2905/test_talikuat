(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on(
            "input keydown keyup mousedown mouseup select contextmenu drop",
            function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(
                        this.oldSelectionStart,
                        this.oldSelectionEnd
                    );
                } else {
                    this.value = "";
                }
            }
        );
    };
})(jQuery);
$(document).ready(function () {
    $("#tlp").inputFilter(function (value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
    $("#nik").inputFilter(function (value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
    $("#norek").inputFilter(function (value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
    $("#konsultan").hide();
    $("#kontraktor").hide();
});

function render(val) {
    switch (val) {
        case "ADMIN-UPTD":
            $("#team").hide();
            $("#konsultan").hide();
            $("#kontraktor").hide();
            $("#unor").show();
            disableRequired("#kontraktor");
            disableRequired("#konsultan");
            setRequiredSelect("#unor");
            break;
        case "PPK":
            $("#team").hide();
            $("#konsultan").hide();
            $("#kontraktor").hide();
            $("#unor").show();
            disableRequired("#kontraktor");
            disableRequired("#konsultan");
            setRequiredSelect("#unor");

            break;
        case "KONSULTAN":
            $("#team").show();
            $("#konsultan").show();
            $("#kontraktor").hide();
            $("#unor").hide();
            setRequired("#konsultan");
            disableRequiredSelect("#unor");
            break;
        case "KONTRAKTOR":
            $("#kontraktor").show();
            $("#konsultan").hide();
            $("#unor").show();
            $("#team").hide();
            setRequired("#kontraktor");
            disableRequired("#konsultan");
            setRequiredSelect("#unor");
            break;
    }
}

function removeErr(id, err) {
    $("" + id + "").removeClass("err");
    $("" + err + "").hide();
}
function setRequired(div) {
    $("" + div + "" + " :input").attr("required", true);
}
function disableRequired(div) {
    $("" + div + "" + " :input").attr("required", false);
}
function disableRequiredSelect(div) {
    $("" + div + "" + " select").attr("required", false);
}
function setRequiredSelect(div) {
    $("" + div + "" + " select").attr("required", true);
}
