<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hackathon</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
            color: #fff;
            background-color: #3F7496;
            border-radius: 5px;
        }

        .nav-link.active {
            color: #3F7496;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70" style="background-color: #ebeff2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <a class="navbar-brand" href="#" style="margin-left:10%">
            <img src="{{ asset('asset/logo.jpeg') }}" alt="logo" style="width:80px; height: 50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
        <div style="background-image: url('../asset/optional1.jpeg'); background-size: cover; width: 100%; height: 90vh;">
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
                                    <input type="text" class="form-control" name="query" placeholder="Search: hospital, doctor, or disease" aria-label="Search">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <select class="form-select form-select-sm" id="categorySelect" name="category">
                                        <option value="Hospital">Hospital</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Disease">Disease</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-search" style="background-color: #FEAF3A">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="card">
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
    </div>

    <div style="margin-top: 15px">
        <div style="margin-left: 37%">ONLINE APPOINTMENT SCHEDULING PLATFORM</div>
        <div style="margin-left: 30%">Online Appointment, Phone-in Appointment, Walk-in Appointment with Token</div>
        <img src="{{ asset('asset/middlepicture.jpeg') }}" alt="logo" style="width: 100%">
    </div>

    <section id="contact" style="background-color: #3F7496; padding: 40px; color: white">
        <div class="container">
            <h2>Contact Us</h2>
            <p>We’re here to help! Reach out to us through any of the following methods, and we’ll get back to you as soon as possible:</p>
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <h3>Contact Details</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><strong>Email:</strong> <a href="mailto:support@example.com" style="color: white">support@example.com</a></li>
                        <li><strong>Phone:</strong> <a href="tel:+1234567890" style="color: white">+1 (234) 567-890</a></li>
                        <li><strong>Office Address:</strong> 123 Main Street, Suite 456, City, Country, 78901</li>
                        <li><strong>Office Hours:</strong> Mon-Fri, 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3>Follow Us</h3>
                    <p>Stay updated by following us on social media:</p>
                    <a href="https://facebook.com/example" target="_blank"><i class="fab fa-facebook" style="margin: 10px 10px 10px 10px; color:white"></i></a>
                    <a href="https://twitter.com/example" target="_blank"><i class="fab fa-twitter" style="margin: 10px 10px 10px 10px; color:white"></i></a>
                    <a href="https://instagram.com/example" target="_blank"><i class="fab fa-instagram" style="margin: 10px 10px 10px 10px; color:white"></i></a>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h3>About Us</h3>
                    <p>We are committed to providing the best service and support. Our team is dedicated to ensuring customer satisfaction and addressing your needs promptly. Learn more about our mission and values on our <a href="/about-us" style="color: white">About Us</a> page.</p>
                </div>
            </div>
            <div style="margin:40px 0 0 35%">Copyright © 2024 All Rights Reserved</div>
        </div>
    </section>


    <script>
        document.body.setAttribute('data-bs-spy', 'scroll');
        document.body.setAttribute('data-bs-target', '.navbar');
        document.body.setAttribute('data-bs-offset', '70');
    </script>
    <script src="{{ asset('admin/home.js') }}" type="text/javascript"></script>
</body>
</html>
