// route
var rToLogin = "https://api.haxors.or.id/ppdb/proses-login.php";
var rToRegister = "https://api.haxors.or.id/ppdb/proses-registrasi.php";

// vue object
var app = new Vue({
  el: "#app",
  data: {},
  methods: {
    masukAtc: function () {
      login();
    },
    daftarAtc: function () {
      $("#divFormLogin").hide();
      $("#divBtnDaftar").hide();
      $("#divFormDaftar").show();
      document.querySelector("#divCapForgotPassword").innerHTML =
        'Sudah punya akun? silahkan <a href="javascript:void(0)">Login</a>';
      document.querySelector("#txt_nisn_reg").focus();
    },
    daftarProsesAtc: function () {
      daftarProses();
    },
  },
});

// inisialisasi
document.querySelector("#txt_nisn").focus();

function login() {
  let nisn = document.querySelector("#txt_nisn").value;
  let password = document.querySelector("#txt_password").value;
  let ds = { 'nisn': nisn, 'password': password };
  if (nisn === "" || password === "") {
    ziTo("warning", "Fill field!!!", "Harap lengkapi field yang ada ...");
  } else {
    $.post(rToLogin, ds, function (data) {
      let obj = JSON.parse(data);
      let status = obj.status_login;
      console.log(obj);
      if (status === 'success') {
        localStorage.setItem("username", nisn);
        window.location.assign("main-app/index.html");
      } else {
        ziTo("error", "Invalid login !!!", "Username & password salah ...");
      }
    });
  }
}

function daftarProses() {
  let nisn = document.querySelector("#txt_nisn_reg").value;
  let password = document.querySelector("#txt_password_reg").value;
  let ds = { 'nisn':nisn, 'password':password };
  $('#div_status_pendaftaran').hide();
  $('#div_btn_daftar').show();
  if(nisn === '' || password === ''){
    window.alert("Harap isi data kamu ..");
  }else{
    $.post(rToRegister, ds, function (data) {
    let obj = JSON.parse(data);
    let status = obj.status;
    console.log(status);
    if (status === "no_nisn") {
      ziTo("warning", "Invalid ID", "NIK / NISN tidak terdaftar !!! ");
      $('#div_status_pendaftaran').show();
      $('#div_btn_daftar').hide();
    } else if (status === "nisn_in_use") {
      ziTo("warning", "ID in use", "NIK / NISN telah di gunakan !!! ");
      $('#div_status_pendaftaran').show();
      $('#div_btn_daftar').hide();
    } else {
      document.querySelector("#txt_nisn_reg").value = "";
      document.querySelector("#txt_password_reg").value = "";
      window.alert("Pendaftaran berhasil, silahkan login dengan akun yg telah dibuat ...");
      document.querySelector("#txt_nisn").focus();
      $("#divFormLogin").show();
      $("#divBtnDaftar").show();
      $("#divFormDaftar").hide();
    }
  });
  } 
  
}

function pesanUmumApp(icon, title, text)
{
  Swal.fire({
    icon : icon,
    title : title,
    text : text
  });
}

function ziTo(tipe, judul, message) {
  if (tipe === "info") {
  } else if (tipe === "success") {
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
