     // discount will be upto 100% 
     $(document).ready(function() {
        $('#discount').on('input', function() {
            var val = parseInt($(this).val(), 10);
            if (isNaN(val) || val < 0) {
                $(this).val(0);
            } else if (val > 100) {
                $(this).val(100);
            }
        });
    });
// end 

// img and validation 
$('#banner4formAdd').validate({
    rules: {
        expiry_date: {
            required: true,
        },
        coupon_code: {
            required: true,
        },
        discount: {
            required: true,
        },
        header_text: {
            required: true,
        },
    },
});
document.getElementById("banner4formAdd").addEventListener("submit", function(event) {
    var fileInput = document.getElementById("imageUpload4");
    var file = fileInput.files[0];
    if (!file) {
        $('.banner4-error').text("This field is required");
        event.preventDefault();
        fileInput.setCustomValidity("Please select an image.");
    } else {
        $('.banner4-error').text(" ");
        fileInput.setCustomValidity("");
    }
});
// end 

// img preview 
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
$("#imageUpload4").change(function() {
    readURL(this, 'banner4');
});

// end 