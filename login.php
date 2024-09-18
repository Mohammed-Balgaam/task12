<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: #f7f9fc; /* لون الخلفية */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل ناعم */
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333; /* لون العنوان */
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .text-muted {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>تسجيل الدخول</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="أدخل بريدك الإلكتروني">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">تذكرني</label>
            </div>
            <button type="submit" class="btn btn-custom w-100">تسجيل الدخول</button>
            <p class="text-muted mt-3">ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
require_once './model.php';
$login_user = new model('users');
$num_of_error = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(! empty($_POST['email']))
    {
        $email = $_POST['email'];
        if(! empty($_POST['password']))
        {
            $password = $_POST['password'];
        } else
        {
            echo "<div class='alert alert-info'>يرجى ادخال كلمة مرور !</div>";
            $num_of_error += 1;  
            header(header: 'Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit();
        }
    } else
    {
        echo "<div class='alert alert-info'>يرجى تعبئة حقل البريد الالكتروني بالبيانات المطلوبه !</div>";
        $num_of_error += 1;
        header(header: 'Location: ' . $_SERVER['HTTP_REFERER']); // return back
        exit();
    }
    if($num_of_error == 0)
    {
        $user = $login_user->first('email',$email);
        if($user)
        {
            if(password_verify($password , $user['password']))
            {
                setcookie('note',  json_encode($user), time() + (24 * 60 * 60));
                header('location: ./dashboard.php');
                $num_of_error = 0;
                exit();
            }else
            {
                echo "<div class='alert alert-info'>البريد الالكتروني أو كلمة المرور غير صحيحة!</div>";
                $num_of_error += 1;
                header(header: 'Location: '. $_SERVER['HTTP_REFERER']); // return back
                exit();
            }
        }
    }
 
}




?>