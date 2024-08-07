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
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70" style="background-color: #ebeff2">
    <nav class="navbar navbar-expand-lg navbar-light bg-ligcoht sticky-top">
        <a class="navbar-brand" href="#" style="margin-left:10%">Navbar</a>
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
            style="background-image: url(' ../asset/stethoscope.jpeg'); background-size: cover; width: 100%; height: 90vh;">
            <div class="container" style="padding-top: 17%">
                <h1>Welcome to the Hackathon</h1>
                <form class="mt-4" id="search-form" method="GET" action="{{ route('search') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" name="query"
                            placeholder="You can search here: hospital, doctor, or disease" aria-label="Search">
                        <div class="input-group-append d-flex align-items-center">
                            <select class="form-select-lg ml-2" id="categorySelect" name="category">
                                <option value="Hospital">Hospital</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Disease">Disease</option>
                            </select>
                            <button class="btn btn-primary btn-lg ml-2 btn-search" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<div class="card">
    <section id="list">
        <div class="container">
            <h2>Data that you have searched for</h2>
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

    <!-- <section id="list">
        <div class="container">
            <h2>List</h2>
            <p>This is the list section.</p>
            {{-- @if (isset($data))
                <ul>
                    @foreach ($data as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            @endif --}}
        </div>
    </section> -->

    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>


    <script>
        document.body.setAttribute('data-bs-spy', 'scroll');
        document.body.setAttribute('data-bs-target', '.navbar');
        document.body.setAttribute('data-bs-offset', '70');
    </script>
</body>

</html>

<script src="{{ asset('admin/home.js') }}" type="text/javascript"></script>
