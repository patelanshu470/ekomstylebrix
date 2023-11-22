$('#contactUsForm').validate({
    rules: {
        message: {
            required: true,
        },
        mobile: {
            required: true,
        },
        email: {
            required: true,
        },
        last_name: {
            required: true,
        },
        first_name: {
            required: true,
        },
    },
});