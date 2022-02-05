<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Aplikasi Mentoring Ibadah</title>
    <link rel="stylesheet" href="../ladun/vendor/swiper/swiper.min.css">
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="../ladun/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    
</head>
<body>
    <!-- Overlay panel -->
    <div class="body-overlay"></div>
    <!-- Left panel -->
    <div id="panel-left"></div>
    <div class="page page--main" data-page="main">
        <!-- HEADER -->
        <header class="header header--page header--fixed">
            <div class="header__inner">
                <div class="header__logo header__logo--text"><a href="javascript:void(0)">Aplikasi Monitoring Ibadah</a></div>
                <div class="header__icon open-panel" data-panel="right"><img src="../ladun/assets/images/icons/white/search.svg" alt="" title="" /></div>
            </div>
        </header>
        <!-- PAGE CONTENT -->
        <div class="page__content page__content--with-header page__content--with-bottom-nav" id="mainApp"></div>
        <div style="display:none;margin-left:10%;margin-top:80px;" id="divLoading">
            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_lfirbva8.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
        </div>
    </div>
    <!-- PAGE END -->
    <!-- Bottom navigation -->
    <div id="bottom-toolbar" class="bottom-toolbar"></div>
    <!-- Social Icons Popup -->
    <div id="popup-social"></div>
    <!-- Alert -->
    <div id="popup-alert"></div>
    <!-- Notifications -->
    <div id="popup-notifications"></div>
    <!-- PAGE END -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="../ladun/vendor/jquery/jquery.validate.min.js"></script>
    <script src="../ladun/vendor/swiper/swiper.min.js"></script>
    <script src="../ladun/js/jquery.custom.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>
        var server = "http://localhost/Aplikasi-Mentoring-Ibadah-Front-End/";
        var username = "<?=$_SESSION['userLogin']; ?>";
        var role = "";
    </script>
    <script src="../ladun/js/main-app.js"></script>
</body>

</html>