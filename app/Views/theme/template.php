<!DOCTYPE html>
<html lang="en" style="font-size: 14px;">

<style>

/* =========================
   INTERACTIVE 3D CARDS
========================= */

.small-box{
    position: relative;
    overflow: hidden;
    border-radius: 20px !important;
    padding: 20px;

    transform-style: preserve-3d;
    perspective: 1000px;

    transition:
        transform 0.15s ease,
        box-shadow 0.3s ease;

    cursor: pointer;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.15);

    animation: floating 4s ease-in-out infinite;
}

/* CARD HOVER */
.small-box:hover{
    box-shadow:
        0 20px 40px rgba(0,0,0,0.25),
        0 0 20px rgba(255,255,255,0.2);
}

/* CARD CONTENT */
.small-box .inner{
    position: relative;
    z-index: 2;
    transform: translateZ(50px);
}

/* BIG ICON */
.small-box .icon{
    position:absolute;
    top:20px;
    right:20px;

    font-size:70px;
    opacity:0.15;

    transform: translateZ(80px);

    transition:0.3s;
}

.small-box:hover .icon{
    transform:
        translateZ(100px)
        rotate(10deg)
        scale(1.2);

    opacity:0.3;
}

/* LIGHT EFFECT */
.small-box::before{
    content:"";

    position:absolute;
    top:-50%;
    left:-50%;

    width:200%;
    height:200%;

    background:
        linear-gradient(
            45deg,
            transparent,
            rgba(255,255,255,0.15),
            transparent
        );

    transform: rotate(45deg);

    transition:0.8s;
}

.small-box:hover::before{
    left:100%;
}

/* RIPPLE EFFECT */
.small-box span.ripple{
    position:absolute;
    border-radius:50%;
    transform:scale(0);
    animation:ripple 0.6s linear;
    background:rgba(255,255,255,0.4);
    pointer-events:none;
}

/* ANIMATIONS */
@keyframes ripple{
    to{
        transform:scale(4);
        opacity:0;
    }
}

@keyframes floating{
    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-6px);
    }

    100%{
        transform:translateY(0px);
    }
}

/* TEXT */
.small-box h3{
    font-size:40px;
    font-weight:bold;
    text-shadow:2px 2px 10px rgba(0,0,0,0.3);
}

.small-box p{
    font-size:18px;
    letter-spacing:1px;
}

