<?php
require('inc.top.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
{
  $id=getsafe_value($con,$_GET['id']);
  $res=mysqli_query($con,"select * from categories_tbl where id='$id'");
  $check=mysqli_num_rows($res);
  if($check>0)
  {
  
  $row=mysqli_fetch_assoc($res);
  $categories=$row['categories'];
}
else
{
   header('location:categories_m.php');
  die();
}
}
if(isset($_POST['submit']))
{
  $categories=getsafe_value($con,$_POST['categories']);
  $res=mysqli_query($con,"select * from categories_tbl where categories='$categories'");
  $check=mysqli_num_rows($res);
  if($check>0)
  {
    if(isset($_GET['id']) && $_GET['id']!='')
    {
$getData=mysqli_fetch_assoc($res);
if($id==$getData['id'])
{

}
    
  
  else
  {
    $msg="Categories already exist";
}
  }
  else
  {
    $msg="Categories already exist";
  }
}
  if($msg=='')
  {


  if(isset($_GET['id']) && $_GET['id']!='')
  {
mysqli_query($con,"update categories_tbl set categories='$categories' where id='$id'");
  }
  else
  {
    mysqli_query($con,"insert into categories_tbl(categories,status) values('$categories','1')");
}
  header('location:categories_m.php');
  die();

}
}

?>

         <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                          <strong>Categories</strong><small> Form</small>
                        </div>
                        <form method="post">
                        <div class="card-body card-block">
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">Categories</label>
                      <input type="text" name="categories" placeholder="Enter your categories name" class="form-control" required value="<?php echo $categories?>">
                          </div>
                           
                           <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <div class="error_field"><?php echo $msg?> </div>
                              
                          

                        </div>
                      </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <?php
        require('inc.footer.php');
        ?>