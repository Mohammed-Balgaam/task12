<?php
include './nav_dashboard.php';
require_once './model.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $status = $_POST['noteStatus'];
    $note = new model('notes');
    $note->create_nots($title, $description, $date, $status);
    header("Location: dashboard.php");
    exit();
}

?>


<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4 text-center font-weight-bold">إضافة ملاحظة جديدة</h2>
        <form action="add_note.php" method="POST">
            <!-- حقل العنوان -->
            <div class="form-group mb-3">
                <label for="noteTitle" class="font-weight-bold">عنوان الملاحظة</label>
                <input type="text" class="form-control form-control-lg" id="noteTitle" name="title" placeholder="أدخل عنوان الملاحظة">
            </div>

            <!-- حقل الوصف -->
            <div class="form-group mb-3">
                <label for="noteDescription" class="font-weight-bold">وصف الملاحظة</label>
                <textarea class="form-control form-control-lg" id="noteDescription" rows="4" name="description" placeholder="أدخل وصف الملاحظة"></textarea>
            </div>

            <!-- حقل التاريخ -->
            <div class="form-group mb-3">
                <label for="noteDate" class="font-weight-bold">تاريخ الملاحظة</label>
                <input type="date" class="form-control form-control-lg" name="date" id="noteDate">
            </div>

            <!-- حالة الملاحظة (تم أو لم يتم) -->
            <div class="form-group mb-3">
                <label class="font-weight-bold">حالة الملاحظة</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="noteStatus" id="statusDone" value="0">
                    <label class="form-check-label" for="statusDone">
                        تم عملها
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="noteStatus" id="statusNotDone" value="1">
                    <label class="form-check-label" for="statusNotDone">
                        لم يتم عملها
                    </label>
                </div>
            </div>

            <!-- زر الإرسال -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">إضافة الملاحظة</button>
        </form>
    </div>
</div>

<!-- إضافة رابط Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>