/* PREMIUM COLORS */
.bg-info{
    background:linear-gradient(135deg,#00c6ff,#0072ff)!important;
}

.bg-success{
    background:linear-gradient(135deg,#00b09b,#96c93d)!important;
}

.bg-warning{
    background:linear-gradient(135deg,#f7971e,#ffd200)!important;
}

.bg-danger{
    background:linear-gradient(135deg,#ff416c,#ff4b2b)!important;
}

</style>



<style>

/* =========================
   PAGE TRANSITION EFFECT
========================= */

body{
    overflow-x:hidden;
}

/* MAIN PAGE */
.content-wrapper{
    opacity: 0;
    transform: translateY(20px);
    animation: pageFade 0.7s ease forwards;
}

/* PAGE LOAD ANIMATION */
@keyframes pageFade{
    from{
        opacity:0;
        transform: translateY(20px);
    }

    to{
        opacity:1;
        transform: translateY(0);
    }
}

/* PAGE EXIT EFFECT */
.fade-out{
    animation: pageOut 0.4s ease forwards;
}

@keyframes pageOut{
    from{
        opacity:1;
        transform: translateY(0);
    }

    to{
        opacity:0;
        transform: translateY(-20px);
    }
}

/* SMOOTH LINKS */
a{
    transition: all 0.3s ease;
}

/* MENU HOVER */
.nav-link:hover{
    transform: translateX(5px);
}

/* CARD TRANSITION */
.card{
    transition: all 0.4s ease;
}

.card:hover{
    transform: translateY(-5px);
}

/* BUTTON ANIMATION */
.btn{
    transition: all 0.3s ease;
}

.btn:hover{
    transform: scale(1.05);
}

</style>
<head>


  <meta name="csrf-name" content="<?= csrf_token() ?>">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INVENTORY | Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/jqvmap/jqvmap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.css') ?>">

</head>

<script>

/* =========================
   SMOOTH PAGE TRANSITION
========================= */

document.addEventListener("DOMContentLoaded", () => {

    // Fade in automatically
    document.body.classList.add("loaded");

    // Add fade effect to all links
    document.querySelectorAll("a").forEach(link => {

        // Skip empty links
        if (
            link.hostname === window.location.hostname &&
            !link.href.includes("#") &&
            !link.hasAttribute("target")
        ) {

            link.addEventListener("click", function(e){

                e.preventDefault();

                let destination = this.href;

                document.querySelector(".content-wrapper")
                    .classList.add("fade-out");

                setTimeout(() => {
                    window.location = destination;
                }, 400);

            });

        }

    });

});

</script>

<script>

/* =========================
   INTERACTIVE 3D EFFECT
========================= */

const cards = document.querySelectorAll('.small-box');

cards.forEach(card => {

    // MOUSE MOVE 3D TILT
    card.addEventListener('mousemove', (e) => {

        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / 15);
        const rotateY = ((centerX - x) / 15);

        card.style.transform = `
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            scale(1.03)
        `;

    });

    // RESET POSITION
    card.addEventListener('mouseleave', () => {

        card.style.transform = `
            rotateX(0deg)
            rotateY(0deg)
            scale(1)
        `;

    });

    // RIPPLE EFFECT
    card.addEventListener('click', function(e){

        const ripple = document.createElement('span');

        ripple.classList.add('ripple');

        const rect = card.getBoundingClientRect();

        ripple.style.left = `${e.clientX - rect.left}px`;
        ripple.style.top = `${e.clientY - rect.top}px`;

        ripple.style.width = ripple.style.height = `120px`;

        card.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);

    });

});

</script>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!--   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('assets/adminlte/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <?= $this->include('theme/navbar') ?>

  <?= $this->include('theme/sidebar') ?>

  <?= $this->renderSection('content') ?>

 <footer class="main-footer no-print">
    <strong>Copyright &copy; 2025 <a href="#">Jicky the great</a> </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> CI4.v1
    </div>
  </footer>
<aside class="control-sidebar control-sidebar-dark">
  <!-- Add padding so content isn’t stuck to edges -->
  <div class="p-3">
    <h5>Settings</h5>
    <hr>
    <div class="form-group">
      <label>Option 1</label>
      <input type="checkbox" class="form-control">
    </div>
    <div class="form-group">
      <label>Option 2</label>
      <input type="checkbox" class="form-control">
    </div>
  </div>
</aside>

</div>
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/sparklines/sparkline.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/dist/js/pages/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
<script>
const themeToggle = document.getElementById('themeToggle');
const navbar = document.getElementById('mainNavbar');
const sidebar = document.getElementById('mainSidebar');
const brandLink = document.getElementById('brandLink');

// Apply saved theme on load
let savedTheme = localStorage.getItem('adminlteTheme');
if(savedTheme === 'dark'){
    document.body.classList.add('dark-mode');

    // Navbar
    navbar.classList.remove('navbar-warning');
    navbar.classList.add('navbar-dark','bg-dark');

    // Sidebar
    sidebar.classList.remove('sidebar-light');
    sidebar.classList.add('sidebar-dark-primary');

    // Brand link
    brandLink.classList.remove('bg-warning');
    brandLink.classList.add('bg-dark');

    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
} else {
    // Light mode
    navbar.classList.add('navbar-warning');

    sidebar.classList.remove('sidebar-dark-primary');
    sidebar.classList.add('sidebar-light');

    brandLink.classList.remove('bg-dark');
    brandLink.classList.add('bg-warning');

    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
}

// Toggle theme
themeToggle.addEventListener('click', function(e){
    e.preventDefault();

    if(document.body.classList.contains('dark-mode')){
        // Switch to light
        document.body.classList.remove('dark-mode');

        // Navbar
        navbar.classList.remove('navbar-dark','bg-dark');
        navbar.classList.add('navbar-warning');

        // Sidebar
        sidebar.classList.remove('sidebar-dark-primary');
        sidebar.classList.add('sidebar-light');

        // Brand link
        brandLink.classList.remove('bg-dark');
        brandLink.classList.add('bg-warning');

        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        localStorage.setItem('adminlteTheme','light');
    } else {
        // Switch to dark
        document.body.classList.add('dark-mode');

        // Navbar
        navbar.classList.remove('navbar-warning');
        navbar.classList.add('navbar-dark','bg-dark');

        // Sidebar
        sidebar.classList.remove('sidebar-light');
        sidebar.classList.add('sidebar-dark-primary');

        // Brand link
        brandLink.classList.remove('bg-warning');
        brandLink.classList.add('bg-dark');

        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        localStorage.setItem('adminlteTheme','dark');
    }
});
</script>
