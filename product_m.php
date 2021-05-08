<?php
require('inc.top.php');
if(isset($_GET['type']) && $_GET['type']!='')
{
   $type=getsafe_value($con,$_GET['type']);
   if($type=='status'){
   $operation=getsafe_value($con,$_GET['operation']);
   $id=getsafe_value($con,$_GET['id']);
   if($operation=='active')
   {
      $status='1';
}
else
{
   $status='0';

}

$update_status_sql="update product_tbl set status='$status' where id='$id'";
mysqli_query($con,$update_status_sql);
}

if($type=='delete')
{
   $id=getsafe_value($con,$_GET['id']);
   $delete_sql="delete from product_tbl where id='$id'";
   mysqli_query($con,$delete_sql);

}


}


$sql="select product_tbl.*,categories_tbl.categories from product_tbl,categories_tbl where product_tbl.categories_id=categories_tbl.id order by product_tbl.id desc";
$res=mysqli_query($con,$sql);
?>

         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Products</h4>
                           <h4 class="box-link"><a href="add_product.php">Add Products</a></h4>
                        </div>
                        <div class="card-body">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                      
                                      <th>Name</th>
                                      <th>Image</th>
                                      <th>MRP</th>
                                      <th>Price</th>
                                      
                                      <th>Qty</th>
                                      <th></th>
                                      
                                       <th>Status</th>
                                        </tr>
                              </thead>
                                 <tbody>
                                    <?php
                                    $i=1;
                                     while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                       <td class="serial"><?php echo $i?></td>
                                       <td><?php echo $row['id'] ?></td>
                                         <td><?php echo $row['categories']?></td>
                                         <td><?php echo $row['name'] ?></td>
                                         <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
                                         <td><?php echo $row['mrp'] ?></td>
                                         <td><?php echo $row['sellprice'] ?></td>
                                         <td><?php echo $row['qty'] ?></td>
                                        
                                        <td>
                                          <?php

                                          if($row['status']==1)
                                          {
                                             echo "<span class='badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                                          }else
                                          {
                                             echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                                          }
                                          echo "&nbsp;<span class='badge badge-edit'><a href='add_product.php?type=edit&id=".$row['id']."'>Edit</a></span>&nbsp;";

                                          echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp;";
                                          ?>
                                            </td>
                                         
                                    </tr>
                                   <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
        <?php 
        require ('inc.footer.php');
        ?>