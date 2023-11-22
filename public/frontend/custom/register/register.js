$('#registrationForm').validate({
rules: {
    name: {
        required: true,
    },
    email: {
        required: true,
    },
    password: {
        required: true,
    },
    term_condition: {
        required: true,
    },
    mobile: {
        required: true,
        minlength: 10,
        maxlength: 14,
    },
},
});    