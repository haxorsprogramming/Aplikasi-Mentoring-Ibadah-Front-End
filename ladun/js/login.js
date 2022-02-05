// route 
var rProsesLogin = server + "api/auth.php";
var rToDashboard = server + "main-app/index.php";
// vue object 
var app = new Vue({
  el : '#app',
  data : {

  },
  methods : {
    loginProsesAtc : function()
    {
      let username = document.querySelector("#txtUsername").value;
      let password = document.querySelector("#txtPassword").value;
      let ds = {'username':username, 'password':password}
      $.post(rProsesLogin, ds, function(data){
        let obj = JSON.parse(data);
        let status = obj.status;
        if(status === 'NO_USER'){
          ziTo('warning', 'No user', 'Tidak ada user terdaftar !!!');
        }else if(status === 'WRONG_PASSWORD'){
          ziTo('warning', 'Invalid login', 'username / password salah !!!');
        }else{
          localStorage.setItem("username", username);
          window.location.assign(rToDashboard);
        }
      });
    }
  }
});
// inisialisasi 
document.querySelector("#txtUsername").focus();

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
