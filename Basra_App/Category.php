<?php
session_start();
if ( !isset($_SESSION['Auth-Token']))
{
header('location:login-merchant.php');//redirect to login page
}
include 'init.php';
include $tp.'merch_dashboard.php' ;
$Auth_token=$_SESSION['Auth-Token'];
$merch_id=$_SESSION['marchant_id'];
?>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);

curl_close($curl);

$response=json_decode($response, true);
$category=$response['data'];
?>
<link rel="stylesheet" href="<?php echo $css ;?>category.css" />
<style media="screen">
.customer {
 background-color: #e55507a3;
 border: none;
 }
</style>
<span class="link" style="display:none;">ArabicBages/ar_Category.php</span>

<div class="auto-margin">
 <div class="category-header">
   <h3>Category</h3>
   <span class="count"> There Are <span class="cnumb"><span style="color: #e55508;"><?php echo count($category);?></span></span> Category</span>

   <!-- Button add category  modal -->
   <a class=" add" data-toggle="modal" data-target="#add-product">
       <span class="over-add">
         <i class="fas fa-plus-circle"></i>
       </span>
       <span style="position:relative"> Add<i class="fas fa-plus-circle"></i>category</a></span>
     </a>


   <!-- Modal -->
   <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="add-productLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="add-productLabel">Add Category </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
           </button>
         </div>
         <div class="modal-body" style="font-size: 19px;">
 <div class="loading" id="loading" >Pleas Wait loading......</div>
<form action="category.php" method="post" >
    <input type="hidden" name="merch_id" value="<?php echo $merch_id;?>">
        <div class=" row input_group">
               <div class="col-md-5"style="margin-left: 39px;">
                 <label>Name:</label>
                 <input type="text" name="name"required>
               </div>

           <div class="col-md-5">
             <label>Arabic Name:</label>
           <input type="text" name="ar_name" required>
           </div>
     </div>
   <div class=" row input_group" style="margin-left: 40px;">
            <div class="col-md-5">

             <textarea name="description" required rows="4" cols="30" required placeholder=" Description"></textarea>
            </div>
            <div class="col-md-6"style="margin-left: 57px;">

             <textarea name="ar_description" rows="4" cols="30" required placeholder="Arabic Description"></textarea>

            </div>

   </div>

             <div class="modal-footer">
 <input type="submit" class="btn btn-secondary " name="add_cat" value="Add"style="margin-bottom: 6px;">

     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
           </form>
         </div>
       </div>
     </div>
   </div>
   <!--end modal-->



 </div>



 <div class="container-fluid">
   <?php
    if(!empty($category)){
   foreach ($category as $value)
   {
     ?>

<div class="rows">

  <div class="col">
    <div class="row info">

      <div class="col-md-12">
        <p><span class="title"> <?php echo $value['name'];?></span>  </p>

          <p style="color: #56524c;">

          <?php echo $value['description'];?>
      </p>
      </div>
    </div>
  <div class="row" style="padding: 1px;justify-content: center;">
    <!--buttton of veiw product-->
      <form action="product.php" method="POST">
        <input type="hidden" name="cat_id" value=" <?php echo $value['id'];?>">
        <input type="hidden" name="cat_name" value=" <?php echo $value['name'];?>">
        <input type="hidden" name="ar_cat_name" value=" <?php echo $value['nameAr'];?>">
        <button type="submit" name="product" class="btn btn-primary action ">Product</button>
      </form>

      <!-- Button edite category modal -->
      <button type="button" class="btn btn-primary action " data-toggle="modal" data-target="#<?php echo $value['id'];?>">
        Edit <i class="fas fa-pencil-alt"></i>
      </button>

      <!-- Modal -->
      <div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="<?php echo $value['id'];?>Label">Edit Category <?php echo " ".$value['name'];?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="font-size: 19px;">

          <form action="category.php" method="post"class="edite_cat">
                <input type="hidden" name="merch_id" value="<?php echo $merch_id;?>">
                <input type="hidden" name="cat_id" value="<?php echo $value['id'];?>">
                <div class=" row input_group">
                       <div class="col-md-6">
                         <label>New Name:</label>
                         <input type="text" name="name"required value="<?php echo $value['name'];?>">
                       </div>

                   <div class="col-md-6">
                     <label>New Arabic Name:</label>
                   <input type="text" name="ar_name" value="<?php echo $value['nameAr'];?>" required>
                   </div>
              </div>
              <div class=" row input_group" >
                    <div class="col-md-6">

                     <textarea name="description"  rows="4" cols="30" required placeholder="New Description"><?php echo $value['description'];?></textarea>
                    </div>
                    <div class="col-md-6">

                     <textarea name="ar_description" rows="4" cols="30" required placeholder="New Arabic Description"><?php echo $value['descriptionAr'];?></textarea>

                    </div>

              </div>

                <div class="modal-footer">
                  <input type="submit" class="btn btn-secondary" name="edite" value="Save">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--end modal-->
      <!-- Button Delet maerchant modal -->
      <button type="button" class="btn btn-primary action" data-toggle="modal" data-target="#<?php echo $value['id'];?>delet">
         Delet <i class="fas fa-trash-alt"></i>
      </button>

      <!-- Modal -->
      <div class="modal fade" id="<?php echo $value['id'];?>delet" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Labeldelet" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="<?php echo $value['id'];?>Labeldelet">Delet category </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="font-size: 19px;">
              <p style="color: azure;">Delet  Category<span style="color: #009688;"> <?php echo $value['name'];?></span> Are you sure!?</p>

              <form action="category.php" method="post">
                <input type="hidden" name="cat_id" value="<?php echo $value['id'];?>">
                <input type="hidden" name="merch_id" value="<?php echo $merch_id;?>">
                <input type="hidden" name="name" value="<?php echo $value['name'];?>">
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" name="delet" value="Delet">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--end modal-->


    </div>
  </div>

</div>

<?php
}
} else{?>
  <div class="success">
 <p> No content</p>
  </div>
<?php   }?>



   </div>
