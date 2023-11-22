
$('#cancelForm').validate({
    rules: {
        reason: {
            required: true,
        },
        custom_reason: {
            required: true,
        },
    },
});
// hide reason if custom reason is there  
$(document).ready(function() {
    $('#collaspe_btn').change(function() {
        if ($(this).is(':checked')) {
            $('#reason').prop('disabled', true);
        } else {
            $('#reason').prop('disabled', false);
        }
    });
});

