<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="https://ltyun.top/favicon/favicon.ico">
    <title>蓝天新世界 | 找回密码</title>
    <link href="./ui/css/bootstrap.min.css" rel="stylesheet">
<link href="./ui/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="./ui/js/jconfirm/jquery-confirm.min.css">
<link href="./ui/css/style.min.css" rel="stylesheet">

</head>
<!--动画组-->
<style>


.logo {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.1s; 
  }   
 

   @keyframes slideIn {  
    0% {  
      top: 20px;  
      opacity: 0;  
    }  
    100% {  
      top: 0;  
      opacity: 1;  
    }  
  }  

@keyframes slideInFromRight {
    0% {
      /*  transform: translateX(100%);*//*不太建议我觉得可以这样！*/
       /* opacity: 0;*/
       transform: translateX(100vw);
       opacity: 1;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-in {
    animation: slideInFromRight 1s forwards; /* 0.5秒的动画，完成后保持最后的状态 *//** 建议1秒*/
}

@keyframes slideOutToRight {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(100vw);
            }
        }

        .slide-out-left {
            animation: slideOutToRight 1s forwards;
        }
        .slide-out {
    animation: slideOut 1s forwards;
}
@keyframes slideOut {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100vw);
    }
}
</style>
<script>
  
    document.addEventListener("DOMContentLoaded", function() {
        const card = document.querySelector('.card');
        card.classList.remove('animate-in'); 
        card.style.animation = 'slideInFromRight 0.5s forwards';
    });
</script>

<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    body {
    padding: 0;
    font-family: Arial, sans-serif;
    background-size: cover;
}
body {
    background-image: url('https://ltyun.top/1img/boats-564922_1280.jpg'); 
            background-size: 120%;
            background-attachment: fixed;
        }
        
     
        @media only screen and (max-width: 600px) {
            body {
                background-size: cover;
        
            }
        }
    .full-height {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .card {
        width: 100%;
        max-width: 500px;
        box-sizing: border-box;
        padding: 20px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        cursor: pointer;
    }

    .container {
        width: 100%;
        padding: 0 10px;
        box-sizing: border-box;
    }
    .card {
    width: 100%;
    max-width: 500px;
    box-sizing: border-box;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px); 
}
.form-control {
        width: 100%;
        box-sizing: border-box;
       /* padding: 10px;*/
       /* margin-bottom: 10px;*/
        position: relative;
    }
.send_verification-container {
        position: relative;
        width: 100%;
    }

    .send_verification-input {
        padding-right: 120px; /* 调整输入框的宽度以适应按钮 */
    }

    .send_verification-btn {
        position: absolute;
        right: 10px; 
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        border-radius: 2px;
        padding: 7px 14px; 
        background-color: #90EE90;
        transition: background-color 0.3s;
        top: 19px;
    }
    .send_verification-btn:hover {
    background-color: #7CFC00; 
}

.send_verification-btn:active {
    background-color: #98FB98;
}

.captcha-container {
        position: relative;
        width: 100%;
    }

    .captcha-input {
        padding-right: 90px; 
    }

    .captcha-image {
        position: absolute;
        right: 10px; 
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        border-radius: 2px;
        width: 80px;
        height: 30px;
    }

</style>
<body>
    <div class="full-height">
        <div class="card">
            <div class="card-body">
                <div class="container">
                <img src="https://ltyun.top/1img/lt.png" class="logo" style="  width: 50%; height: auto;">
                    <h1 class="bt">找回密码</h1>
                    <form id="userForm">
                            
                    <label for="username" class="yx">原用户名:</label>
                    <input type="text" id="username" name="username" required class="form-control yx">
                    <label for="email" class="yx">原邮箱:</label>
                    <input type="email" id="email" name="email" required class="form-control yx">
                    <label for="password" class="yx">新密码:</label>
                    <input type="password" id="password" name="password" required class="form-control yx">
                    <label for="captcha" class="yzm">验证码:</label>
                        <div class="captcha-container">
                            <input type="text" id="captcha" name="captcha" required class="form-control captcha-input">
                            <img src="captcha.php" id="captchaImage" alt="验证码" onclick="this.src='captcha.php?' + new Date().getTime();" class="captcha-image">
                        </div>
                    <label for="send_verification" class="verification">邮箱验证码:</label>
                            <div class="send_verification-container verification">
                            <input type="text" id="code" name="code" required class="form-control">
                     <button type="button" class="btn send_verification-btn" id="captchabt">发送验证码<span id="countdown" class="countdown" style="margin-left: 10px;display: none;"></span></button>
                 </from>


                        <button class="btn btn-info" role="button">提交</button>
                        <a href="./" class="btn btn-danger" role="button" id="back">返回</a>
                    <br><a class="bq">由 蓝天新世界 提供开源技术 v4.0</a>
                   <!-- <div id="response"></div>--><!--旧版-->
                </div>
                
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const recoverButton = document.getElementById('back');
        const fullHeightDiv = document.querySelector('.full-height');

        function slideAndRedirect(url) {
            fullHeightDiv.classList.add('slide-out-left'); 
            setTimeout(function() {
                window.location.href = url;
            }, 2000); 
        }

        recoverButton.addEventListener('click', function(event) {
            event.preventDefault(); 
            slideAndRedirect(recoverButton.href); 
        });
    });
