$(document).ready(function () {
    console.log("jQuery loaded and DOM is ready!");
    $("#createLeadForm").on("submit", function (e) {
        let isValid = true;

        const name = $("#name").val().trim();
        const email = $("#email").val().trim();
        const phone = $("#phone").val().trim();

        $(".is-invalid").removeClass("is-invalid");
        $(".invalid-feedback.dynamic").remove();

        if (name === "") {
            showError("#name", "Name is required");
            isValid = false;
        } else if (name.length < 3){
            showError("#name", "Name must be at least 3 characters long.");
            isValid = false;
        } else if (name.length > 255) {
            showError("#name", "Name cannot exceed 255 characters.");
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showError("#email", "Valid email is required.");
            isValid = false;
        } else if (email.length > 255) {
            showError("#email", "Email cannot exceed 255 characters.");
            isValid = false;
        }

        const phoneRegex = /^\+?[0-9]{1,4}?[-. ]?\(?[0-9]{1,3}?\)?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/;
        if (!phoneRegex.test(phone)) {
            showError("#phone", "Please enter a valid phone number jsjsj.");
            isValid = false;
        } else if (phone.length > 20) {
            showError("#phone", "Phone must be max 20 characters and valid format");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(selector, message) {
        $(selector).addClass("is-invalid");
        const feedback = $(
            `<div class="invalid-feedback dynamic"><i class="bi bi-exclamation-circle me-1"></i>${message}</div>`
        );
        $(selector).after(feedback);
    }
});
