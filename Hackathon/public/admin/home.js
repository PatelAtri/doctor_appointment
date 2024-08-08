$(document).ready(function() {
    addClickEvents();
});

function addClickEvents() {
    $(document).on('click', '.btn-search', function(event) {
        event.preventDefault();
        var form = $('#search-form');
        $.ajax({
            method: 'GET',
            url: window.location.origin + '/search',
            data: form.serialize(),
            success: function(res) {
                $('#list').show();

                if(res.status) {
                    if ($.fn.DataTable.isDataTable('#hospital-datatable')) {
                        $('#hospital-datatable').DataTable().clear().destroy();
                    }

                    var hospitalDatatable = $('#hospital-datatable').DataTable({
                        processing: true,
                        stateSave: true,
                        lengthMenu: [[10, 50, 100, 500, 1000, -1], [10, 50, 100, 500, 1000, "All"]],
                        "data" : res.data,
                        "columns" : [
                            {
                                data: "id",
                                orderable: true,
                                searchable: true,
                                // className: ,
                            },
                            {
                                data: "doctor_name",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "hospital_name",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "disease_name",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "address",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "status",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "doctor_contact_no",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: "hospital_contact_no",
                                orderable: true,
                                searchable: true,
                            },
                            {
                                data: null,
                                orderable: true,
                                searchable: true,
                                render: function(data, type, row) {
                                    var bookAppointment = '<button class="btn btn-md btn-primary appointment" title="Delete" data-hospital-id="' + row.id + '">Appointment</button>';
                                    return bookAppointment;
                                }
                            },
                        ]
                    })
                }
            }
        });
    });

    $(document).on('click', '.appointment', function() {
        $('#loginModal').modal('show');
    });

    $(document).on('click', '.signup-btn', function() {
        $('#signUpModal').modal('show');
    });

    $(document).on('click', '.login-btn', function (event) {
        event.preventDefault();
        if (validateForm()) {
            $('#login-form').submit();
        } else {
            $('.required').each(function () {
                var fieldValue = $(this).val();
                if (!fieldValue) {
                    $(this).next('.error-message').text('Please fill out this field.');
                } else {
                    $(this).next('.error-message').text('');
                }
            });
        }
    });

    $("#login-form").submit(function (event) {
        var form = $(this);
        event.preventDefault();
        var formData = form.serialize();
        var password = form.find('input[name="password"]').val();
        if (password.length < 8) {
            $('#error-password').text('Enter password of length min 8');
            return false;
        }
        console.log(window.location.origin + '/login');
 
        $.ajax({
            method: form.attr('method'),
            url: window.location.origin + '/login',
            data: formData,
            success: function (res) {
                console.log(res);
                $('.error-message').text('');
                if(res.status) {
                    $('#loginModal').modal('hide');
                    $('#appointmentModal').modal('show');
                } else {
                    $('#signup-first').text("Welcome! It looks like you're visiting us for the first time. Please sign up to create an account before logging in.");
                }
                $('#discounts-table').DataTable().ajax.reload();
            },
            error: function () {
                // swal('', 'Discount not saved.', 'error');
            }
        });
    });
}

function validateForm() {
    var isValid = true;
    $('#login-form .required').each(function () {
        if ($(this).val() === '') {
            isValid = false;
        }
    });
    return isValid;
}