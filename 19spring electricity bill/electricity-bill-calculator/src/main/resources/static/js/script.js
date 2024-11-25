$(document).ready(function () {
    $("#billForm").on("submit", function (e) {
        let units = $("#units").val();
        if (units < 0) {
            alert("Units consumed cannot be negative.");
            e.preventDefault();
        }
    });
});
