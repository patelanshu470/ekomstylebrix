$('#parentCatAdd').validate({
    rules: {
        name: {
            required: true,
        },
        status: {
            required: true,
        },
        cat_id: {
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
        cat_id: {
            required: "This  field is required",
        },
    },
});