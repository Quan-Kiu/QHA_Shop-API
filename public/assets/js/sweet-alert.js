$(function () {
    showSwal = function (type, data, cb) {
        "use strict";
        if (type === "basic") {
            swal.fire({
                text: "Any fool can use a computer",
                confirmButtonText: "Close",
                confirmButtonClass: "btn btn-danger",
            });
        } else if (type === "title-and-text") {
            Swal.fire(
                "The Internet?",
                "That thing is still around?",
                "question"
            );
        } else if (type === "title-icon-text-footer") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: data.error,
                footer: "<a href='http://fb.com/quankiugl' >Liên hệ ADMIN ngay</a>",
            });
        } else if (type === "custom-html") {
            Swal.fire({
                title: "<strong>HTML <u>example</u></strong>",
                icon: "info",
                html:
                    "You can use <b>bold text</b>, " +
                    '<a href="//github.com">links</a> ' +
                    "and other HTML tags",
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                confirmButtonAriaLabel: "Thumbs up, great!",
                cancelButtonText: '<i data-feather="thumbs-up"></i>',
                cancelButtonAriaLabel: "Thumbs down",
            });
            feather.replace();
        } else if (type === "custom-position") {
            Swal.fire({
                position: "center",
                icon: "success",
                title: data.title,
                showConfirmButton: false,
                timer: 1500,
            });
        } else if (type === "passing-parameter-execute-cancel") {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "ml-2",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.value) {
                        swalWithBootstrapButtons.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            "Cancelled",
                            "Your imaginary file is safe :)",
                            "error"
                        );
                    }
                });
        } else if (type === "message-with-auto-close") {
            let timerInterval;
            Swal.fire({
                title: data.title,
                html: `Vui lòng chờ vài giây.`,
                timer: data.timer,
                willOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log("I was closed by the timer");
                }
            });
        } else if (type === "chaining-modals") {
            Swal.mixin({
                input: "text",
                confirmButtonText: "Next &rarr;",
                showCancelButton: true,
                progressSteps: ["1", "2", "3"],
            })
                .queue([
                    {
                        title: "Question 1",
                        text: "Chaining swal2 modals is easy",
                    },
                    "Question 2",
                    "Question 3",
                ])
                .then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: "All done!",
                            html:
                                "Your answers: <pre><code>" +
                                JSON.stringify(result.value) +
                                "</code></pre>",
                            confirmButtonText: "Lovely!",
                        });
                    }
                });
        } else if (type === "dynamic-queue") {
            const ipAPI = "https://api.ipify.org?format=json";
            Swal.queue([
                {
                    title: "Your public IP",
                    confirmButtonText: "Show my public IP",
                    text:
                        "Your public IP will be received " + "via AJAX request",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return fetch(ipAPI)
                            .then((response) => response.json())
                            .then((data) => Swal.insertQueueStep(data.ip))
                            .catch(() => {
                                Swal.insertQueueStep({
                                    icon: "error",
                                    title: "Unable to get your public IP",
                                });
                            });
                    },
                },
            ]);
        } else if (type === "mixin") {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1113000,
            });

            Toast.fire({
                icon: "success",
                title: "Signed in successfully",
            });
        }
    };
});
