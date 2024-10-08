$(document).ready(function() {
    addClickEvents();

    $('#spinner').show();
    $('#loginModal').on('hidden.bs.modal', function () {
        $(this).find('input[type="email"], input[type="password"]').val('');
        $('.error-message').text('');
        $('#signup-first').text('');
        $('.signup-appear').hide();
    });

    $('#signUpModal').on('hidden.bs.modal', function () {
        $(this).find('input[type="email"], input[type="password"], input[type="text"]').val('');
        $('.error-message').text('');
    });

    $('#appointmentModal').on('hidden.bs.modal', function () {
        $(this).find('input[type="text"], input[type="password"]').val('');
        $('.error-message').text('');
    });

    $(document).on('input', '.required', function() {
        var fieldValue = $(this).val();
        if (fieldValue) {
            $(this).next('.error-message').text('');
        } else {
            $(this).next('.error-message').text('Please fill out this field.');
        }
    });

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
                                orderable: false,
                                searchable: true,
                                render: function(data, type, row) {
                                    var bookAppointment = '<button class="btn btn-md btn-primary appointment" title="Delete" data-hospital-id="' + row.id + '">Appointment</button>';
                                    return bookAppointment;
                                }
                            },
                        ]
                    });
                }
                $('#spinner').hide();
            }
        });
    });

    $(document).on('click', '.appointment', function() {
        var hospitalId = $(this).data('hospital-id');
        $('#loginModal').modal('show');
        $('#loginModal').find('.login-btn').data('hospital-id', hospitalId);
        $('#loginModal').find('.signup-appear').data('hospital-id', hospitalId);    
    });

    $(document).on('click', '.signup-appear', function() {
        var hospitalId = $(this).data('hospital-id');
        $('#loginModal').modal('hide');
        $('#signUpModal').modal('show');
        $('#signUpModal').find('.signup-btn').data('hospital-id', hospitalId);
    });

    $(document).on('click', '.login-btn', function (event) {
        event.preventDefault();
        validateAndSubmitForm('#login-form');
    });

    $(document).on('click', '.signup-btn', function (event) {
        event.preventDefault();
        validateAndSubmitForm('#signup-form');
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
         var hospitalId = $('#loginModal').find('.login-btn').data('hospital-id');
        $.ajax({
            method: form.attr('method'),
            url: window.location.origin + '/login',
            data: formData,
            success: function (res) {
                $('.error-message').text('');
                if(res.status) {
                    $('#loginModal').modal('hide');
                    var userId = res.userId;
                    bookAppointmentModalFunction(hospitalId, userId);
                    $('#appointmentModal').modal('show');
                } else {
                    $('#signup-first').text("Welcome! It looks like you're visiting us for the first time. Please sign up to create an account before logging in.");
                    $('.signup-appear').show();
                }
                $('#discounts-table').DataTable().ajax.reload();
            },
            error: function () {
                // swal('', 'Discount not saved.', 'error');
            }
        });
    });

    $("#signup-form").submit(function (event) {
        var form = $(this);
        event.preventDefault();
        var formData = form.serialize();
        var password = form.find('input[name="password"]').val();
        if (password.length < 8) {
            $('#error-password').text('Enter password of length min 8');
            return false;
        }

        var hospitalId = $('#signUpModal').find('.signup-btn').data('hospital-id');
        $.ajax({
            method: 'POST',
            url: window.location.origin + '/signup',
            data: formData,
            success: function (res) {
                $('.error-message').text('');
                if(res.status) {
                    $('#signUpModal').modal('hide');
                    bookAppointmentModalFunction(hospitalId);
                    $('#appointmentModal').modal('show');
                } else {
                }
                $('#discounts-table').DataTable().ajax.reload();
            },
            error: function () {
                // swal('', 'Discount not saved.', 'error');
            }
        });
    });

    $(document).on('click', '.book-appointment-btn', function (event) {
        var form = $('#appointment-form');
        var userId = form.find('#user_id').text();
        var hospitalId = form.find('#hospital_id').text();

        var data = {};
        data.userId = userId;
        data.hospitalId = hospitalId;
        data._token = form.find('input[name="_token"]').val();
        data.formData = form.serialize();
        Swal.fire({
            title: 'Info',
            text: 'Wait until you get message',
            icon: 'info',
            timer: 2000,
            showConfirmButton: false
        });

        $.ajax({
            method: 'POST',
            url: window.location.origin + '/book-appointment',
            data: data,
            success: function (res) {
                $('.error-message').text('');
                if (res.status) {
                    $('#appointmentModal').modal('hide');
                    Swal.fire({
                        title: 'Success!',
                        text: 'Appointment booked successfully!',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to book the appointment.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
                $('#discounts-table').DataTable().ajax.reload();
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while booking the appointment.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
}

function bookAppointmentModalFunction (hospitalId, userId) {
    var data = {};
    data.hospitalId = hospitalId;
    $.ajax({
        method: 'GET',
        url: window.location.origin + '/doctor-data',
        data: data,
        success: function (res) {
            if(res.status) {
            var p = $('#appointmentModal').find('#appointment-form');
            p.find('#user_id').text(userId);
            p.find('#hospital_id').text(res.data.id);
            p.find('#doctor_name').text(res.data.doctor_name);
            p.find('#hospital_name').text(res.data.hospital_name);
            p.find('#disease_name').text(res.data.disease_name);
            p.find('#address').text(res.data.address);
            p.find('#doctor_contact_no').text(res.data.doctor_contact_no);
            p.find('#hospital_contact_no').text(res.data.hospital_contact_no);
            } else {
            }
        },
        error: function () {
            // swal('', 'Discount not saved.', 'error');
        }
    });
}

function validateAndSubmitForm(formSelector) {
    var isValid = true;
    $(formSelector + ' .required').each(function () {
        if ($(this).val() === '') {
            isValid = false;
            $(this).next('.error-message').text('Please fill out this field.');
        }
    });

    if (isValid) {
        $(formSelector).submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const appointmentDate = document.getElementById('appointment_date');
    const appointmentTime = document.getElementById('appointment_time');

    // Disable past dates
    const today = new Date().toISOString().split('T')[0];
    appointmentDate.setAttribute('min', today);

    // Generate time options with half-hour intervals
    function generateTimeOptions() {
        appointmentTime.innerHTML = '';

        const startTime = new Date();
        startTime.setHours(0, 0, 0, 0);
        const endTime = new Date();
        endTime.setHours(23, 30, 0, 0);

        const selectedDate = new Date(appointmentDate.value);
        const now = new Date();

        if (selectedDate.toDateString() === now.toDateString()) {
            startTime.setHours(now.getHours());
            startTime.setMinutes(now.getMinutes() < 30 ? 30 : 0);
            if (now.getMinutes() >= 30) startTime.setHours(now.getHours() + 1);
        }

        while (startTime <= endTime) {
            const option = document.createElement('option');
            option.value = startTime.toTimeString().substring(0, 5);
            option.textContent = startTime.toTimeString().substring(0, 5);
            appointmentTime.appendChild(option);

            startTime.setMinutes(startTime.getMinutes() + 30);
        }
    }
    appointmentDate.addEventListener('change', generateTimeOptions);

    generateTimeOptions();
});
