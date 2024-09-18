<?php
include 'nav_dashboard.php';
require_once 'model.php';
$note = new Model('notes');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <img class="background" src="./img/1.jpg" alt="">



    <div class="container mt-5">
        <div class="row">
            <!-- البطاقة الأولى -->
             <?php $notes = $note->all(); 
             foreach($notes as $not)
             {
             ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $not['title']; ?></h5>
                                <p class="card-text"><?php echo $not['description']; ?></p>
                                <h5><?php echo $not['date']; ?></h5>
                                <h5><?php if($not['done']==0)
                                {
                                 echo 'تم عمل التاسك بنجاح'; 
                                } else
                                {
                                     echo 'لم يتم عمله بعد !';
                                }
                                ?></h5>
                            </div>
                        </div>
                    </div>
      <?php }?>
        </div>
</div>

<!-- إضافة رابط Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php
    include 'footer.php';

?>