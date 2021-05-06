<<<<<<< HEAD
=======
$(function () {
  //ONHOLD PACKAGE START;
  // ref cancel start;
  $("a[name=referanceCancel]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=Cancel&referanceId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/ReferanceProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?referanceEarning";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?referanceEarning";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?referanceEarning";
          }
        })
      }

    });
    return  false;
  });
  // ref cancel  ende;
  //  ref confirm start;
  $("a[name=referanceConfirm]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=Confirm&referanceId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/ReferanceProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?referanceEarning";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?referanceEarning";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?referanceEarning";
          }
        })
      }

    });
    return  false;
  });
  //  ref confirm  ende;
  // onhold  package   cancel start;
  $("a[name=packageCancel]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=packageCancel&packageId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/packageProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdPakets";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdPakets";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdPakets";
          }
        })
      }

    });
    return  false;
  });
  // onhold  package   cancel  end;
  // onhold package confirm start;
  $("a[name=packageConfirm]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=packageConfirm&packageId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/packageProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdPakets";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdPakets";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdPakets";
          }
        })
      }

    });
    return  false;
  });
  // onhold package confirm ende;

  //ONHOLD PACKAGE ENDE;
    //ONHOLD WİTDDRAW START;
  // onhold witdraw cancel start;
  $("a[name=witdrawCancel]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=witdrawCancel&witdrawId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/witdrawProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdwitdraw";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdwitdraw";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdwitdraw";
          }
        })
      }

    });
    return  false;
  });
  // onhold witdraw cancel  ende;
  //onhol witdraw confirm start;
  $("a[name=witdrawConfirm]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=witdrawConfirm&witdrawId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/witdrawProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdwitdraw";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdwitdraw";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdwitdraw";
          }
        })
      }

    });
    return  false;
  });

  //onhol witdraw confirm   ende;
    //ONHOLD WİTDDRAW ENDE;
  //  ONHOLD  DEPOSTİ START;

     // cancel deposit Start;
  $("a[name=depositCancel]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=depositCancel&depositId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/depositProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdDeposit";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdDeposit";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdDeposit";
          }
        })
      }

    });
    return  false;
  });
     // cancel deposit   ende;
  // onhold Deposit Confirm start;
  $("a[name=depositConfirm]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=depositAdd&depositId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/depositProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdDeposit";
            }
          })
        }else{

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?onholdDeposit";
            }
          })
        }

      },
      error: function (msg) {
        Swal.fire({
          icon: 'error',
          title: 'Hata Meydana Geldi',
          text: 'Hata Meydana Geldi',
          confirmButtonText: "Tamam!",
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = "/?onholdDeposit";
          }
        })
      }

    });
    return  false;

  });
  // onhold Deposit Confirm  ende;
  //  ONHOLD  DEPOSTİ  ENDE;

  //  INVEST PACKETS START;

  // invest package  delete start;

  $("a[name=investPackageDelete]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=delete&investPackageId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/investPackageProcess.php",
      success:function (msg) {
        if (msg.status==1){

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?investPackets";
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
  // invest package  delete  ende;

  // invest package add start;
    $("#btnInvestAdd").click(function () {
      var form = $('#frminvestPackets')[0];
      var datas = new FormData(form);
      $.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        data: datas,
        dataType:"json",
        processData: false,
        contentType: false,
        cache: false,
        url: "/process/investAdd.php",
        success: function (msg) {
          if (msg.status==1){
            Swal.fire({
              icon: msg.icon,
              title: msg.title,
              text: msg.text,
              confirmButtonText: "Tamam!",
            }).then((result) => {
              if (result.isConfirmed) {
                location.href = "/?investPackets";
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
  // invest package add ende;
  //  INVEST PACKETS  ENDE;
  // COİN START;
   // coin delete start;
  $("a[name=coinDelete]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=delete&coinsId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/coinProcess.php",
      success:function (msg) {
        if (msg.status==1){

          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?coins";
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
   // coin delete  ende;

  // coin add start;
  $("#btnCoinAdd").click(function () {
    var form = $('#frmcoin')[0];
    var datas = new FormData(form);
    $.ajax({
      type:"POST",
      enctype: 'multipart/form-data',
      data: datas,
      dataType:"json",
      processData: false,
      contentType: false,
      cache: false,
      url: "/process/coinAdd.php",
      success: function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?coins";
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
  // coin add ende;
  // COİN  ENDE;

  // EXCHANGE START;

  //   exchange status cahange  start;
  $("a[name=exchangeChangeStatus]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=changeStatus&changeId='+id;
    $.ajax({
      type:"POST",
      data : postData,
      datatype: "json",
      url:"/process/exchangeProcess.php",
      success:function (msg) {
        if (msg.status==1){
          Swal.fire({
            icon: msg.icon,
            title: msg.title,
            text: msg.text,
            confirmButtonText: "Tamam!",
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "/?exchange";
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

  //   exchange status cahange  end;
  // exchange   delete start;
  $("a[name=exchangeDelete]").click(function(){
    var element = $(this);
    var id = element.attr("id");
    var postData='type=delete&exchangeId='+id;
     $.ajax({
       type:"POST",
       data : postData,
       datatype: "json",
       url:"/process/exchangeProcess.php",
       success:function (msg) {
         if (msg.status==1){

           Swal.fire({
             icon: msg.icon,
             title: msg.title,
             text: msg.text,
             confirmButtonText: "Tamam!",
           }).then((result) => {
             if (result.isConfirmed) {
               location.href = "/?exchange";
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
  // exchange   delete  nede;
   //  exchange add start;
   $("#bntExchangeAdd").click(function () {
     $.ajax({
       type : "POST",
       data : $('#frmExchange').serialize(),
       datatype: "json",
       url : "/process/exchangeAdd.php",
       success : function (msg){
         if (msg.status==1){

           Swal.fire({
             icon: msg.icon,
             title: msg.title,
             text: msg.text,
             confirmButtonText: "Tamam!",
           }).then((result) => {
             if (result.isConfirmed) {
               location.href = "/?exchange";
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
       error : function (msg){

         alert('hata meydana geldi');

       }

     });
     return false;
   });
   //  exchange add  ende;
// EXCHANGE ENDE;

});
>>>>>>> b05cee1d97e6c0896ce44ecff90ed8d49ed7fdd3
