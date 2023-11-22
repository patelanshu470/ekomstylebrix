// image validation  banner-1
    $.validator.addMethod(
        "url",
        function(value, element) {
            var urlPattern =
                /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
            return this.optional(element) || urlPattern.test(value);
        },
        "Please enter a valid URL."
    );
    $('#banner1formAdd').validate({
        rules: {
            link: {
                required: true,
                url: true,
            },
            short_desc: {
                required: true,
            },
            special_text: {
                required: true,
            },
            header_text: {
                required: true,
            },
            type: {
                required: true,
            },
        },
    });
    $('#banner1formEdit').validate({
        rules: {
            link: {
                required: true,
                url: true,
            },
            short_desc: {
                required: true,
            },
            special_text: {
                required: true,
            },
            header_text: {
                required: true,
            },
            type: {
                required: true,
            },
        },
    });
    document.getElementById("banner1formAdd").addEventListener("submit", function(event) {
        var fileInput = document.getElementById("imageUpload1");
        var file = fileInput.files[0];
        if (!file) {
            $('.thumbnail-error').text("This field is required");
            event.preventDefault();
            fileInput.setCustomValidity("Please select an image.");
        } else {
            $('.thumbnail-error').text(" ");
            fileInput.setCustomValidity("");
        }
    });
//    banner1 end

// banner 3
$.validator.addMethod(
    "url",
    function(value, element) {
        var urlPattern =
            /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
        return this.optional(element) || urlPattern.test(value);
    },
    "Please enter a valid URL."
);
$('#banner3formAdd').validate({
    rules: {
        link: {
            required: true,
            url: true,
        },
        short_desc: {
            required: true,
        },
        special_text: {
            required: true,
        },
        header_text: {
            required: true,
        },
        type: {
            required: true,
        },
    },
});
$('#banner3formEdit').validate({
    rules: {
        link: {
            required: true,
            url: true,
        },
        short_desc: {
            required: true,
        },
        special_text: {
            required: true,
        },
        header_text: {
            required: true,
        },
        type: {
            required: true,
        },
    },

});
document.getElementById("banner3formAdd").addEventListener("submit", function(event) {
    var fileInput = document.getElementById("imageUpload3");
    var file = fileInput.files[0];
    if (!file) {
        $('.banner3-error').text("This field is required");
        event.preventDefault();
        fileInput.setCustomValidity("Please select an image.");
    } else {
        $('.banner3-error').text(" ");
        fileInput.setCustomValidity("");
    }
}); 
// end 

// img preview 

