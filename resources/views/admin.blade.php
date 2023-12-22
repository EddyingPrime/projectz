
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Your existing styles for body, container, header, etc. */

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
            font-weight: bold;
        }

        nav a:hover {
            background-color: #555;
        }
    </style>
    <!-- Add your additional stylesheets and scripts here -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Panel</h1>
            <!-- Add any header content as needed -->
        </header>

        <nav>
            <a href="#">Home</a>
            <a href="#">Games</a>
            <a href="#">Reservations</a>
            <a href="#">Login</a>
            <a href="#">Register</a>
            <!-- Add more navigation links as needed -->
        </nav>

        <main>
            @yield('content')
            <!-- The content section will be filled by child views -->
        </main>

        <footer>
            &copy; 2023 Admin Panel
            <!-- Add footer content as needed -->
        </footer>
    </div>
    <!-- Add your scripts and other footer elements here -->
</body>
</html>
