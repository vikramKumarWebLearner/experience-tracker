<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Expense Tracker</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&family=Ubuntu&display=swap"
    rel="stylesheet">
    <link href="css/googleFonts.css" rel="stylesheet">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">




  <script src="https://kit.fontawesome.com/5b37a47217.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/5b37a47217.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
    crossorigin="anonymous"></script>


</head>

<body>

  <section id="title">

    <div class="container-fluid">




      <!-- Nav Bar -->

      <nav class="navbar navbar-expand-lg navbar-dark">

        <img src="images/logo_main_home.png" class="navbar-brand"></img>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a href="index.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#features" class="nav-link">Features</a>
            </li>
            <li class="nav-item">
              <a href="#company" class="nav-link">Company</a>
            </li>
            <div class="login-register">
              <button type="button" onclick="window.location.href='login.php'" class="btn btn-light login-reg-btn">Log in</button>

              <button type="button" onclick="window.location.href='register.php'" class="btn btn-outline-light login-reg-btn">Register</button>
            </div>
          </ul>

        </div>

      </nav>


      <!-- Title -->

      <div class="row">
        <div class="col-lg-6">
          <h1 class="big-heading">Don't loose your money while spending.</h1>
          <h3>Get the control in your Hands.</h2>

        </div>
        <div class="col-lg-6">
          <img class="title-img" src="images/title-img3.jpg" alt="iphone-mockup">
        </div>

      </div>

    </div>
  </section>


  <!-- Features -->

  <section id="features">
    <div class="row">
      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-check-circle feature-fas fa-4x"></i>
        <h3>Easy to use.</h3>
        <p>Even a child can manage his expenses.</p>
      </div>

      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-chart-pie feature-fas fa-4x"></i>
        <h3>Analysis Charts</h3>
        <p>Get expenditure analysis in category charts.</p>
      </div>

      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-thumbs-up feature-fas fa-4x"></i>
        <h3>Guaranteed to work.</h3>
        <p>The Solution is based on scientific methods.</p>
      </div>
      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-wallet feature-fas fa-4x"></i>
        <h3>Safe Wallet.</h3>
        <p>Keep your Pocket money safe from Work money.</p>
      </div>
      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-bullseye feature-fas fa-4x"></i>
        <h3>Achieve Budget Goals</h3>
        <p>Create your own budget and get notified time to time.</p>
      </div>
      <div class="col-lg-4 col-md-6 feature">
        <i class="fas fa-bell feature-fas fa-4x"></i>
        <h3>Get Reminders.</h3>
        <p>Create your own budget and get notified time to time.</p>
      </div>
    </div>



  </section>


  <!-- Testimonials -->

  <section id="testimonials">

    <div id="testimonial-carousel" class="carousel slide" data-ride="false">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <h2>Before the expense tracker, I was always empty pockets at the Month end.Thanks expense Tracker I now know
            Where I spent.</h2>
          <img class="testimonial-image" src="images/dog-img.jpg" alt="vishal-img">
          <em>Vishal, Jodhpur</em>

        </div>
        <div class="carousel-item">
          <h2 class="testimonial-text">I used the Expense Tracker and now I save a lot.</h2>
          <img class="testimonial-image" src="vikram.jpg" alt="vikram-img" style="border-radius:10px;">
          <em>Vikram, Jodhpur</em>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#testimonial-carousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#testimonial-carousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

  </section>

  <section id="company">
    <div class="row">
      <div class="col-lg-6 viewparent">
        <img class="view-img" src="images/app-work.jpg"></img>
      </div>
      <div class="col-lg-6">
        <h2>About us</h2>
        <p>Expense Tracker System is designed to keep a track of Income-Expense of an organisation on a day-to-day basis. This System divides the Income based on daily expenses. If exceed day’s expense, system will calculate income and will provide new daily expense allowed amount. Daily expense tracking System will generate report at the end of month to show Income-Expense graph. And employees send reports to the manager for verification. Manager send final reports to administrator .Based on the final reports system predict the next month expense. </p>
        <p>
        It will help to manage over all expense and income. Businesses utilize expense management software to process, pay, and audit employee-initiated expenses. 
        </p>
        </p>
      </div>
    </div>
  </section>


  <!-- Call to Action -->

  <section id="cta">

    <h3 class="ctah3">Get the control over your money Now.</h3>
    <a class="btn btn-lg btn-light download-btn" href="login.php" type="button">Lets Get Started <i
        class="fas fa-arrow-right"></i></a>

  </section>


  <!-- Footer -->

  <footer id="footer">
    <i class="fab fa-twitter footer-fab"></i>
    <i class="fab fa-facebook-f footer-fab"></i>
    <i class="fab fa-instagram footer-fab"></i>
    <i class="fas fa-envelope footer-fab"></i>
    <p class="footer-p">© Copyright 2022 Expense Tracker</p>

  </footer>


</body>

</html>
