<?php
header('Content-type: text/css');
ob_start();
?>
@import url('https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700');
@import url('https://fonts.googleapis.com/css?family=Nunito:300,400,600,700');
<?php 
include("bootstrap.min.css");
include( "animate.min.css");
include( "aos.css");
include( "header.css");
include( "footer.css");
include( "font.css");
include( "owl.carousel.css");
include( "slick.css");
include( "thems.css");
include( "style.css");
include( "responsive.css");
include("new-sliders-css.css");
ob_end_flush();
?>