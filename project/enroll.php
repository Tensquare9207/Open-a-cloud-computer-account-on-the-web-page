<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="http://ltyun.top/favicon/favicon.ico">
    <title>蓝天新世界 | 用户创建</title>
    <link href="./ui/css/bootstrap.min.css" rel="stylesheet">
<link href="./ui/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="./ui/js/jconfirm/jquery-confirm.min.css">
<link href="./ui/css/style.min.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">-->
</head>
<!--动画组-->
<style>
.logo {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.1s; 
  }   
  .bt {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.2s; 
  }   
  .yh {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.2s; 
  }   
  #username {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.3s; 
  }   
  .mm {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.4s; 
  }   
  #password {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.4s; 
  }  
  .yx {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.5s; 
  }  
  .QQ {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.6s; 
  }  
  .yzm {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.7s; 
  }    
  #captcha {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.7s; 
  }  
  .captcha-container {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.7s; 
  }    
  .verification {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.8s; 
  }    
  .btn-info {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.9s; 
  }    
  .btn-danger {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 0.9s; 
  }  
  .bq {  
    position: relative;  
    top: 20px;
    opacity: 0;
    animation: slideIn 0.5s ease-out forwards 1.0s; 
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
  @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

   
    .card {
        animation: fadeIn 1.5s ease-in-out forwards; 
    }
/*@keyframes slideOut {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}

.slide-out {
    animation: slideOut 1s forwards;
}*//* 可以试试这个dogo*/
@keyframes slideOut {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100vw);
    }
}

.slide-out {
    animation: slideOut 1s forwards;
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
</style>
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
        padding: 10px;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
       /* padding: 10px;*/
       /* margin-bottom: 10px;*/
        position: relative;
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
    }
    .send_verification-btn:hover {
    background-color: #7CFC00; 
}

.send_verification-btn:active {
    background-color: #98FB98;
}
</style>
<body>
    <div class="full-height">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <img src="https://ltyun.top/1img/lt.png" class="logo" style="  width: 50%; height: auto;">
                    <h1 class="bt">创建 Windows 用户</h1>
                    <form id="userForm">
                        <label for="username" class="yh">用户名:</label>
                        <input type="text" id="username" name="username" required class="form-control">
                        <label for="password" class="mm">密码:</label>
                        <input type="password" id="password" name="password" required class="form-control">
                        <label for="email" class="yx">邮箱:</label>
                        <input type="email" id="email" name="email" required class="form-control yx">
                        <label for="QQ" class="QQ">QQ:</label>
                        <input type="number" id="QQ" name="QQ" required class="form-control QQ">
                        <label for="captcha" class="yzm">验证码:</label>
                        <div class="captcha-container">
                            <input type="text" id="captcha" name="captcha" required class="form-control captcha-input">
                            <img src="captcha.php" id="captchaImage" alt="验证码" onclick="this.src='captcha.php?' + new Date().getTime();" class="captcha-image">
                        </div>
                        <label for="send_verification" class="verification">邮箱验证码:</label>
                            <div class="send_verification-container verification">
                            <input type="text" id="code" name="code" required class="form-control">
                     <button type="button" class="btn send_verification-btn" id="captchabt">发送验证码<span id="countdown" class="countdown" style="margin-left: 10px;display: none;"></span></button>
                            </div>
                        <button type="submit" class="btn btn-info">创建用户<!--<i class="fa fa-check-square"></i>--></button>
                        <a href="./" class="btn btn-danger" role="button" id="back">返回</a>
                    </form>
                    <a class="bq">由 蓝天新世界 提供开源技术 v4.0</a>
                   <!-- <div id="response"></div>--><!--旧版-->
                </div>
                
            </div>
        </div>
    </div>
</body>

</body>
<script>
document.getElementById('captchabt').addEventListener('click', function(event) {
    event.preventDefault(); // 阻止默认表单提交行为
 // 禁用按钮  
 this.disabled = true;  
    // 显示倒计时  
    var countdownSpan = document.getElementById('countdown');  
    countdownSpan.textContent = '60s';  
    countdownSpan.style.display = 'inline-block';  
  
    // 设置倒计时  
    var countdown = 60;  
    var intervalId = setInterval(function() {  
        countdown--;  
        countdownSpan.textContent = countdown + 's';  
  
        if (countdown <= 0) {  
            // 倒计时结束，重置按钮和倒计时显示  
            clearInterval(intervalId);  
            this.disabled = false;  
            countdownSpan.textContent = '';  
            countdownSpan.style.display = 'none';  
        }  
    }.bind(this), 1000);
    fetch('./php/send_verification.php', {
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
<script>
document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const captcha = document.getElementById('captcha').value;
    const code = document.getElementById('code').value;
    const email = document.getElementById('email').value;
    const QQ = document.getElementById('QQ').value;
    if (username.includes(' ')) {
        $.confirm({
            title: '警告',
            content: '用户名不能包含空格。',
            type: 'orange',
            buttons: {
                confirm: {
                    text: '了解！',
                    btnClass: 'btn-orange',
                    action: function () {
                        document.getElementById('username').focus();
                    }
                }
            }
        });
        return;
    }
    fetch('create_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'username': username,
            'password': password,
            'captcha': captcha,
            'email': email,
            'QQ': QQ,
            'code': code
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
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
                              
                                document.querySelector('.card').classList.add('slide-out');
                          }, 1000); 
                            setTimeout(function() {
                              
                                window.location.href = 'ok.php';
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
            content: '发生错误: ' + error,
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


</script><!---旧版-->
   <!-- <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const captcha = document.getElementById('captcha').value;
            fetch('create_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'username': username,
                    'password': password,
                    'captcha': captcha
                })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('response').innerText = data;
                document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
                
            })
            .catch(error => {
                document.getElementById('response').innerText = '发生错误: ' + error;
                document.getElementById('captchaImage').src = 'captcha.php?' + new Date().getTime();
            });
        });
    </script>-->
</body>
</html>
<script type="text/javascript" src="./ui/js/jquery.min.js"></script>
<script type="text/javascript" src="./ui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./ui/js/perfect-scrollbar.min.js"></script>
<!--对话框-->
<script src="./ui/js/jconfirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="./ui/js/main.min.js"></script>