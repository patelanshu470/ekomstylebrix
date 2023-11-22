$(document).ready(function () {
    $('#video-input').on('change', function () {
        const selectedFile = this.files[0];
        const maxSizeMB = 10;
        if (selectedFile) {
            if (selectedFile.type.indexOf('video/') === 0) {
                if (selectedFile.size <= maxSizeMB * 1024 * 1024) {
                    $('#video-error').text('');
                } else {
                    $('#video-error').text('Video size should be less than ' + maxSizeMB + 'MB.');
                    this.value = '';
                }
            } else {
                $('#video-error').text('Please select a valid video file.');
                this.value = '';
            }
        }
    });
});

// for return form validation
$('#returnForm').validate({
    rules: {
        reason: {
            required: true,
        },
        custom_reason: {
            required: true,
        },
        attachement: {
            required: true,
        },
    },
});
// hide reason if custom reason is there  
$(document).ready(function () {
    $('#return_collaspe_btn').change(function () {
        if ($(this).is(':checked')) {
            $('#return_reason').prop('disabled', true);
        } else {
            $('#return_reason').prop('disabled', false);
        }
    });
});