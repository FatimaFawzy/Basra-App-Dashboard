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
<span class="link" style="display:none;">ArabicBages/ar_orders.php</span>
<link rel="stylesheet" href="<?php echo $css ;?>orders.css" />
<style media="screen">
.orders {
 background-color: #e55507a3;
 border: none;
 }
 </style>
 <?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/orders/merchant/$merch_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "auth-token:$Auth_token"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response, true);
$order=$response['data'];
?>
<div  class="auto-margin">
  <div class="container-fluid">
  <div class="order-header">
    <h3>Orders</h3>
    <?php
       if(!empty($order)){?>
      </div>
  <?php
    foreach ($order as $value)
     {
        if($value['status']=='Delivered'){
      $count=count($order);
      $count=$count-1; ?>
<div class="order-card" style="display:none;">
  <?php }
  else {
    $count=count($order);
    ?>
    <div class="order-card">
    <p>
<?php echo "<i class='fa Pending fa-hourglass-end' aria-hidden='true'></i> <span >".$value['status']."</span>";
       }?>
...
<?php if($value['payed']==true){echo "<span class='paid'>Payed Is Done</span>";}
      else { echo "<span class='paid'>No Payed Yet</span> ";}?>
</p>

<p><span >Address:</span> <?php echo $value['address'];?></p>
<p><span>User :</span> <?php echo $value["userId"]['name'];?></p>
<p><span>Phone :</span><?php echo $value["userId"]['phone'];?></p>
<p><span>Email :</span><?php echo $value["userId"]['email'];?></p>
<p><span >Comment :</span>
   <span class="comment"><?php if($value['comments']=="")
            {echo  "No Comment" ;} else {
            echo  $value['comments'];
          }?></span>
  </p>
<p><span >Total :</span> <?php echo $value['total'];?></p>
  <p style="text-align: center;"><?php  $newDate = date("d-m-Y h:m:s", strtotime($value['createdAt']));
           echo $newDate ;?>

    </p>
    <!-- Button trigger modal -->

<button type="button" class="btn card-btn btn-primary" data-toggle="modal" data-target="#<?php echo $value['id'];?>">
view Products
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php echo $value['id'];?>Label">Products Of Orders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color: #17b88929;">
        <table class="table">
        <thead>
        <tr>
          <th scope="col">Image</th>
           <th scope="col">Name</th>
           <th scope="col">Price</th>
          <th scope="col">Discount</th>
          <th scope="col">Quantity</th>
        </tr>
      </thead>
      <?php if(!empty($value['orderItems'])){
       foreach ($value['orderItems'] as $productvalue){
       if($productvalue['productId']!=null)
         {
           ?>
          <tbody>
            <td><img src="<?php echo  $productvalue['productId']['image'];?>"></td>
            <td><?php echo  $productvalue['productId']['name'];?></td>
            <td><?php echo  $productvalue['productId']['price'];?></td>
            <td><?php echo  $productvalue['productId']['discount']*100 . "%";?></td>
            <td><?php echo  $productvalue['quantity'];?></td>
          </tbody>
        <?php }}}else{?>
          <div class="success">
         <p> No content</p>
          </div>
        <?php }?>
    </table>
      </div>

     </div>
    </div>
  </div>

  <!-- Button trigger modal -->
<button type="button" class="btn card-btn btn-primary"
data-toggle="modal" data-target="#<?php echo $value['id'];?>e"style="margin:0;">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $value['id'];?>e" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>m" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php echo $value['id'];?>m">Edit Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="editorder.php" method="post" >
           <input type="hidden" name="id" value="<?php echo $value['id'];?>">
        <div class="input-group">
           <label> Address : </label>
           <input type="text" name="address" required>
         </div>
         <div class="input-group ">
           <label style="margin-right: 2px;"> Comment :</label>
           <input type="text" name="comment" >
         </div>
         <div class="input-group ">
           <label> payed:</label>
           <input type="radio" name="payed" value="true" required><label class="check">Yes</label>
           <input type="radio" name="payed" value="false" required><label class="check">No</label>
         </div>
   <div class="input-group">
           <label> Status:</label>
           <input type="radio" name="status" value="Delivered" required><label  class="check">Delivered</label>
           <input type="radio" name="status" value="Pending" required><label  class="check">Pending</label>
     </div>
     <div class="modal-footer">
       <button type="submit"  name="edit"class="btn btn-primary">Save changes</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
         </form>

      </div>

    </div>
  </div>
</div>

</div>
<?php }
if($count==0)
{
echo "<div class='success'>
<p> No content</p>
</div>";
}}else{?>
  <div class="success">
 <p> No content</p>
  </div>
<?php }?>
</div>
</div>
