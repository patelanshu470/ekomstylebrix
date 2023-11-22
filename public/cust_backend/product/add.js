
// text area
$('textarea#tiny').tinymce({
    height: 300,
    Width: 300,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic backcolor | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | removeformat | help'
});
// end

// auto discount calculate
// $(document).ready(function () {
//     $('#discount').on('input', function () {
//         var val = parseInt($(this).val(), 10);
//         if (isNaN(val) || val < 0) {
//             $(this).val(0);
//         } else if (val > 100) {
//             $(this).val(100);
//         }
//     });
// });
$(document).ready(function () {
    $('#discount').on('input', function () {
        var val = $(this).val().trim();
        if (val === '') {
            // Only replace with 0 if the input is empty
            $(this).val('');
        } else {
            var numVal = parseInt(val, 10);
            if (isNaN(numVal) || numVal < 0) {
                $(this).val(0);
            } else if (numVal > 100) {
                $(this).val(100);
            }
        }
    });
});
$('#discount,#sellPrice').on('keyup', function (e) {
    var sp = $('#sellPrice').val();
    $('#finalSellPrice').val(sp);
    var discount = $('#discount').val();
    var final = sp * discount / 100;
    f_final = sp - final;
    $('#finalSellPrice').val(f_final.toFixed(0));
    return false;
});
// end

// product gallay validation
$(document).ready(function () {
    // $("body").on("click", "#action-icon", function (evt) {
    //     var fileUpload = $("#images");
    //     if (parseInt(fileUpload.get(0).files.length) > 4) {
    //         $('#error_product_galary').slideUp("slow");
    //         $('#submit_btn').attr('disabled', false);
    //     } else {
    //         $('#error_product_galary').slideDown("slow");
    //         $('#submit_btn').attr('disabled', true);
    //     }
    //     if (parseInt(fileUpload.get(0).files.length) == 1) {
    //         $('#image_preview').css('display', 'none');
    //     }
    // });
    // $("#images").change(function (e) {
    //     var fileUpload = $("#images");
    //     if (parseInt(fileUpload.get(0).files.length) > 3) {
    //         $('#error_product_galary').slideUp("slow");
    //         $('#submit_btn').attr('disabled', false);
    //     } else {
    //         $('#submit_btn').attr('disabled', true);
    //     }
    //     if (parseInt(fileUpload.get(0).files.length) > 0) {
    //         $('#image_preview').css('display', '');
    //     }
    // });
});
// end

// tooltips
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
// end
$(document).ready(function () {
    const toggleButton = $("#toggle-button");
    const generalTabContent = $("#pills-home");
    toggleButton.on("click", function () {
        generalTabContent.toggleClass("show active");
    });
});
// slug
$('#productName').keyup(function () {
    var name = $(this).val();
    var final_name = name.toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
    $('#productSlug').val(final_name);
});
// end slug


// multi image select preview
$(document).ready(function() {
    var fileArr = [];
    $("#images").change(function() {
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];
        $("#image_preview").html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 10485760) {
                return false;
            } else {
                fileArr.push(total_file[i]);
                $("#image_preview").append(
                    "<div class='img-div' id='img-div" +
                    i +
                    "'><img src='" +
                    URL.createObjectURL(event.target.files[i]) +
                    "' class='img-responsive image img-thumbnail' title='" +
                    total_file[i].name +
                    "'><div class='middle'><button id='action-icon' value='img-div" +
                    i +
                    "' class='btn btn-danger' role='" +
                    total_file[i].name +
                    "'><i class='fa fa-trash'></i></button></div></div>"
                );
            }
        }
    });
    $("body").on("click", "#action-icon", function(evt) {
        var divName = this.value;
        var fileName = $(this).attr("role");
        $(`#${divName}`).remove();

        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
            }
        }
        document.getElementById("images").files = FileListItem(fileArr);
        evt.preventDefault();
    });

    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        for (var c, b = (c = file.length), d = !0; b-- && d;)
            d = file[b] instanceof File;
        if (!d)
            throw new TypeError(
                "expected argument to FileList is File or array of File objects"
            );
        for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
            b.items.add(file[c]);
        return b.files;
    }
});
// end


// form validation
$('#productAdd').validate({
    rules: {
        name: {
            required: true,
        },
        status: {
            required: true,
        },
        quantity: {
            required: true,
        },
        final_sell_price: {
            required: true,
        },
        sell_price: {
            required: true,
        },

        cost_price: {
            required: true,
        },
        sub_cat_id: {
            required: true,
        },
        cat_id: {
            required: true,
        },
        size: {
            required: true,
        },
        color: {
            required: true,
        },
        thumbnail: {
            required: true,
        },
        color_image: {
            required: true,
        },
        sub_cat_id: {
            required: true,
        },
        cat_id: {
            required: true,
        },
        description: {
            required: true,
        },

        "gallary[]": {
            required: true,
        },
        "varient_ids[]": {
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
        quantity: {
            required: "This  field is required",
        },
        final_sell_price: {
            required: "This  field is required",
        },
        sell_price: {
            required: "This  field is required",
        },

        cost_price: {
            required: "This  field is required",
        },
        sub_cat_id: {
            required: "This  field is required",
        },
        cat_id: {
            required: "This  field is required",
        },

        size: {
            required: "This  field is required",
        },

        color: {
            required: "This  field is required",
        },
        thumbnail: {
            required: "This  field is required",
        },
        color_image: {
            required: "This  field is required",
        },
        sub_cat_id: {
            required: "This  field is required",
        },
        cat_id: {
            required: "This  field is required",
        },
        description: {
            required: "This  field is required",
        },
        "gallary[]": {
            required: "This  field is required",
        },
        "varient_ids[]": {
            required: "This  field is required",
        },
    },
});

document.getElementById("productAdd").addEventListener("submit", function(event) {
    var fileInput = document.getElementById("imageUpload1");
    var color_image = document.getElementById("imageUpload2");

    var file = fileInput.files[0];
    var color_file = color_image.files[0];
    if (!file) {
        $('.thumbnail-error').text("This field is required");
        event.preventDefault();
        fileInput.setCustomValidity("Please select an image.");
    } else {
        $('.thumbnail-error').text(" ");
        fileInput.setCustomValidity("");
    }

    if (!color_file) {
        $('.color-error').text("This field is required");
        event.preventDefault();
        fileInput.setCustomValidity("Please select an image.");
    } else {
        $('.color-error').text(" ");
        fileInput.setCustomValidity("");
    }

});
// only number validate
$('#costPrice').on('input', function(event) {
    this.value = this.value.replace(/[^0-9,+]/g, '');
});
$('#discount').on('input', function(event) {
    this.value = this.value.replace(/[^0-9,+]/g, '');
});
$('#sellPrice').on('input', function(event) {
    this.value = this.value.replace(/[^0-9,+]/g, '');
});
$('#quantity').on('input', function(event) {
    this.value = this.value.replace(/[^0-9,+]/g, '');
});
$('#finalSellPrice').on('input', function(event) {
    this.value = this.value.replace(/[^0-9,+]/g, '');
});
// end

// thumbnail preview
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
$("#imageUpload1").change(function() {
    readURL(this, 'imagePreview1');
});
$("#imageUpload2").change(function() {
    readURL(this, 'imagePreview2');
});
// end
