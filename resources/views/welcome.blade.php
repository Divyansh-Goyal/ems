<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Welcome</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="welcome/assets/img/favicon.png" rel="icon">
  <link href="welcome/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="welcome/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="welcome/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="welcome/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="welcome/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="welcome/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="welcome/assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex justify-content-center align-items-center header-transparent">

    <nav id="navbar" class="navbar">
      <ul>
        @if (Route::has('login'))
            @if (Auth::check())
                <a class="nav-link scrollto active" href="{{ url('/home') }}"><h2>Home</h2></a>
            @else
                <a class="nav-link scrollto active" href="{{ url('/login') }}"><h2>LOGIN</h2></a>
            @endif
        </div>
        @endif
      </ul>
      {{-- <i class="bi bi-list mobile-nav-toggle"></i> --}}
    </nav><!-- .navbar -->

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Management System</h1>
      <h2>Handle Your Colleagues Details</h2>
      <a href="#about" class="btn-scroll scrollto" title="Scroll Down"><i class="bx bx-chevron-down"></i></a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Me Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="section-title">
          <span>About US</span>
          <h2>About US</h2>
          <p>An employee management system provides managers with insights into their workforce,<br> 
              and helps them to better plan and manage work hours to easily control labor costs and increase productivity.</p>
        </div>

        <div class="row justify-content-center">
          {{-- <div class="image col-lg-4 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div> --}}
          <div class="col-lg-10 d-flex flex-column align-items-stretch">
            <div class="content ps-lg-4 d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-lg-6">
                  <h3>Smooth Decision Making</h3>
                  <p>
                  With employee management software, you can utilize the standard metrics for employee management. You can also customize or create your own metrics for
                  the needs of the staff management in your company with ease. The pocket HRMS has a very easy to handle user interface and is seamless to help you with the performance management of the employees.
                  The software gives you to have an upper view of the entire staff management. The employee management system, also there to help you with the tools such as an 
                  analytically driven metric system. With the timesheet management and time tracking software, it is all in one resource and the right employee management system for meaningful data and smart decision making for your business.
                </p>
                </div>
                <div class="col-lg-6">
                  <h2>What is Employee Management System?</h2>
                  <p>
                  An employee management system is a software, that helps your employees to give their best efforts every day to achieve the goals of your organization. It guides and manages employees efforts in the right direction. 
                  It also securely stores and manages personal and other work-related details for your employees. That makes it easier to store and access the data when there is a need.
                  In the employee management system, you can manage admin activities in an easier and quicker way. Employees are an important part of your organization it is their work that ultimately contributes to the bottom line of the company.
                  It is an important part of HR management. It also helps to employee engagement and employee retention brings down costs and increases productivity.
                  </p>
                </div>
              </div>
              <div class="row mt-n4">
                <div class="col-md-6 mt-5 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile" style="color: #20b38e;"></i>
                    <h3><strong>&nbsp; Access to Information</strong></h3>
                    <p> The staff can access the basic information on the portal without approaching human resources for it</p>
                  </div>
                </div>

                <div class="col-md-6 mt-5 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile" style="color: #8a1ac2;"></i>
                    <h3><strong>&nbsp; Employee Engagement</strong></h3>
                    <p> With a self-service portal, employees are more engaged and feel more empowered in your organization.</p>
                  </div>
                </div>

                <div class="col-md-6 mt-5 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-award" style="color: #2cbdee;"></i>
                    <h3><strong>&nbsp; Happy Workforce </strong></h3>
                    <p> Company culture is important for the profitability of an organization. We are no longer live in an era where all we can expect from employees</p>
                  </div>
                </div>

                <div class="col-md-6 mt-5 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-clock" style="color: #ffb459;"></i>
                    <h3><strong>&nbsp; Saves Productive Time</strong></h3>
                    <p> The advantage of employee management software is that it is cloud-based software. Giving you access wherever you are at. You don’t have to hold on to the decisions for lack of information.</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->

            

          </div>
        </div>

      </div>
    </section><!-- End About Me Section -->

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="welcome/assets/vendor/purecounter/purecounter.js"></script>
  <script src="welcome/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="welcome/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="welcome/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="welcome/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="welcome/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="welcome/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="welcome/assets/js/main.js"></script>

</body>

</html>
