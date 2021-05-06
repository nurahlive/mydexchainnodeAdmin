$(function () {
  //   servis Add button start;
  $("#btnServisAdd").click(function () {
    var form = $('#frmServisAdd')[0];
    var datas = new FormData(form);
    $.ajax({
      type:"POST",
      enctype: 'multipart/form-data',
      data: datas,
      dataType:"json",
      processData: false,
      contentType: false,
      cache: false,
      url: "/process/servisAdd.php",
      success: function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?orders";
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
          icon: 'error',
          title: "Hata Meydana geldi",
          text: 'Bilgiler Eksik veya  hatalı veri türü girişi'
        });

      }
    });
    return false;
  });
  //   servis Add button  ende;

  //  order Confirm start;
  //

  //  order Confirm    ende;

   // product  status change Start;
  $("a[name=productDisaple]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='status=0&productId='+id;

    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/procductStatusChange.php",
      success:function (msg) {
        if (msg.status==1){

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?productPackets";
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
        alert('Hata Meydana Geldi');
      }

    });
    return  false;
  });
   // product  status change ende;
   // product  status change satisa ac start;;
  $("a[name=productEnable]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='status=1&productId='+id;

    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/procductStatusChange.php",
      success:function (msg) {
        if (msg.status==1){

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?productPackets";
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
        alert('Hata Meydana Geldi');
      }

    });
    return  false;
  });
   // product  status change satisa ac  ende; ;


});
