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

}