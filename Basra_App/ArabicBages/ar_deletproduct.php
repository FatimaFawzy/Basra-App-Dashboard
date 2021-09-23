<?php
session_start();
$Auth_token=$_SESSION['Auth-Token'];
$merch_id=$_SESSION['marchant_id'];
include 'init.php';
 ?>
<link rel="stylesheet" href="<?php echo $css ;?>product.css" />
<?php

if(isset($_POST['delet_product'])==1)
{

  $cat_id=$_POST['cat_id'];
  $cat_id = (int)$cat_id;
  $product_id=$_POST['product_id'];
  $product_id=(int)$product_id;
  $cat_name=$_POST['cat_name'];
  $name=$_POST['name'];
  
  $ar_cat_name=$_POST['ar_cat_name'];


  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/$cat_id/products/$product_id",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
      "auth-token:$Auth_token",
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);
$responses=json_decode($response, true);
if( $responses['status']==1)
{
  ?>
 <div class="layout">
 <div class="success">

   <p>تم حذف المنتج<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span>بنجاح</p>
<form action="ar_product.php" method="post">
  <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
   <input type="hidden" name="ar_cat_name" value="<?php echo $ar_cat_name;?>">
    <input type="hidden" name="cat_name" value="<?php echo $cat_name;?>">
  <button type="submit" name="product" class="btn btn-secondary add_ok" >تم</button>
</form>


 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response ;?></p>

     <form action="ar_product.php" method="post">
       <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
  <input type="hidden" name="ar_cat_name" value="<?php echo $ar_cat_name;?>">
       <input type="hidden" name="cat_name" value="<?php echo $cat_name;?>">
       <button type="submit" name="product" class="btn btn-secondary add_ok" >رجوع</button>
     </form>
   </div>
 </div>
 <?php
 }
}
?>
