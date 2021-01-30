<?php
header('Content-type: text/css');
ob_start();
include("bootstrap.min.css");
include( "animate.min.css");
include( "aos.css");
include( "header.css");
include( "footer.css");
include( "font.css");
include( "owl.carousel.css");
include( "style.css");
include( "responsive.css");
ob_end_flush();
?>