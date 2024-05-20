<?php
include 'admin/db_connect.php';
?>
<html>

<head>
  <title>
    Welcome to SJCB Alumni Tracking
  </title>
  <style>
    a.card-link {
      color: black;
      text-decoration: none;
    }

    a.card-link:hover {
      color: #333;
    }

    .zoom-wrapper {
      overflow: hidden;
    }

    .zoom-wrapper img {
      transition: transform 0.8s, filter 0.4s;
    }

    .zoom-wrapper h2 {
      transition: transform 0.8s;
    }

    .zoom-wrapper:hover img {
      transform: scale(1.2);
      filter: brightness(80%) !important;
    }

    .zoom-wrapper:hover h2 {
      transform: scale(1.2);
    }

    .arrow-icon {
      color: white;
    }

    .careers-btn:hover .arrow-icon {
      color: black;
    }
  </style>
</head>
<?php
// Fetch image paths from the database
$sql = "SELECT image_path FROM banner_images";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
  $images = array();

  // Store image paths in an array
  while ($row = $result->fetch_assoc()) {
    $images[] = $row["image_path"];
  }
}
$conn->close();
?>

<div id="hero" class="carousel-fade">
  <div class="carousel-inner">
    <?php
    foreach ($images as $index => $image) {
      ?>
      <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?> heroBanner d-flex align-items-center">
        <img src="admin/assets/uploads/banner_images/<?php echo $image; ?>" class="d-block w-100 banner"
          alt="Banner Image">
        <div class="container">
          <?php
          if ($index == 0) {
            // Content for the first carousel item
            ?>
            <h4 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">Empower Your Journey with</h4>
            <h3 data-aos="zoom-in" data-aos-delay="500">Alumni Connections<br> <span style="color: #fff;">Your pathway to
                continued success</span></h3>
            <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
              style="display: inline-block; margin:15px 12px 0 0;">
              <a href="index.php?page=careers" class="careers-btn rounded-3" type="button">
                Explore Opportunities
                <span style="margin-left: 5px;"> <i class="fa-solid fa-arrow-right arrow-icon"></i></span>
              </a>
            </div>
            <?php
          } elseif ($index == 1) {
            // Content for the second carousel item
            ?>
            <h4 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">Forge Lasting Connections with
            </h4>
            <h3 data-aos="zoom-in" data-aos-delay="500">Alumni Community<br> <span style="color: #fff;">Join a vibrant
                network of achievers</span></h3>
            <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
              style="display: inline-block; margin:15px 12px 0 0;">
              <a href="index.php?page=alumni_list" class="careers-btn rounded-3" type="button">
                Get Involved
                <span style="margin-left: 5px;"> <i class="fa-solid fa-arrow-right arrow-icon"></i></span>
              </a>
            </div>
            <?php
          } elseif ($index == 2) {
            // Content for the third carousel item
            ?>
            <h4 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">Stay Engaged with</h4>
            <h3 data-aos="zoom-in" data-aos-delay="500">Alumni Events & Forums<br> <span style="color: #fff;">Explore
                opportunities to connect and grow</span></h3>
            <div data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"
              style="display: inline-block; margin:15px 12px 0 0;">
              <a href="index.php?page=forum" class="careers-btn rounded-3" type="button">
                Discover Events
                <span style="margin-left: 5px;"> <i class="fa-solid fa-arrow-right arrow-icon"></i></span>
              </a>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div><br>

<!-- Gallery Section -->
<section id="about" data-scene data-speed="1.2">
  <div class="container-fluid">
    <h1 data-aos="zoom-in" style="text-align: center; font-weight: 700 !important;">Alumni Gallery</h1><br>
    <div class="row">
      <div class="col-12 m-auto">
        <div class="owl-carousel owl-theme">
          <?php
          include 'admin/db_connect.php';

          // Fetch data from the 'gallery' table
          $galleryData = [];
          $galleryQuery = $conn->query("SELECT DISTINCT g.album_id, g.*, a.name FROM `gallery` g
                            LEFT JOIN albums a ON g.album_id = a.id
                            WHERE g.archived = 0");
          while ($item = $galleryQuery->fetch_assoc()):
            // Get the first image for each batch
            $img_names = explode(',', $item['img']);
            $first_img = $img_names[0];
            ?>
            <div class="item mb-4" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
              <a href="index.php?page=gallery&album_id=<?php echo $item['album_id']; ?>"
                class="card-link nav-link-restricted">
                <div class="card border-0 shadow zoom-wrapper" style="position: relative;">
                  <!-- Display the first image for each batch -->
                  <img src="admin/assets/uploads/gallery/<?php echo $first_img; ?>" alt="" class="card-img-top"
                    style="height: 280px; filter: brightness(60%)" data-album-info="<?php echo $item['album_id']; ?>" />

                  <!-- Display Batch Text Below Image -->
                  <div class="batch-text text-center">
                    <?php echo $item['name']; ?>
                  </div>
                </div>
              </a>
            </div>
            <?php
          endwhile;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Card section -->

<section id="" class="" data-scene data-speed="1.6">
  <div class="container mt-4">
    <div class="row">
      <!-- alumni card -->
      <div class="col-lg-4 mb-4">
        <div class="card" style="height: 430px; overflow-y: scroll;" data-aos="zoom-out-right">
          <div class="card-body">
            <h4 class="card-title" style="position: sticky; top: 0; background: #fff; z-index: 1;">Our Alumni</h4>
            <?php
            $fpath = 'admin/assets/uploads';
            $archived = isset($_GET['archived']) ? $_GET['archived'] : 0;
            $statusCondition = $archived ? 'a.archived = 1' : 'a.status = 1 AND a.archived = 0';
            $alumni = $conn->query("SELECT a.*, Concat(a.lastname, ', ', a.firstname, ' ', a.middlename) as name FROM alumnus_bio a WHERE a.status = 1 AND $statusCondition ORDER BY id ASC");

            while ($row = $alumni->fetch_assoc()):
              ?>
              <div class="row mb-3">
                <!-- <div class="col-5">
                  <a href="index.php?page=alumni_list&alumni_id=<//?php echo $row['id']; ?>" class="view_alumni"
                    data-id="<//?php echo $row['id']; ?>"> <img src="<//?php echo $fpath . '/' . $row['avatar']; ?>"
                      alt="Avatar" class="img-fluid"
                      style="width: 100px; height: 100px; object-fit: cover; object-position: center center;">
                  </a>
                </div> -->
                <div class="col-5">
                  <a href="index.php?page=alumni_list" class="view_alumni" data-id="<?php echo $row['id']; ?>"> <img
                      src="<?php echo $fpath . '/' . $row['avatar']; ?>" alt="Avatar" class="img-fluid"
                      style="width: 100px; height: 100px; object-fit: cover; object-position: center center;">
                  </a>
                </div>
                <div class="col-7">
                  <h6>Name:
                    <?php echo $row['name'] ?>
                  </h6>
                  <h6>Batch:
                    <?php echo $row['batch'] ?>
                  </h6>
                  <h6>Age:
                    <?php echo $row['age'] ?>
                  </h6>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        <div class="container" style="text-align: center;">
          <a href="index.php?page=alumni_list" class="nav-link-restricted btn btn-primary rounded-0"
            style="display: inline-block; width: 100%; text-decoration: none;">View All Alumni</a>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card" style="height: 430px; overflow-y: scroll;" data-aos="zoom-out-up">
          <div class="card-body">
            <h4 class="card-title" style="position: sticky; top: 0; background: #fff; z-index: 1;">Job Openings</h4>

            <?php
            $jobs = $conn->query("SELECT c.*, u.name FROM careers c
                         INNER JOIN users u ON u.id = c.user_id
                         WHERE c.archived = 0
                         ORDER BY c.id DESC");
            while ($row = $jobs->fetch_assoc()):
              $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
              unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
              $desc = strtr(html_entity_decode($row['description']), $trans);
              $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
              ?>
              <div class="card job-list" data-id="<?php echo $row['id'] ?>">
                <div class="card-body">
                  <div class="row align-items-center justify-content-center text-center h-100">
                    <div class="col-md-12">
                      <h3><b class="filter-txt">
                          <?php echo ucwords($row['job_title']) ?>
                        </b></h3>
                      <div>
                        <span class="filter-txt"><small><b><i class="fa fa-building"></i>
                              <?php echo ucwords($row['company']) ?>
                            </b></small></span><br>
                        <span class="filter-txt"><small><b><i class="fa-solid fa-location-dot"></i>
                              <?php echo ucwords($row['location']) ?>
                            </b></small></span>
                      </div>
                      <hr>
                      <div class="mt-3 text-start">
                        <span class="text-muted d-block filter-txt"><i class="fa-solid fa-industry"
                            aria-hidden="true"></i>
                          <?php echo ucwords($row['sector']) ?>
                        </span>
                        <span class="text-muted d-block filter-txt"><i class="fa-solid fa-sack-dollar"
                            aria-hidden="true"></i>
                          Salary Range:
                          <?php echo ucwords($row['salary_range']) ?>
                        </span>
                        <button class="btn btn-primary btn-sm read_more rounded-2" data-id="<?php echo $row['id'] ?>">Read
                          More</button>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <br>
            <?php endwhile; ?>
          </div>
        </div>
        <div class="container" style="text-align: center;">
          <a href="index.php?page=careers" class="nav-link-restricted btn btn-primary rounded-0"
            style="display: inline-block; width: 100%; text-decoration: none;">View All Jobs</a>
        </div>
      </div>

      <!-- Events card -->
      <div class="col-lg-4 mb-4">
        <div class="card" style="height: 430px; overflow-y: scroll;" data-aos="zoom-out-left">
          <div class="card-body">
            <h4 class="card-title" style="position: sticky; top: 0; background: #fff; z-index: 1;">Upcoming Events</h4>
            <div class="card-container">
              <?php
              $fpath = 'admin/assets/uploads/event_images/';
              $current_date = date('Y-m-d H:i:s');
              $events = getUpcomingEvents($conn, $current_date);
              while ($row = $events->fetch_assoc()):
                ?>
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-12">
                      <img src="<?php echo $fpath . '/' . $row['banner'] ?>" class="img-fluid" alt="Event Image"
                        style="height: 200px; object-fit: cover; width: 100%;">
                      <h3 class="card-title mt-1">
                        <?php echo $row['title'] ?>
                      </h3>
                      <p class="card-text" style="margin-bottom: -4px;">
                        <small class="text-muted">
                          <?php
                          $start_date = date('M d, Y', strtotime($row['start_date']));
                          $end_date = date('M d, Y', strtotime($row['end_date']));
                          echo "Start Date: $start_date <br> End Date: $end_date";
                          ?>
                        </small>
                      </p>
                      <a class="nav-link-restricted btn btn-primary btn-md"
                        href="index.php?page=view_event&id=<?php echo $row['id'] ?>" style="text-decoration: none;">View
                        Details</a>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
        <div class="container" style="text-align: center;">
          <a href="index.php?page=events" class="nav-link-restricted btn btn-primary rounded-0"
            style="display: inline-block; width: 100%; text-decoration: none;">View All Events</a>
        </div>
      </div>

      <?php
      function getUpcomingEvents($conn, $currentDate)
      {
        // Retrieve upcoming events from the database
        return $conn->query("SELECT id, title, start_date, end_date, banner, content FROM events WHERE end_date > '$currentDate' AND archived = 0 ORDER BY start_date ASC");
      }

      ?>
    </div>
  </div>
</section>

<!-- ======= About Section ======= -->
<section id="about" data-scene data-speed="1.2">
  <div class="container">
    <h1 data-aos="fade-up" style="text-align: center; font-weight: 700 !important;">About Us</h1><br>
    <div class="row">
      <div class="col-lg-4 col-md-12 col-12">
        <div class="about-img" data-aos="zoom-out-right">
          <img class="img-fluid" src="assets/img/history.JPG" alt="">
        </div><br>
      </div>
      <div class="col-lg-8 col-md-12 col-12 ps-lg-5">
        <div class="about-text" data-aos="zoom-out-left">
          <h2>The Alumni Tracking System</h2>
          <p>Your gateway to reconnecting with your alma mater and fellow
            graduates. We are committed to fostering a thriving community of alumni who share a common bond with their
            educational institution. Our platform serves as a dynamic hub where past students can engage, collaborate,
            and make a lasting impact on the institution that played a pivotal role in their lives.</p>
          <div class="text-center text-lg-start">
            <a href='index.php?page=about' class="about-us-btn rounded-3" type="button">Learn More</a>
          </div>
        </div>

      </div>

    </div>


  </div>
</section>
<!-- End About -->

<!--  Contact Section  -->
<section class="container mt-5">
  <!--Contact heading-->
  <div class="row">
    <!--Grid column-->
    <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" class="col-sm-12 mb-4 col-md-5">
      <!--Form with header-->
      <div class="card border-primary rounded-0">
        <div class="card-header p-0">
          <div class="bg-primary text-white text-center py-2">
            <h3><i class="fa fa-envelope"></i> Connect with Us:</h3>
            <p class="m-0">Reach out to stay updated on the latest alumni information. We value your input!</p>
          </div>
        </div>
        <div class="card-body p-3">

          <div class="form-group">
            <label> Your name </label>
            <div class="input-group">
              <input value="" type="text" name="data[name]" class="form-control" id="inlineFormInputGroupUsername"
                placeholder="Your name">
            </div>
          </div>
          <div class="form-group">
            <label>Your email</label>
            <div class="input-group mb-2 mb-sm-0">
              <input type="email" value="" name="data[email]" class="form-control" id="inlineFormInputGroupUsername"
                placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label>Subject</label>
            <div class="input-group mb-2 mb-sm-0">
              <input type="text" name="data[subject]" class="form-control" id="inlineFormInputGroupUsername"
                placeholder="Subject">
            </div>
          </div>
          <div class="form-group">
            <label>Message</label>
            <div class="input-group mb-2 mb-sm-0">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
          <div class="text-center">
            <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block rounded-0 py-2">
          </div>

        </div>

      </div>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div data-aos="zoom-in-left" class="col-sm-12 col-md-7">
      <!--Google map-->
      <div class="mb-4">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6062.134894919663!2d121.87153365056926!3d17.88978707750277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3385ee9c08583b31%3A0xe5d8a88f038533f4!2sSaint%20Joseph&#39;s%20College%20of%20Baggao!5e0!3m2!1sen!2sph!4v1688346873622!5m2!1sen!2sph"
          width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
          tabindex="0"></iframe>
      </div>
      <!--Buttons-->
      <div class="row text-center">
        <div class="col-md-4">
          <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i
              class="fa-solid fa-location-dot"></i></a>
          <p> Domingo Street, San Jose 3506 Baggao, Philippines </p>
        </div>
        <div class="col-md-4">
          <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-phone"></i></a>
          <p>+63 917 166 7988</p>
        </div>
        <div class="col-md-4">
          <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="fa fa-envelope"></i></a>
          <p> vpaa@sjcbi.edu.ph</p>
        </div>
      </div>
    </div>
    <!--Grid column-->
  </div>
</section>
<!-- End Contact -->


<script>

  $(document).ready(function () {
    // Initialize the carousel
    var carousel = $('#hero').carousel({
      interval: 5000, // Set the interval (in milliseconds) for autoplay
      pause: false, // Set to true to pause autoplay on hover
      ride: 'carousel' // Start autoplay
    });

    // Add CSS transitions to carousel items for fade effect
    $('.carousel-item').css('transition', 'opacity 0.9s ease-in-out');

  });



  // gallery carousel
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 15,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  // Add an event listener to the "Read More" button
  $('.read_more').click(function (e) {
    e.preventDefault(); // Prevent the default button behavior

    // Get the job ID (data-id attribute) to identify the job
    var jobId = $(this).attr('data-id');

    // Construct the URL with the page name and job ID as query parameters
    var url = 'index.php?page=careers&job_id=' + jobId;

    // Redirect to the new URL
    window.location.href = url;
  });

</script>

</html>