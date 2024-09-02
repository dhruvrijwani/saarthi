<?php
 require("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Terapia - Physical Therapy Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/imggallery.css"> -->

    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        min-height: 100vh;
      }
      .alb {
        padding: 5px;
      }
      .alb img {
        width: 100%;
        height: 100%;
      }
      a {
        text-decoration: none;
        color: black;
      }

      /* @media only screen and (min-width: 768px) {
        .alb {
          width: 33.33%;
        }
      } */
    </style>
  </head>

  <body>
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0 position-sticky"
    >
      <a href="index.html" class="responsivelogo navbar-brand p-0">
        <h1 class="text-primary m-0">
          <img src="img\saarhti tarot reading.jpg" alt="Logo" /><span
            class="logo-text"
            >Sarthi Tarot</span
          >
        </h1>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
      >
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
          <a href="index.html" class="nav-item nav-link ">Home</a>
          <a href="blog.html" class="nav-item nav-link">Blogs</a>
          <a href="feature.html" class="nav-item nav-link">Courses</a>
          <a href="imggallery.php" class="nav-item nav-link active">Images</a>

          <div class="nav-item dropdown">
            <a
              href="service.html"
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              >Services</a
            >
            <div class="dropdown-menu m-0">
              <a href="service.html" class="dropdown-item"
                >Basic Tarot Reading</a
              >
              <a href="service.html" class="dropdown-item"
                >Advanced Tarot Reading</a
              >
              <a href="service.html" class="dropdown-item">Basic Numerology</a>
              <a href="service.html" class="dropdown-item"
                >Advanced Numerology</a
              >
              <a href="service.html" class="dropdown-item">Reiki Healing</a>
              <a href="service.html" class="dropdown-item">Pendulum Dowsing</a>
              <a href="service.html" class="dropdown-item">Spells</a>
            </div>
          </div>
          <a href="contact.html" class="nav-item nav-link">Contact Us</a>
        </div>
        <a
          href="appointment.html"
          class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0"
          >Book Appointment</a
        >
      </div>
    </nav>

    <!-- <div class="alb">
      <img src="uploads/<?=$images['image_url']?>" />
    </div> -->

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="d-flex justify-content-center align-items-center">
            <h1 style="color: black; text-align: center">photo gallery</h1>
            <a href="upload.php">&#8592;</a>
          </div>
        </div>
      </div>
      <div class="row" data-masonry='{"percentPosition": true }'>
        <?php
         $sql = "SELECT * FROM images ORDER BY image_url DESC";
         $res = mysqli_query($connection,  $sql);
          
          if ($res) {
              if (mysqli_num_rows($res) >
        0) { while ($images = mysqli_fetch_assoc($res)) { ?>
        <div class="col col-md-4">
          <div class="alb" >
            <img src="uploads/<?=$images['image_url']?>" />
          </div>
        </div>
        <?php
                }
            } else {
                echo "No images found.";
            }
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    ?>
      </div>
    </div>

    <!-- Footer Start -->
    <div
      id="footer-section"
      class="container-fluid footer py-5 wow fadeIn"
      data-wow-delay="0.2s"
    >
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="text-white mb-4">Sarthi Tarot</h4>
              <p>
                "Sarthi Tarot - Your Trusted Guide to Insight and Guidance.
                Unlock the mysteries of the cards with our experienced readers.
                Trust in the wisdom of the Tarot and embark on a journey of
                self-discovery with us."
              </p>
              <div class="d-flex align-items-center">
                <i class="fas fa-share fa-2x text-white me-2"></i>
                <a
                  class="btn-square btn btn-primary text-white rounded-circle mx-1"
                  href="https://www.facebook.com/people/Sarthi-Tarot-with-Vandnna/100078515239648/"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  class="btn-square btn btn-primary text-white rounded-circle mx-1"
                  href="https://www.instagram.com/sarthitarot?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-white">Quick Links</h4>

              <a href="appointment.html"
                ><i class="fas fa-angle-right me-2"></i> Book Appointment</a
              >
              <a href="blog.html"
                ><i class="fas fa-angle-right me-2"></i> Our Blog & News</a
              >
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-white">Services</h4>
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Tarot reading</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i>Spells</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Numerology</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Reiki healing</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Crystal healing</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Pendulum dowsing</a
              >
              <a href="service.html"
                ><i class="fas fa-angle-right me-2"></i> Name Correction</a
              >
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-white">Contact Info</h4>
              <a href=""
                ><i class="fa fa-map-marker-alt me-2"></i>Delhi, India</a
              >
              <a href="mailto:vandnagaur84@gmail.com"
                ><i class="fas fa-envelope me-2"></i> vandnagaur84@gmail.com</a
              >
              <a href="tel:+919650933499"
                ><i class="fas fa-phone me-2"></i> 9650933499</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="row g-4 align-items-center">
          <div class="col-md-6 text-center text-md-start mb-md-0">
            <span class="text-white"
              ><a href="#"
                ><i class="fas fa-copyright text-light me-2"></i>Sarthi Tarot</a
              >, All right reserved.</span
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"
      ><i class="fa fa-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
      integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
      crossorigin="anonymous"
      async
    ></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
