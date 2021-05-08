<?php
require('inc.top.php');
$msg='';
$categories_id='';
$name='';
$mrp='';
$sellprice='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!='')
{
  $image_required='';
  $id=getsafe_value($con,$_GET['id']);
  $res=mysqli_query($con,"select * from product_tbl where id='$id'");
  $check=mysqli_num_rows($res);
  if($check>0)
  {
  
  $row=mysqli_fetch_assoc($res);
  $categories_id=$row['categories_id'];
  $name=$row['name'];
  $mrp=$row['mrp'];
  $sellprice=$row['sellprice'];
  $qty=$row['qty'];
  $image=$row['image'];
  $short_desc=$row['short_desc'];
  $description=$row['description'];
  $meta_title=$row['meta_title'];
  $meta_desc=$row['meta_desc'];
  $meta_keyword=$row['meta_keyword'];
}
else
{
   header('location:product_m.php');
  die();
}
}
if(isset($_POST['submit']))
{
  $categories_id=getsafe_value($con,$_POST['categories_id']);
  $name=getsafe_value($con,$_POST['name']);
  $mrp=getsafe_value($con,$_POST['mrp']);
  $sellprice=getsafe_value($con,$_POST['sellprice']);
  $qty=getsafe_value($con,$_POST['qty']);
   
  
  $short_desc=getsafe_value($con,$_POST['short_desc']);
  $description=getsafe_value($con,$_POST['description']);
  $meta_title=getsafe_value($con,$_POST['meta_title']);
  $meta_desc=getsafe_value($con,$_POST['meta_desc']);
  $meta_keyword=getsafe_value($con,$_POST['meta_keyword']);
  $res=mysqli_query($con,"select * from product_tbl where name='$name'");
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
    $msg="Product already exist";
}
  }
  else
  {
    $msg="Product already exist";
  }
}
  if($_GET['id']==0){
    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
      $msg="Please select only png,jpg and jpeg image formate";
    }
  }else{
    if($_FILES['image']['type']!=''){
        if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $msg="Please select only png,jpg and jpeg image formate";
      }
    }
  }
  
  if($msg==''){
    if(isset($_GET['id']) && $_GET['id']!=''){
      if($_FILES['image']['name']!=''){
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
        $update_sql="update product_tbl set categories_id='$categories_id',name='$name',mrp='$mrp',sellprice='$sellprice',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' where id='$id'";
      }else{
        $update_sql="update product_tbl set categories_id='$categories_id',name='$name',mrp='$mrp',sellprice='$sellprice',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
      }
      mysqli_query($con,$update_sql);
    }else{
      $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
      mysqli_query($con,"insert into product_tbl(categories_id,name,mrp,sellprice,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$categories_id','$name','$mrp','$sellprice','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");
    }
    header('location:product_m.php');
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
                          <strong>Product</strong><small> Form</small>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                       <div class="card-body card-block">
                 <div class="form-group">
                  <label for="categories" class="form-control-label">Categories</label>
                  <select class="form-control" name="categories_id">
                    <option>Select Category</option>
                    <?php
                    $res=mysqli_query($con,"select id,categories from categories_tbl order by categories asc");
                    while($row=mysqli_fetch_assoc($res)){
                      if($row['id']==$categories_id){
                        echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                      }else{
                        echo "<option value=".$row['id'].">".$row['categories']."</option>";
                      }
                      
                    }
                    ?>
                  </select>
                </div>
                           <div class="form-group">
                            <label for="categories" class=" form-control-label">Product Name</label>
                            <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name ?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product MRP</label>
                            <input type="text" name="mrp" placeholder="Enter product MRP" class="form-control" required value="<?php echo $mrp ?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product Price</label>
                            <input type="text" name="sellprice" placeholder="Enter product price" class="form-control" required value="<?php echo $sellprice ?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product Qty</label>
                            <input type="text" name="qty" placeholder="Enter product quantity" class="form-control" required value="<?php echo $qty ?>">
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product Image</label>
                            <input type="file" name="image" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product short_description</label>
                            <textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="categories" class="form-control-label">Product Description</label>
                            <textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description ?></textarea>
                          </div>
                          <div class="form-group">
                          <label for="categories" class="form-control-label">Meta Title</label>
                            <textarea name="meta_title" placeholder="Enter Meta Title" class="form-control" required><?php echo $meta_title ?></textarea>
                          </div>
                         
                         
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Meta Description</label>
                            <textarea  name="meta_desc" placeholder="Enter Meta Description" class="form-control" required><?php echo $meta_desc?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="categories" class=" form-control-label">Meta Keyword</label>
                            <textarea name="meta_keyword" placeholder="Enter Meta Keyword" class="form-control" required><?php echo $meta_keyword?></textarea>
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