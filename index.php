<?php
        // Create connection
    //     $conn = new mysqli("localhost", "osticket", "osticket@123", "osticket");

    //     // Check connection
    //     if ($conn->connect_error) {
    //         die("Connection failed: " . $conn->connect_error);
    //     }

    // $helpdesk_url = $conn->query("SELECT oc.value FROM ost_config oc WHERE oc.id = '2'")->fetch_object()->value;
    // $twx_url = $conn->query("SELECT ofev.value FROM ost_form_entry_values ofev WHERE ofev.entry_id = '2' AND ofev.field_id = '45'")->fetch_object()->value;
    // // var_dump($helpdesk_url);var_dump($twx_url);die();
    // $conn->close();

   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>iSERV - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="iFavicon.png" rel="icon">
    <link href="iFavicon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>



<body>
    <div class="main-bg">


        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top"
            style="border: 0px; background: transparent; margin-top: 10px; display: flex; justify-content: center;">
            <div class="container d-flex align-items-center justify-content-between"
                style="margin: 10px; width: 100vw; max-width: 100vw;">
                <div>
                    <a href="https://play.google.com/store/apps/details?id=com.iserv&hl=en_US&gl=US" class="logo">
                        <img src="assets/img/goplay.png"
                            style="width: auto; height: 40px; border-radius: 10px; box-shadow: 0 0 8px 3px rgba(255,255,255,0.2);"
                            alt="">
                    </a>
                    <a href="https://apps.apple.com/uz/app/iserv-by-ithena/id1643709504" class="logo"
                        style="margin-left: 15px; ">
                        <img src="assets/img/appStore.png"
                            style="width: auto; height: 40px;border-radius: 10px; box-shadow: 0 0 8px 3px rgba(255,255,255,0.2);"
                            alt="">
                    </a>
                </div>
                <div class="pull-right">
                    <a href="index.php" class="logo">
                        <img src="assets/img/onelinkQR.png" style="width: auto; height: 60px;" alt="" class="img-fluid">
                    </a>

                </div>
            </div>
        </header><!-- End Header -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <img src="assets/img/ITHENA_logo.png" alt="ITHENA_logo" class="img-fluid shadow-sm"
                            style="width: 30%;" />
                        <p style="margin: 20px 0; color: #f1f1f1;">From engineering to manufacturing to servicing,
                            get a 360-degree experience on your manufacturing journey!<a href="https://ithena.ai"
                                style="margin-left: 5px; color: #fff !important; font-weight: 700;"
                                class="text-info">Learn
                                More...</a></p>
                    </div>
                </div>

                <!-- Initial OEM and Manufacturer Cards -->
                <div class="row justify-content-center" style="margin-top: 25px" id="initialCards">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center shadow-sm selectable-card" role="button" id="oemCard"
                            onclick="showOEM()">
                            <div class="card-body">
                                <h4 class="card-title mt-3" style="color: #124265; font-weight: 700">OEM</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center shadow-sm selectable-card" role="button" id="manufacturerCard"
                            onclick="showManufacturer()">
                            <div class="card-body">
                                <i class="bi bi-industry display-4"></i>
                                <h4 class="card-title mt-3" style="color: #124265; font-weight: 700">Manufacturer</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OEM Cards (Hidden by Default) -->
                <div class="row justify-content-center" id="oemCards" style="display: none;">
                </div>

                <!-- Manufacturer Extra Card (Hidden by Default) -->
                <div class="row justify-content-center" id="manufacturerExtraCard" style="display: none; "></div>

            </div>
        </section>

        <script>
        const prod_list = {
            "oem": [{
                    "name": "Performance Monitoring",
                    "url": "https://pm-iserv.ithena.io/Thingworx/FormLogin/ISERV",
                    "icon": "bi bi-graph-up-arrow",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations."
                },
                {
                    "name": "Service Portal",
                    "url": "https://iserv-demo.ithena.io/iserv",
                    "icon": "bi bi-person-fill-gear",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations."
                },
                {
                    "name": "B2B eCommerce",
                    "url": "https://ecommerce.ithena.io",
                    "icon": "bi bi-cart",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations."
                }
            ],
            "manufacturer": [{
                    "name": "iGEMBA",
                    "url": "https://igemba.ithena.io",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations.",
                    "icon": "bi bi-card-checklist"
                },
                {
                    "name": "Performance Monitoring",
                    "url": "https://pm-iserv.ithena.io/Thingworx/FormLogin/ISERV",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations.",
                    "icon": "bi bi-graph-up-arrow"
                },
                {
                    "name": "CMMS",
                    "url": "http://3.110.9.169:8023/iserv/scp/",
                    "description": "Gain real-time connectivity into asset performance, receive proactive alerts and alarms to support your service operations.",
                    "icon": "bi bi-cart"
                }
            ]
        };

        function generateHTMLCards(products, mode) {
            let html = '';
            products[mode].forEach((product) => {
                html += `<div class="col-md-12 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0 slide-card" >
                      <a href="${product.url}" class="icon-href" target="_blank">
                          <div class="icon-box" style="border-bottom: 5px solid #0282C8;">
                              <div class="icon"><i class="${product.icon}"></i></div>
                              <h4 class="title">${product.name}</h4>
                              <p class="description">${product.description}</p>
                          </div>
                      </a>
                  </div>`;
            });
            return html
        }

        function showOEM() {
            const oemCards = document.getElementById('oemCards');
            const manufacturerExtraCard = document.getElementById('manufacturerExtraCard');

            var html = generateHTMLCards(prod_list, 'oem');
            $('#oemCards').html(html);
            $('#manufacturerExtraCard').hide();
            $('#oemCards').show();

            highlightCard('oemCard');

            setTimeout(() => {
                oemCards.querySelectorAll('.slide-card').forEach(card => card.classList.add('show'));
            }, 10);
        }

        function showManufacturer() {
            const oemCards = document.getElementById('oemCards');
            const manufacturerExtraCard = document.getElementById('manufacturerExtraCard');

            var html = generateHTMLCards(prod_list, 'manufacturer');

            $('#manufacturerExtraCard').html(html);
            $('#oemCards').hide();
            $('#manufacturerExtraCard').show();

            highlightCard('manufacturerCard');

            setTimeout(() => {
                oemCards.querySelectorAll('.slide-card').forEach(card => card.classList.add('show'));
                manufacturerExtraCard.querySelectorAll('.slide-card').forEach(card => card.classList
                    .add(
                        'show'));
            }, 10);
        }

        function highlightCard(selectedId) {
            document.querySelectorAll('.selectable-card').forEach(card => card.classList.remove('active'));
            document.getElementById(selectedId).classList.add('active');
        }
        </script>




        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="container text-center" style="width: 80vw; max-width: 80vw; margin: 10px auto">
                <hr>
                <div class="mt-1">
                    <span>Copyright &copy; 2011-2025 ITHENA
                    </span>
                </div>
                <div class="mt-1 mb-1">
                    <span>All trademarks or registered trademarks are property of their respective
                        owners.</span>
                </div>
                <a style="margin-top: 5px; color: #aaa;" target="_blank"
                    href="http://eula.ithena.io">EULA</a>&nbsp;<span>&#x2022;</span>
                <a style="color: #aaa;" target="_blank" href="http://privacy.ithena.io">Privacy
                    Policy</a>&nbsp;<span>&#x2022;</span>
                <a target="_blank" style="color: #aaa;"
                    href="https://support.ithena.io/open.php?org=Sonoco&ht=iServ&src=12.22.22">Support</a>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </div>

</body>


</html>
<?php unset($helpdesk_url, $twx_url); ?>