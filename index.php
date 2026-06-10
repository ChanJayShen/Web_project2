<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home page" />
    <meta name="keywords" content="Openings, Our studio" />
    <meta name="author" content="Adam Faris" />
    <style>
        .studio {
            width: 300px;
            /* Increase this number to make it bigger */
            height: 250px;
            /* Keeps the proportions perfect */
        }
    </style>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>GameX Studios | Game Dev Careers</title>
    <link href="layout.css" rel="stylesheet">
</head>


<body class="index_bg">


    <div class="site-container">

        <header>
            <div class="header-content">
                <a href="index.html" class="logo-link">
                    <img src="images/Logo.png" alt="GameX Studios Logo" class="logo">
                </a>
            </div>

            <nav aria-label="Main Navigation">
                <ul class="nav-menu">
                    <li><a href="index.php" aria-current="page">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="jobs.php">Job Positions</a></li>
                    <li><a href="apply.php">Job Application</a></li>
                </ul>
            </nav>
        </header>



        <section class="hero">
            <video autoplay muted loop playsinline preload="auto" poster="images/video-fallback.jpg" id="bg-video">
                <source src="images/Freefire.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="hero-text">
                <h1>Shape the Future of Play</h1>
                <p>Join Kuala Lumpur's leading game studio in building the next generation of RPGs.</p>
                <a href="jobs.html" class="cta-button">View Openings</a>
            </div>
        </section>

        <section class="company-intro">
            <div class="text-block">
                <h2>About Our Studio</h2>
                <p class="about_studio para">
                    GameX Studios is an innovative game development studio currently expanding our core tech team.
                    We specialize in building immersive, high-performance experiences that push the boundaries
                    of digital content creation.
                </p>
                <a href="index.html" class="logo-link">
                    <img src="images/studio.png" alt="Small game studio" class="studio">
                    <div class="brand-text">GameX Studios</div>
                </a>
            </div>
        </section>

        <?php include('footer.inc'); ?>

    </div>
</body>

</html>