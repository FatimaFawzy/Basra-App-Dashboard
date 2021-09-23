<?php
session_start();
include 'init.php';
include $tp.'dashboard.php' ;
if ( !isset($_SESSION['Auth-Token']))
{
header('location:login.php');//redirect to login page
}
$Auth_token=$_SESSION['Auth-Token'];
?>
<link rel="stylesheet" href="<?php echo $css ;?>merchants.css" />
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchantRequest",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "auth-token: $Auth_token"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response, true);
$request=$response['data'];
?>
<style media="screen">
.customer {
  background-color: #009688;
  border: none;
  }
</style>
<span class="link" style="display:none;">ArabicBages/ar_view_march_request.php</span>
<div class="auto-margin">
  <div class="Customer-header">
    <h3>Merchant Request</h3>

    <span class="count"> There Are <span class="cnumb"><span style="color: #e55508;"><?php echo count($request);?></span></span> Merchant Request</span>
  </div>

<div class="container">
<?php if(!empty($request)){?>
<table class="table">
<thead>
<tr>
  <th scope="col">Name</th>
  <th scope="col">Phone</th>
  <th scope="col">Email</th>
  <th scope="col">Address</th>
  <th scope="col">StoreName</th>
  <th scope="col">Date</th>
<th scope="col">Action</th>
</thead>
</tr>


<?php foreach ($request as $value) {?>
<tr>
<td scope="row"><?php echo $value['name'];?></td>
<td scope="row"><?php echo $value['phone'];?></td>
<td scope="row"><?php echo $value['email'];?></td>
<td scope="row"><?php echo $value['address'];?></td>
<td scope="row"><?php echo $value['storeName'];?></td>
<td scope="row"><?php
    $newDate = date("d-m-Y", strtotime($value['createdAt']));
    echo $newDate ;
      ?></td>

<td scope="row">
<!-- Button Delet Request modal -->
<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id'];?>del"style="background: transparent;border: none;">
<abbr title="Delet Request" ><i class="fas fa-trash-alt"></i></abbr>
</button>

<!-- Modal -->
<div class="modal   dismiss fade" id="<?php echo $value['id'];?>del" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>delLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php echo $value['id'];?>delLabel">Delet marchant Request </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: #c7421b;"aria-hidden="true" style="color: #ff1f00;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 19px;">
        <p>Delet  Request Of<span style="color: #009688;"> <?php echo $value['name'];?></span> Are you sure!?</p>

        <form action="view_march_request.php" method="post">
          <input type="hidden" name="id" value="<?php echo $value['id'];?>">
          <input type="hidden" name="name" value="<?php echo $value['name'];?>">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary delet" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-secondary" name="delet" value="Delet">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</td>
</tr>
<?php }
}else {?>

   <div class="success">
  <p> No content</p>
   </div>

<?php }
?>
</table>
</div>

</div>
</div>
</div>
<!--end Delet model-->
<!-- delet marchant Request-->
<?php
if(isset($_POST['delet'])==1)
{
 $id=$_POST['id'];
 $id=(int)$id;
 $name=$_POST['name'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchantRequest/$id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "DELETE",
  CURLOPT_HTTPHEADER => array(
    "auth-token: $Auth_token"
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

   <p>Request<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span>Deleted successfuly</p>
  <a href="view_march_request.php"class="btn btn-secondary add_ok" >OK</a>



 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response ;?></p>
<a href="view_march_request.php"class="btn btn-secondary add_ok" >Back</a>

   </div>
 </div>
 <?php
 }
}
?>
