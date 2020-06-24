<?php
    session_start();
    include 'include/connection.php';
    include 'include/header.php';
    if(!isset($_SESSION['adminInfo'])){
        header('Location:index.php');
    }
else{
    

  ?>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

  <div class="container-fluid">
    <!-- Start add category -->
    <div class="categories">
        <form>
          <div class="form-group">
               <label for="cat">إضافة تصنيف</label>
                <input type="text" id="cat" class="form-control"/>
            </div>
            <button class="custom-btn">إضافة</button>
        </form>
        
    </div>
    <!-- End add category -->
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