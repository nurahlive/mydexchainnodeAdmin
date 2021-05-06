$(function () {
      //  Manuel Container  setup  start;

    $("#btnManuelContainerSetup").click(function () {
        var form = $('#frmManuelContainerSetup')[0];
        var datas = new FormData(form);

        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            data: datas,
            dataType:"json",
            processData: false,
            contentType: false,
            cache: false,
            url: "/process/manuelContainerSetup.php",
            success: function (msg) {
                if (msg.status==1){
                    $('#manuelContainerRespond').html(msg);
                    Swal.fire({
                        icon: msg.icon,
                        title: msg.title,
                        text: msg.text,
                        confirmButtonText: "Tamam!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/?manuelContainerSetup";
                        }
                    })

                }else{
                    $('#manuelContainerRespond').html(msg);
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
      //  Manuel Container  setup  ende;
     // master  pool save start;
    $("#btnMasterPoolSave").click(function () {
        var form = $('#frmMasterPoolKey')[0];
        var datas = new FormData(form);
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            data: datas,
            dataType:"json",
            processData: false,
            contentType: false,
            cache: false,
            url: "/process/masterPoolSave.php",
            success: function (msg) {
                if (msg.status==1){
                    Swal.fire({
                        icon: msg.icon,
                        title: msg.title,
                        text: msg.text,
                        confirmButtonText: "Tamam!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/?masterTrakerPool";
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
     // master  pool save  ende;
    // private Server Setup Start;
    $("#btnPrivateNodeSetup").click(function () {
        var form = $('#frmPrivateNodeSetup')[0];
        var datas = new FormData(form);

        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            data: datas,
            dataType:"json",
            processData: false,
            contentType: false,
            cache: false,
            url: "/process/PrivateNodeSetup.php",
            success: function (msg) {
                if (msg.status==1){
                    Swal.fire({
                        icon: msg.icon,
                        title: msg.title,
                        text: msg.text,
                        confirmButtonText: "Tamam!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/?servers";
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
    // private Server Setup  ende;
    //order confirm start;
    $("a[name=orderConfirm]").click(function(){
        var element = $(this);
        var id = element.attr("id");
        var postData='orderId='+id;

        $.ajax({
            type:"POST",
            data : postData,
            datatype: "json",
            url:"/process/orderConfirm.php",
            success:function (msg) {
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
                        text: msg.text,
                        confirmButtonText: "Tamam!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/?orders";
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
                        location.href = "/?orders";
                    }
                })
            }

        });
        return  false;
    });
    //order confirm  ende;
    // server add start;
    $("#btnServerAdd").click(function () {
        var form = $('#frmServerAdd')[0];
        var datas = new FormData(form);
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            data: datas,
            dataType:"json",
            processData: false,
            contentType: false,
            cache: false,
            url: "/process/serverAdd.php",
            success: function (msg) {
                if (msg.status==1){
                    Swal.fire({
                        icon: msg.icon,
                        title: msg.title,
                        text: msg.text,
                        confirmButtonText: "Tamam!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/?servers";
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
    // server add ende;
    // procduct add start;
    $("#btnProductAdd").click(function () {
        var form = $('#frmProductAdd')[0];
        var datas = new FormData(form);
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            data: datas,
            dataType:"json",
            processData: false,
            contentType: false,
            cache: false,
            url: "/process/productAdd.php",
            success: function (msg) {
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
                Swal.fire({
                    icon: 'error',
                    title: "Hata Meydana geldi",
                    text: 'Bilgiler Eksik veya  hatalı veri türü girişi'
                });

            }
        });
        return false;
    });
    // procduct add  ende;



});
