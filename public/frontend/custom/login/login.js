$('#loginForm').validate({
    rules: {
        email: {
            required: true,
        },
        password: {
            required: true,
        },
    },
    messages: {
        email: {
            required: "This email field is required",
        },
        password: {
            required: "This password field is required",
        },
    }
});
