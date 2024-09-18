


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: #f0f2f5; /* لون الخلفية */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* ظل خفيف */
            max-width: 400px;
            width: 100%;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333; /* لون العنوان */
            text-align: center;
        }
        .btn-custom {
            background-color: #28a745; /* لون الزر أخضر */
            border-color: #28a745;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: none;
        }
        .text-muted {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>تسجيل حساب جديد</h2>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">الاسم الكامل</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك الكامل">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="أدخل بريدك الإلكتروني">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور">
            </div>
            <button type="submit" class="btn btn-custom w-100">تسجيل</button>
            <p class="text-muted mt-3">لديك حساب؟ <a href="login.php">تسجيل الدخول</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
require_once './model.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(! empty($_POST['name']))
    {
        $name = $_POST['name'];
        if(! empty($_POST['email']))
        {
            $email = $_POST['email'];
            if(! empty($_POST['password']))
            {
                $password = $_POST['password'];
            }else
            {
                echo "<div class='alert alert-info z-index'>يرجئ ادخال كلمة مروور !</div>";
            }
        }else
        {
            echo "<div class='alert alert-info z-index'>يرجئ تعبئة حقل البريد الالكتروني بالبيانات المطلوبه !</div>";
        }
    }else
    {
        echo "<div class='alert alert-info z-index'>يرجئ تعبئة حقل الاسم بالبيانات المطلوبه !</div>"; 
    }
    $num_of_error = 0;
    if(strlen($name) > 6)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            if (strlen($password) < 8) {
                echo "<div class='alert alert-info z-index'>كلمة المرور يجب أن تكون أكبر من 8 أحرف.</div>";
                $num_of_error +=1;
            }
    
            // التحقق من وجود حرف كبير
            if (!preg_match('/[A-Z]/', $password)) {
                echo "<div class='alert alert-info z-index'>كلمة المرور يجب أن تحتوي على حرف كبير واحد على الأقل.</div>";
                $num_of_error +=1;
            }
    
            // التحقق من وجود حرف صغير
            if (!preg_match('/[a-z]/', $password)) {
                echo "<div class='alert alert-info z-index'>كلمة المرور يجب أن تحتوي على حرف صغير واحد على الأقل.</div>";
                $num_of_error +=1;
            }
    
            // التحقق من وجود رقم
            if (!preg_match('/[0-9]/', $password)) {
                echo "<div class='alert alert-info z-index'>كلمة المرور يجب أن تحتوي على رقم واحد على الأقل.</div>";
                $num_of_error +=1;
            }
    
            // التحقق من وجود رمز خاص
            if (!preg_match('/[\W]/', $password)) {
                echo "<div class='alert alert-info z-index'>كلمة المرور يجب أن تحتوي على رمز واحد على الأقل مثل @ أو #.</div>";
                $num_of_error +=1;
            }
        }else
        {
            echo "<div class='alert alert-info z-index'>البريد الالكتروني غير صالح يرجئ ادخال بريد الكتروني صالح !</div>";
            $num_of_error +=1;
        }
    }else
    {
        echo "<div class='alert alert-info z-index'>الاسم الذي ادخلته اصغر من 6 احرف يرجئ ادخال 7 احرف علئ الاقل !</div>";
        $num_of_error +=1;
    }


    if($num_of_error == 0)
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $new_user = new model('users');
        $new_user->create($name,$email, $password_hash);
        //  header('refresh: ');
        echo "<div class='alert alert-info z-index'> تم تسحيلك بنجااح سوف يتم تحويلك بعد قليل !</div>";

        header("refresh:3;url=login.php");
        exit;
        $num_of_error = 0;  
    }else
    {
        echo "<div class='alert alert-info z-index'>حدث خطأ ما في التسجيل.</div>";
    }
}

?>