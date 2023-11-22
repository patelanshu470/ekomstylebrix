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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});