</div>
<!--,,,,,,Request of add category !-->
<?php
if(isset($_POST["add_cat"])==1)
{
  $merch_id=$_POST['merch_id'];
   $name=$_POST['name'];
 $ar_name=$_POST['ar_name'];
$description=$_POST['description'];
$ar_description=$_POST['ar_description'];




 $curl = curl_init();

 curl_setopt_array($curl, array(
   CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS =>"{\r\n\"name\": \"$name\",\r\n\"nameAr\": \"$ar_name\",\r\n\"description\": \"$description\",\r\n\"descriptionAr\": \"$ar_description\"\r\n}",
   CURLOPT_HTTPHEADER => array(
     "auth-token:$Auth_token ",
     "Content-Type: application/json"
   ),
 ));

 $response = curl_exec($curl);

 curl_close($curl);

$responses=json_decode($response, true);
if( $responses['status']==1)
{?>
 <div class="layout">
 <div class="success">
   <p>category<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span> Added successfuly</p>
      <a href="category.php" class="btn btn-secondary add_ok">OK</a>
 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response?></p>
        <a href="category.php" class="btn btn-secondary add_ok">OK</a>
   </div>
 </div>
 <?php
 }
}
?>

<!--,,,,,,Request of edite category !-->
<?php
if(isset($_POST["edite"])==1)
{
$merch_id=$_POST['merch_id'];
  $cat_id=$_POST['cat_id'];
  $cat_id=(int)$cat_id;
 $newname=$_POST['name'];
 $newar_name=$_POST['ar_name'];
$newdescription=$_POST['description'];
$newar_description=$_POST['ar_description'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/$cat_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS =>"{\r\n\"name\": \"$newname\",\r\n\"nameAr\": \"$newar_name\",\r\n\"description\": \"$newdescription\",\r\n\"descriptionAr\": \"$newar_description\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "auth-token: $Auth_token",
     "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$responses=json_decode($response, true);
if( $responses['status']==1)
{?>
 <div class="layout">
 <div class="success">
   <p>category<span style="color: #5a1c08;" ><?php echo " ".$_POST['name']." " ; ?></span> Edit successfuly</p>
      <a href="category.php" class="btn btn-secondary add_ok">OK</a>
 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response?></p>
        <a href="category.php" class="btn btn-secondary add_ok">OK</a>
   </div>
 </div>
 <?php
 }
}?>
<!--,,,,,,Request of delet category !-->
<?php
if(isset($_POST["delet"])==1)
{
 $merch_id=$_POST['merch_id'];
 $cat_id=$_POST['cat_id'];
 $cat_id=(int)$cat_id;
  $name=$_POST['name'];
 $curl = curl_init();

 curl_setopt_array($curl, array(
   CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/$cat_id",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "DELETE",
   CURLOPT_HTTPHEADER => array(
     "auth-token: $Auth_token",
      "Content-Type: application/json"
   ),
 ));

 $response = curl_exec($curl);

 curl_close($curl);

$responses=json_decode($response, true);
if( $responses['status']==1)
{?>
 <div class="layout">
 <div class="success">
   <p>category<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span> Deleted successfuly</p>
      <a href="category.php" class="btn btn-secondary add_ok">OK</a>
 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response?></p>
        <a href="category.php" class="btn btn-secondary add_ok">OK</a>
   </div>
 </div>
 <?php
 }
}
?>
