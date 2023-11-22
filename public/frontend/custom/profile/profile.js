// {{-- address validation  --}}
$('#addressForm').validate({
    rules: {
        address: {
            required: true,
        },
        contact_number: {
            required: true,
            contactNumber: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        country: {
            required: true,
        },
        landmark: {
            required: true,
        },
        address_type: {
            required: true,
        },
        pincode: {
            required: true,
            pincode: true
        },
    },
});
// {{-- change password validation  --}}
    $('#changePassword').validate({
        rules: {
            old_password: {
                required: true,
            },
            new_password: {
                required: true,
            },
        },
    });
// {{-- update profile validation  --}}
        $('#updateProfile').validate({
            rules: {
                name: {
                    required: true,
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 14,
                },
            },
        });
// {{-- for selection previous tab after refresh  --}}
    function updateUrlHash(tabId) {
        window.location.hash = tabId;
    }
    function activateTabFromHash() {
        var hash = window.location.hash;
        if (hash) {
            $(`.nav-link[href="${hash}"]`).tab('show');
        }
    }
    $(document).ready(function() {
        activateTabFromHash();
    });
    $('.nav-link').on('click', function(event) {
        var tabId = $(this).attr('href');
        updateUrlHash(tabId);
    });

// image preview 
$(document).ready(function() {
    $("#imageUpload").change(function() {
        readURL(this, 'banner');
    });
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + previewId).css('background-image', 'url(' + e.target.result + ')');
                $('#' + previewId).hide();
                $('#' + previewId).fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
});