</script>
</body>

</body>
</html>
<script>
document.getElementById('captchabt').addEventListener('click', function(event) {
    event.preventDefault(); 

 this.disabled = true;  
 
    var countdownSpan = document.getElementById('countdown');  
    countdownSpan.textContent = '60s';  
    countdownSpan.style.display = 'inline-block';  
  
 
    var countdown = 60;  
    var intervalId = setInterval(function() {  
        countdown--;  
        countdownSpan.textContent = countdown + 's';  
  
        if (countdown <= 0) {  
            
            clearInterval(intervalId);  
            this.disabled = false;  
            countdownSpan.textContent = '';  
            countdownSpan.style.display = 'none';  
        }  
    }.bind(this), 1000);
    fetch('./php/send_verification_email.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'email=' + encodeURIComponent(document.getElementById('email').value) + '&captcha=' + encodeURIComponent(document.getElementById('captcha').value)

    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
     


          $.confirm({
                title: '成功',
                content: data.message,
                type: 'green',
                buttons: {
                    confirm: {
                        text: '好！',
                        btnClass: 'btn-green',
                       
                    }
                }
            });


        } else {
        



          $.confirm({
                title: '失败',
                content: data.message,
                type: 'red',
                action: function () {
                            document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
                        },
                buttons: {
                    confirm: {
                        text: '好！',
                        btnClass: 'btn-red',
                       
                    }
                }
            });

          clearInterval(intervalId);  
            this.disabled = false;  
            countdownSpan.textContent = '';  
            countdownSpan.style.display = 'none';  
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>
<script>
document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

  
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var code = document.getElementById('code').value;
    var captcha = document.getElementById('captcha').value;
    var username = document.getElementById('username').value;

    var formData = {
        email: email,
        password: password,
        captcha: captcha,
        username: username,
        code: code
    };

 
    var querystring = Object.keys(formData).map(function(key) {
        return encodeURIComponent(key) + '=' + encodeURIComponent(formData[key]);
    }).join('&');

    fetch('./update_password.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: querystring
    })
    .then(response => response.json())
    .then(data => {
      
        if (data.status === 'success') {
          
            $.confirm({
                title: '成功',
                content: data.message,
                type: 'green',
                buttons: {
                    confirm: {
                        text: '好！',
                        btnClass: 'btn-green',
                        action: function () {
                            document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
                            setTimeout(function() {
                                document.querySelector('.full-height').classList.add('slide-out');
                            }, 1000); 
                            setTimeout(function() {
                               window.location.href = 'ok-recover.php';
                            }, 2000); 
                        }
                    }
                }
            });
        } else {
        
            $.confirm({
                title: '失败',
                content: data.message,
                type: 'red',
                buttons: {
                    confirm: {
                        text: '确定！',
                        btnClass: 'btn-red',
                        action: function () {
                            document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
                        }
                    }
                }
            });
        }
    })
    .catch(error => {
        $.confirm({
            title: '错误',
            content: '发生错误: ' + error.message,
            buttons: {
                confirm: {
                    text: '确定！',
                    action: function () {
                        document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
                    }
                }
            }
        });
    });
});

</script>

<script type="text/javascript" src="./ui/js/jquery.min.js"></script>
<script type="text/javascript" src="./ui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./ui/js/perfect-scrollbar.min.js"></script>
<!--对话框-->
<script src="./ui/js/jconfirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="./ui/js/main.min.js"></script>