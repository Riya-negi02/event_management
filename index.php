<!DOCTYPE html>
<html>
<head>
    <title>Event Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: linear-gradient(90deg, #c084fc, #f9a8d4);
            color: white;
        }

        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* HERO SECTION */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 60px;
            flex-wrap: wrap;
        }

        .hero-text {
            flex: 1;
            min-width: 300px;
        }

        .hero-text h1 {
            font-size: 40px;
            color: #7b2cbf;
        }

        .hero-text p {
            margin: 15px 0;
            color: #555;
        }

        .hero-buttons a {
            padding: 12px 20px;
            margin-right: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            background: linear-gradient(90deg, #c084fc, #f9a8d4);
        }

        /* IMAGE SIDE */
        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-image img {
            width: 90%;
            max-width: 400px;
        }

        /* FEATURES */
        .features {
            display: flex;
            justify-content: space-around;
            margin: 50px 20px;
            flex-wrap: wrap;
        }

        .feature-card {
            width: 250px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(128, 90, 213, 0.15);
            text-align: center;
            margin: 10px;
        }
    </style>
    
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>🎉 EVENT MANAGEMENT SYSTEM</h2>
    
</div>

<!-- HERO SECTION -->
<div class="hero">

    <!-- LEFT SIDE TEXT -->
    <div class="hero-text">
        <h1>Manage Events Easily</h1>
        <p>Discover, register, and manage events with a simple and elegant platform.</p>
        <br><br>
        <div class="hero-buttons">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
    </div>

    <!-- RIGHT SIDE IMAGE -->
    <div class="hero-image">
        <img src="event.png" alt="Event Illustration">
    </div>

</div>

<!-- FEATURES -->
<div class="features">
    <div class="feature-card">
        <h3>📅 View Events</h3>
        <p>Browse all upcoming events easily.</p>
    </div>

    <div class="feature-card">
        <h3>📝 Register</h3>
        <p>Register for events in one click.</p>
    </div>

    <div class="feature-card">
        <h3>👨‍💼 Admin Control</h3>
        <p>Admins can manage events.</p>
    </div>
</div>

</body>
</html>