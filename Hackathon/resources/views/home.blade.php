<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        body {
            position: relative;
        }

        #contact {
            margin-top: 100px;
        }

        #list {
            display: none;
        }

        .card {
            background-color: white;
            margin: 10px;
            padding: 2px;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            font-size: 1.1rem;
            padding: 10px 15px;
            margin: 0 10px;
            transition: color 0.3s, background-color 0.3s;
        }

        .nav-link:hover {
            color: #fff !important;
            background-color: #3F7496;
            border-radius: 5px;
        }

        .nav-link.active {
            color: #3F7496;
            color: white;
            font-weight: bold;
        }

        .error-message {
            color: red
        }

        label.field-required::after {
            content: ' *';
            color: red;
        }

        .signup-appear {
            display: none;
        }

        #spinner {
            display: none;
            text-align: center;
            margin: 20px;
        }

        .info-card {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .info-card p {
            margin: 10px 0;
            padding: 5px 0;
            font-size: 16px;
        }

        .info-card p span {
            font-weight: bold;
            color: #333;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70" style="background-color: #ebeff2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand" href="#" style="margin-left:10%">
            <img src="{{ asset('asset/logo.jpeg') }}" alt="logo" style="width:80px; height: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto">
                <a class="nav-item nav-link active" href="#home">Home<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#list">List</a>
                <a class="nav-item nav-link" href="#contact">Contact Us</a>
            </div>
        </div>
    </nav>

    <section id="home">
        <div
            style="background-image: url('../asset/optional1.jpeg'); background-size: cover; width: 100%; height: 90vh;">
            <div class="container" style="padding-top: 11%; margin-right: 204px;">
                <div style="font-size: 40px; color: #1C3651">APPOINTMENT</div>
                <div style="font-size: 60px; font-weight: 1000; color: #1C3651">BOOK</div>
                <div>Book appointments effortlessly with real-time availability.</div>
                <div>Simplify your scheduling and stay organized—all in just a few clicks.</div>
                <form class="mt-2" id="search-form" method="GET" action="{{ route('search') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="query"
                                        placeholder="Search with name of : hospital, doctor, or disease" aria-label="Search">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <select class="form-select" id="categorySelect" name="category">
                                        <option value="Hospital">Hospital</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Disease">Disease</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary btn-search">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div id="spinner">
        <p>Data searched by you will be displayed here</p>
        <i class="fas fa-refresh fa-spin fa-2x"></i>
    </div>
    <!-- <div class="card"> -->
    <section id="list">
        <div class="container">
            <h2>Data that you have searched</h2>
            <div id="datatable-container">
                <table id="hospital-datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Doctor Name</th>
                            <th>Hospital Name</th>
                            <th>Disease Name</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Doctor contact no</th>
                            <th>Hospital contact no</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="hospital-datatable-body">
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- </div> -->

    <div style="margin-top: 15px">
        <div style="margin-left: 37%">ONLINE APPOINTMENT SCHEDULING PLATFORM</div>
        <div style="margin-left: 30%">Online Appointment, Phone-in Appointment, Walk-in Appointment with Token</div>
        <img src="{{ asset('asset/middlepicture.jpeg') }}" alt="logo" style="width: 100%">
    </div>

    <section id="contact" style="background-color: #3F7496; padding: 40px; color: white">
        <div class="container">
            <h2>Contact Us</h2>
            <p>We’re here to help! Reach out to us through any of the following methods, and we’ll get back to you as
                soon as possible:</p>
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <h3>Contact Details</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><strong>Email:</strong> <a href="mailto:support@example.com"
                                style="color: white">support@example.com</a></li>
                        <li><strong>Phone:</strong> <a href="tel:+1234567890" style="color: white">+1 (234)
                                567-890</a></li>
                        <li><strong>Office Address:</strong> 123 Main Street, Suite 456, City, Country, 78901</li>
                        <li><strong>Office Hours:</strong> Mon-Fri, 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3>Follow Us</h3>
                    <p>Stay updated by following us on social media:</p>
                    <a href="https://facebook.com/example" target="_blank"><i class="fab fa-facebook"
                            style="margin: 10px 10px 10px 10px; color:white"></i></a>
                    <a href="https://twitter.com/example" target="_blank"><i class="fab fa-twitter"
                            style="margin: 10px 10px 10px 10px; color:white"></i></a>
                    <a href="https://instagram.com/example" target="_blank"><i class="fab fa-instagram"
                            style="margin: 10px 10px 10px 10px; color:white"></i></a>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3>About Us</h3>
                    <p>We are committed to providing the best service and support. Our team is dedicated to ensuring
                        customer satisfaction and addressing your needs promptly. Learn more about our mission and
                        values on our <a href="/about-us" style="color: white">About Us</a> page.</p>
                </div>
            </div>
            <div style="margin:40px 0 0 35%">Copyright © 2024 All Rights Reserved</div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="login-form">
                        <!-- <input type="hidden" name="id" class="form-control"> -->
                        <!-- <br> -->
                        <label class="field-required">Email</label>
                        <input type="email" name="email" class="form-control required"
                            placeholder="Enter email id">
                        <span id="error-email" class="error-message"></span><br>

                        <label class="field-required">Password</label>
                        <input type="password" name="password" class="form-control required"
                            placeholder="Enter password">
                        <span id="error-password" class="error-message"></span><br>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- <br> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <p id="signup-first"></p>
                    <button type="button" class="btn btn-md btn-primary signup-appear">Sign up</button>
                    <button type="button" class="btn btn-md btn-primary login-btn">Login</button>
                    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="signup-form">
                        <div class="mb-3">
                            <label for="name" class="form-label field-required">Name</label>
                            <input type="text" class="form-control required" id="name" name="name"
                                placeholder="Enter your name">
                            <span class="error-message" id="error-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label field-required">Email</label>
                            <input type="email" class="form-control required" id="email" name="email"
                                placeholder="Enter your email">
                            <span class="error-message" id="error-email"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label field-required">Password</label>
                            <input type="password" class="form-control required" id="password" name="password"
                                placeholder="Enter your password">
                            <span class="error-message" id="error-password"></span>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label field-required">Address</label>
                            <input type="text" class="form-control required" id="address" name="address"
                                placeholder="Enter your address">
                            <span class="error-message" id="error-address"></span>
                        </div>
                        <div class="mb-3">
                            <label for="user_contact_no" class="form-label field-required">Contact Number</label>
                            <input type="text" class="form-control required" id="user_contact_no"
                                name="user_contact_no" placeholder="Enter your contact number" required>
                            <span class="error-message" id="error-user_contact_no"></span>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-primary signup-btn">Sign Up</button>
                    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Appointment Modal -->
    <div class="modal fade" id="appointmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="appointment-form">
                        
                        <div class="info-card">
                            <p class="hidden"><span id="hospital_id"></span></p>
                            <p class="hidden"><span id="user_id"></span></p>
                            <p><span>Doctor's Name:</span> <span id="doctor_name"></span></p>
                            <p><span>Hospital Name:</span> <span id="hospital_name"></span></p>
                            <p><span>Disease:</span> <span id="disease_name"></span></p>
                            <p><span>Address:</span> <span id="address"></span></p>
                            <p><span>Doctor's Contact No:</span> <span id="doctor_contact_no"></span></p>
                            <p><span>Hospital Contact No:</span> <span id="hospital_contact_no"></span></p>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <label for="appointment_date">Select Appointment Date:</label>
                        <input type="date" id="appointment_date" name="appointment_date" required>
                        <span class="error-message" id="error-appointment_date"></span>

                        <label for="appointment_time">Select Appointment Time:</label>
                        <select id="appointment_time" name="appointment_time" required>
                        </select>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-primary book-appointment-btn">Save Appointment</button>
                    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.body.setAttribute('data-bs-spy', 'scroll');
        document.body.setAttribute('data-bs-target', '.navbar');
        document.body.setAttribute('data-bs-offset', '70');
    </script>
    <script src="{{ asset('admin/home.js') }}" type="text/javascript"></script>
</body>

</html>
