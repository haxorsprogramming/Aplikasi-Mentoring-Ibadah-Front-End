loadPage('beranda.php');

function botNavAtc() {
  console.log(username);
}

function ziTo(tipe, judul, message) {
  if (tipe === "info") {
  } else if (tipe === "success") {
    iziToast.success({
      title: judul,
      message: message,
      position: "bottomCenter",
      timeout: 1000,
      pauseOnHover: false,
      onClosed: function () {},
    });
  } else if (tipe === "warning") {
    iziToast.error({
      title: judul,
      message: message,
      position: "bottomCenter",
      timeout: 1000,
      pauseOnHover: false,
      onClosed: function () {},
    });
  } else if (tipe === "error") {
    iziToast.error({
      title: judul,
      message: message,
      position: "bottomCenter",
      timeout: 1000,
      pauseOnHover: false,
      onClosed: function () {},
    });
  }
}

function loadPage(page)
{
  $("#mainApp").hide();
  $("#divLoading").show();
  setTimeout(function(){
    $("#divLoading").hide();
    $("#mainApp").load(page);
    $("#mainApp").show();
  }, 2000);
  
}

function pesanUmumApp(icon, title, text) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
  });
}

function tidur_bentar(ms){
  return new Promise(resolve => { setTimeout(resolve, ms) });
}