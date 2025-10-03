if ($("#category").length > 0) {
    $(function () {
        $("#category").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please provide a valid name.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#mechanic").length > 0) {
    $(function () {
        $("#mechanic").validate({
            rules: {
                fname: "required",
                lname: "required",
                exprince: {
                    required: true,
                    number: true,
                    minlength: 1,
                    maxlength: 5
                },
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                profile: {
                    required: true,  
                },
                preWork: "required",
                email: "required",
                address: "required",
            },
            messages: {
                fname: "Please provide a valid name.",
                lname: "Please provide a valid name.",
                exprince: {
                    required: "Please Enter Exprince.",
                    minlength: "Experince min 1",
                    maxlength: "Experince max 5"
                },
                preWork: "Please provide a valid previous Work Station Name.",
                mobile: {
                    required: "Please Enter Mobile Number.",
                    minlength: "Mobile Number min 10",
                    maxlength: "Mobile Number min 10"
                },
                profile: {
                    required: "Please enter valid profile",
                },
                email: {
                    required: "Please enter mechanic email",
                    minlength: "Please enter a valid email address"
                },

                address: "Please provide a valid address.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#inquiry").length > 0) {
    $(function () {
        $("#inquiry").validate({
            rules: {
                name: "required",
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                email: "required",
                subject: "required",
            },
            messages: {
                name: "Please provide a valid name.",
                mobile: {
                    required: "Please provide a phone number",
                    minlength: "Phone number must be min 10 characters long",
                    maxlength: "Phone number must not be more than 10 characters long"
                },
                email: {
                    required: "Please enter mechanic email",
                    minlength: "Please enter a valid email address"
                },
                subject: "Please provide a valid address.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#service").length > 0) {
    $(function () {
        $("#service").validate({
            rules: {
                name: "required",
                approx_time: {
                    required: true,
                    number: true,
                },
                service_image: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true,
                },
                discription: "required",
            },
            messages: {
                name: "Please provide a valid name.",
                approx_time: {
                    required: "Please provide a Approx Time",
                },
                service_image: {
                    required: "Please Select Service Image",
                },
                price: {
                    required: "Please enter Price",
                },
                discription: "Please provide a valid discription.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#users").length > 0) {
    $(function () {
        $("#users").validate({
            rules: {
                fname: "required",
                lname: "required",
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                email: "required",
                userRadio: {
                    required: true,
                },
                // profile: {
                //     required: true,
                // },
                address: "required",
            },
            messages: {
                fname: "Please provide a valid first name.",
                lname: "Please provide a valid last name.",
                mobile: {
                    required: "Please provide a phone number",
                    minlength: "Phone number must be min 10 characters long",
                    maxlength: "Phone number must not be more than 10 characters long"
                },
                email: {
                    required: "Please enter mechanic email",
                },
                userRadio: {
                    required: "Please Select your Gender",
                },
                // profile: {
                //     required: "Please enter valid profile",
                // },
                address: "Please provide a valid address.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}

function profileValidation() {
    var fileInput = document.getElementById('userProfile');

    var filePath = fileInput.value;

    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    }
    else {
        // Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(
                    'imagePreview').innerHTML =
                    '<img src="' + e.target.result
                    + '" height="100px" width="100px" class="img-fluid pb-3"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

if ($("#logIn").length > 0) {
    $(function () {
        $("#logIn").validate({
            rules: {
                email: "required",
                password: "required",
            },
            messages: {
                email: {
                    required: "Please enter email",
                },
                password: {
                    required: "Please Enter Valid Password",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}

if ($("#contact").length > 0) {
    $(function () {
        $("#contact").validate({
            rules: {
                name: "required",
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                subject: "required",
                message: "required",
            },
            messages: {
                name: "Please provide a valid first name.",
                mobile: {
                    required: "Please provide a phone number",
                    minlength: "Phone number must be min 10 characters long",
                    maxlength: "Phone number must not be more than 10 characters long"
                },
                subject: "Please provide a valid last name.",
                message: "Please provide a valid address.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#contact_detail").length > 0) {
    $(function () {
        $("#contact_detail").validate({
            rules: {
                email_address: "required",
                contact_number: "required",
                address: "required",
            },
            messages: {
                email_address: "Please Enter Email Address.",
                contact_number: "Please Enter Contact Number.",
                address: "Please Enter Address.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#social_media").length > 0) {
    $(function () {
        $("#social_media").validate({
            rules: {
                whatsapp: "required",
                facebook: "required",
                instagram: "required",
            },
            messages: {
                whatsapp: "Please Enter Whatsapp Link.",
                facebook: "Please Enter Facebook Link.",
                instagram: "Please Enter Instagram Link.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}
if ($("#testimonial").length > 0) {
    $(function () {
        $("#testimonial").validate({
            rules: {
                name: "required",
                discription: "required",
            },
            messages: {
                name: "Please provide a valid first name.",
                discription: "Please provide a valid last name.",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
}