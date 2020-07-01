<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
  header('Location:index.php');
  exit;
} else {


?>

  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <!-- Start Delete category -->
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM categories WHERE id = '$id'";
    $delete = mysqli_query($con, $query);
  }
  ?>
  <!-- End Delete category -->

  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    if (empty($category)) {
      $catErro =  "<div class='alert alert-danger'>" . "الرجاء ملء الحقل أدناه" . "</div>";
    } else {
      $query = "INSERT INTO categories(categoryName) VALUES('$category')";
      $result = mysqli_query($con, $query);
      if (isset($result)) {
        $catSuccess =  "<div class='alert alert-success'>" . "تم إضافة التصنيف بنجاح" . "</div>";
      }
    }
  }

  ?>

  <div class="container-fluid">
    <!-- Start categories section -->
    <div class="categories">
      <?php
      if (isset($catErro)) {
        echo $catErro;
      }
      if (isset($catSuccess)) {
        echo $catSuccess;
      }
      ?>
      <div class="add-cat">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <label for="cat">إضافة تصنيف :</label>
            <input type="text" id="cat" class="form-control" name="category">
          </div>
          <button class="custom-btn">إضافة</button>
        </form>
      </div>
      <div class="show-cat">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">الرقم</th>
              <th scope="col">عنوان التصنيف</th>
              <th scope="col">تاريخ الإضافة</th>
              <th scope="col">الإجراء</th>
            </tr>
          </thead>
          <tbody>
            <!-- Fetch categories from database -->
            <?php
            $query = "SELECT * FROM categories ORDER BY id DESC";
            $res = mysqli_query($con, $query);
            $sNo = 0;
            while ($row = mysqli_fetch_assoc($res)) {
              $sNo++;
            ?>

              <tr>
                <td><?php echo $sNo; ?></td>
                <td><?php echo $row['categoryName']; ?></td>
                <td><?php echo $row['categoryDate']; ?></td>
                <td>
                  <a href="edit-cat.php?id=<?php echo $row['id']; ?>" class="custom-btn">تعديل</a>
                  <a href="categories.php?id=<?php echo $row['id']; ?>" class="custom-btn">حذف</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- End categories section -->
  </div>
  <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <?php
  include 'include/footer.php';
  ?>

<?php
}
?>