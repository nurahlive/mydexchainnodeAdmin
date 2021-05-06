$(function () {
  $("#btn_login").click(function () {
    var form = $('#frmLogin')[0];
    var datas = new FormData(form);
    $.ajax({
      type:"POST",
      data: datas,
      dataType:"json",
      processData: false,
      contentType: false,
      cache: false,
      url: "/process/login.php",
      success: function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?main";
            }
          })

        }else{
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text
          });
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: msg.icon,
          title: msg.title,
          text: msg.text
        });

      }
    });
    return false;

  });

});
