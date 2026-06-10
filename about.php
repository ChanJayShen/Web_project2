<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="About us page" />
  <meta name="keywords" content="Team profile, Member contributions and quotes, Fun facts" />
  <meta name="author" content="Xiao Teng" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link href="layout.css" rel="stylesheet">
  <title>About us</title>
</head>

<body>
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

  <main>
    <!-- Student IDs -->
    <h2 class="student-heading">Student IDs</h2>
    <p class="student-id">Adam Faris – 106225472</p>
    <p class="student-id">Boon Xiao Teng – 106399568</p>
    <p class="student-id">Chan Jay Shen – 106627832</p>
    <p class="student-id">Lau Sheng Meng – J26046158</p>

    <!-- Group Info -->
    <h2>Team Profile</h2>
    <h3> The Connected Random </h3>

    <table class="first_table">
      <thead>
        <tr>
          <th>Day</th>
          <th>Schedule</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Monday</td>
          <td>
            <ul>
              <li>12:00 PM – 2:00 PM
                <ul>
                  <li>Computer System</li>
                </ul>
              </li>
              <li>4:00 PM – 6:00 PM
                <ul>
                  <li>Introduction to Programming</li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Tuesday</td>
          <td>
            <ul>
              <li>8:00 AM – 10:00 AM
                <ul>
                  <li>Mathematic</li>
                </ul>
              </li>
              <li>12:00 PM – 2:00 PM
                <ul>
                  <li>Introduction to Programming</li>
                </ul>
              </li>
              <li>2:00 PM – 4:00 PM
                <ul>
                  <li>Web Technology Project</li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Wednesday</td>
          <td>
            <ul>
              <li>8:00 AM – 10:00 AM
                <ul>
                  <li>Web Technology Project</li>
                </ul>
              </li>
              <li>10:00 AM – 12:00 PM
                <ul>
                  <li>Computer System</li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Thursday</td>
          <td>
            <ul>
              <li>3:00 PM – 6:00 PM
                <ul>
                  <li>Networking and Switching</li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>Friday</td>
          <td>
            <ul>
              <li>8:00 AM – 10:00 AM
                <ul>
                  <li>Mathematic</li>
                </ul>
              </li>
              <li>11:00 AM – 1:00 PM
                <ul>
                  <li>Networking and Switching</li>
                </ul>
              </li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>


    <!-- Member Contributions -->
    <h2>Member Contributions & Quotes</h2>
    <dl>
      <div class="member left div1">
        <img src="images/ad.jpeg" alt="Adam" class="profile-pic">
        <div class="info">
          <dt>Adam Faris</dt>
          <dd>Contribution 1: CSS styling & Section of Company details Page</dd>
          <dd>Contributuin 2: Reuse common UI with PHP includes and manage.php queries </dd>
          <dd>Quote: "The two most important days in your life are the day you are born and the day you find out why"
            -mark twain</dd>
          <dd>First Language: Bahasa Melayu</dd>
        </div>
      </div>

      <div class="member right div2">
        <img src="images/xt.jpeg" alt="xiaoteng" class="profile-pic">
        <div class="info">
          <dt>Xiao Teng</dt>
          <dd>Contribution 1: CSS styling & Section of Team Profile Page</dd>
          <dd>Contribution 2: Database settings and create about table and update about.php</dd>
          <dd>Quote: "Keep calm and carry on"</dd>
          <dd>First Language: Chinese</dd>
        </div>
      </div>

      <div class="member left div3">
        <img src="images/js.jpeg" alt="Jayshen" class="profile-pic">
        <div class="info">
          <dt>Jay Shen</dt>
          <dd>Contribution 1: CSS styling & Section of Job Application form Page</dd>
          <dd>Contribution 2: Create expression of Interest table and add validated records</dd>
          <dd>Quote: "Philippians 4:13 I can do all things through Christ who strengthen me"</dd>
          <dd>First Language: English </dd>
        </div>
      </div>

      <div class="member right div4">
        <img src="images/sh.jpeg" alt="shengmeng" class="profile-pic">
        <div class="info">
          <dt>Sheng Meng</dt>
          <dd>Contribution 1: CSS styling & Section of Job Descriptions page </dd>
          <dd>Contribution 2: Create jobs table and jobs.php</dd>
          <dd>Quote: " I love being interesting"</dd>
          <dd>First Language: Chinese</dd>
        </div>
      </div>
    </dl>

    <!-- Group Photo -->
    <h2>Our Team</h2>
    <figure class="group photo">
      <img src="images/group photos cos10026.jpeg" alt="Group Photo of The Connected Random">
      <figcaption> The Connected Random </figcaption>
    </figure>

    <!-- Fun Facts Table -->
    <h2>Fun Facts</h2>

    <table class="second_table">
      <caption>Team Fun Facts</caption>
      <tr>
        <th>Name</th>
        <th>Dream Job</th>
        <th>Coding Snack</th>
        <th>Hometown</th>
      </tr>
      <tr>
        <td>Adam Faris</td>
        <td>Writer</td>
        <td>Nuts</td>
        <td>Penang</td>
      </tr>
      <tr>
        <td>Xiao Teng</td>
        <td>Entrepreneur</td>
        <td>Biscuit</td>
        <td>Terengganu</td>
      </tr>
      <tr>
        <td>Jay Shen</td>
        <td>Cybersecurity analyst</td>
        <td>Water</td>
        <td>Puchong</td>
      </tr>
      <tr>
        <td>Sheng Meng</td>
        <td>Tester</td>
        <td>Cadbury</td>
        <td>Kl</td>
      </tr>
    </table>
  </main>

  <?php include('footer.inc'); ?>

</body>

</html>