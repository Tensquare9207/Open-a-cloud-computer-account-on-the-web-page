<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="https://ltyun.top/favicon/favicon.ico">
    <title>蓝天新世界 | 主页</title>
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
@keyframes slideOutToLeft {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100vw);
            }
        }

        .slide-out {
            animation: slideOutToLeft 1s forwards;
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

</style>
<body>
    <div class="full-height">
        <div class="card">
            <div class="card-body">
                <div class="container">
                <img src="https://ltyun.top/1img/lt.png" class="logo" style="  width: 50%; height: auto;">
                    <h1 class="bt">欢迎！</h1>
                  <p>{请填充你的公告}</p>


                  <a href="./enroll.php" class="btn btn-info" role="button" id="register">注册用户</a>
                  <a href="./recover.php" class="btn btn-info" role="button" id="recover">找回密码</a>

                    <br><a class="bq">由 蓝天新世界 提供开源技术 v4.0</a>
                   <!-- <div id="response"></div>--><!--旧版-->
                </div>
                
            </div>
        </div>
    </div>
</body>

</body>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const registerButton = document.getElementById('register');
          
            const fullHeightDiv = document.querySelector('.full-height');

            function slideAndRedirect(url) {
                fullHeightDiv.classList.add('slide-out');
                setTimeout(function() {
                    window.location.href = url;
                }, 2000); // 等待2秒后跳转
            }

            registerButton.addEventListener('click', function(event) {
                event.preventDefault();
                slideAndRedirect(registerButton.href);
            });

           
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const recoverButton = document.getElementById('recover');
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
</html>
<script type="text/javascript" src="./ui/js/jquery.min.js"></script>
<script type="text/javascript" src="./ui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./ui/js/perfect-scrollbar.min.js"></script>
<!--对话框-->
<script src="./ui/js/jconfirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="./ui/js/main.min.js"></script>