// validation 
$('#parentCatAdd').validate({
    rules: {
        name: {
            required: true,
        },
        status: {
            required: true,
        },
    },
    messages: {
        name: {
            required: "This  field is required",
        },
        status: {
            required: "This  field is required",
        },

    },
});

// img require validation
document.getElementById("parentCatAdd").addEventListener("submit", function (event) {
    var fileInput = document.getElementById("imageUpload");
    var file = fileInput.files[0];

    if (!file) {
        $('.image-error').text("This field is required");
        event.preventDefault();
        fileInput.setCustomValidity("Please select an image.");
    } else {
        $('.image-error').text(" ");

        fileInput.setCustomValidity("");
    }
});

// img previw 
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});