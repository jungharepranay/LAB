$(document).ready(function () {
    $('#billForm').submit(function (e) {
        e.preventDefault();
        const units = $('#units').val();

        $.post('/calculate', { units }, function (data) {
            if (data.error) {
                $('#result').html(`<div class="alert alert-danger">${data.error}</div>`);
            } else {
                $('#result').html(`<div class="alert alert-success">Your electricity bill is: ₹${data.bill}</div>`);
            }
        });
    });
});
