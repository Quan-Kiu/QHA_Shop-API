$(function () {
    "use strict";
    $("#signupForm").validate({
        submitHandler: function (form) {
            this.preventDefault();
            alert("hello");
        },
    });
    $(function () {
        $("#signupForm").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 6,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password",
                },
                email: {
                    required: true,
                    email: true,
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2,
                },
                agree: "required",
            },
            messages: {
                fullname: {
                    required: "Please enter fullname",
                    minlength: "Fullname must consist of at least 6 characters",
                },
                password: {
                    required: "Please provide a password",
                    minlength:
                        "Your password must be at least 6 characters long",
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength:
                        "Your password must be at least 6 characters long",
                    equalTo: "Please enter the same password as above",
                },
                email: "Please enter a valid email address",
            },
            errorPlacement: function (label, element) {
                label.addClass("mt-2 text-danger");
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass("has-danger");
                $(element).addClass("form-control-danger");
            },
        });
    });
});
