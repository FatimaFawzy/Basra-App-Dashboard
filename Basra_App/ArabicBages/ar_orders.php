<?php
session_start();
if ( !isset($_SESSION['Auth-Token']))
{
header('location:login-merchant.php');//redirect to login page
}
include 'init.php';
include $tp.'ar_merch_dashboard.php' ;
$Auth_token=$_SESSION['Auth-Token'];
$merch_id=$_SESSION['marchant_id'];
?>
<span class="link" style="display:none;">../orders.php</span>
<link rel="stylesheet" href="<?php echo $css ;?>orders.css" />
<style media="screen">
.orders {
 background-color: #e55507a3;
 border: none;
 }
label {
   margin-left: 10px;
   margin-right:0;
 }
 .order-card button{
   margin-left: 0;
    margin-right: 35px;
  }
   .order-card{
     margin: 11px;
    padding: 31px;
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
    "auth-token: $Auth_token"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response, true);
$order=$response['data'];
?>
<div  class="auto-margin Ar_auto-margin">
  <div class="container-fluid">
  <div class="order-header">
    <h3>الطلبات</h3>
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
     <?php echo "<i class='fa Pending fa-hourglass-end' aria-hidden='true'></i> <span >قيد الانتظار</span>";
      }?>
     ...
 <?php if($value['payed']==true){echo "<span class='paid'>تم الدفع </span>";}
      else { echo "<span class='paid'>لم يتم الدفع</span> ";}?>
</p>

<p><span> العنوان :</span> <?php echo $value['address'];?></p>
<p><span> المستخدم:</span> <?php echo $value["userId"]['name'];?></p>
<p><span>الهاتف:</span><?php echo $value["userId"]['phone'];?></p>
<p><span> البريد الالكتروني :</span><?php echo $value["userId"]['email'];?></p>
<p><span> التعليقات :</span>
   <span class="comment"><?php if($value['comments']=="")
            {echo  "لايوجد تعليق" ;} else {
            echo  $value['comments'];
          }?></span>
  </p>
<p><span >المجموع :</span> <?php echo $value['total'];?></p>
  <p style="text-align: center;"><?php  $newDate = date("d-m-Y h:m:s", strtotime($value['createdAt']));
           echo $newDate ;?>

    </p>
    <!-- Button trigger modal -->

<button type="button" class="btn card-btn btn-primary" data-toggle="modal" data-target="#<?php echo $value['id'];?>">
عرض المنتجات
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php echo $value['id'];?>Label">المنتجات قيد الطلب</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin:0;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color: #17b88929;">
        <table class="table">
        <thead>
        <tr>
          <th scope="col">الصورة</th>
           <th scope="col">الاسم</th>
           <th scope="col">السعر</th>
          <th scope="col">الخصم</th>
          <th scope="col">الكمية</th>
        </tr>
      </thead>
      <?php if(!empty($value['orderItems'])){
       foreach ($value['orderItems'] as $productvalue){
       if($productvalue['productId']!=null)
         {
           ?>
          <tbody>
            <td><img src="<?php echo  $productvalue['productId']['image'];?>"></td>
            <td><?php echo  $productvalue['productId']['nameAr'];?></td>
            <td><?php echo  $productvalue['productId']['price'];?></td>
            <td><?php echo  $productvalue['productId']['discount']*100 . "%";?></td>
            <td><?php echo  $productvalue['quantity'];?></td>
          </tbody>
        <?php }}}else{?>
          <div class="success">
         <p> لايوجد محتوى</p>
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
تحرير
</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo $value['id'];?>e" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>m" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?php echo $value['id'];?>m">تحرير الطلب </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin:0;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
         <form action="ar_editorder.php" method="post" >
           <input type="hidden" name="id" value="<?php echo $value['id'];?>">
        <div class="input-group">
           <label> العنوان :</label>
           <input type="text" name="address" required>
         </div>
         <div class="input-group ">
           <label style="margin-right: 2px;">   تعليق :</label>
           <input type="text" name="comment" >
         </div>
         <div class="input-group ">
           <label> هل تم الدفع :</label>
           <input type="radio" name="payed" value="true" required><label class="check">نعم</label>
           <input type="radio" name="payed" value="false" required><label class="check">لا</label>
         </div>
   <div class="input-group">
           <label>  الحالة:</label>
           <input type="radio" name="status" value="Delivered" required><label  class="check">تم التوصيل</label>
           <input type="radio" name="status" value="Pending" required><label  class="check">انتظار</label>
     </div>
     <div class="modal-footer ar_modal-footer">
       <button type="submit"  name="edit"class="btn btn-primary">حفظ</button>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
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
<p> لايوجد محتوى</p>
</div>";
}}else{?>
  <div class="success">
 <p> لايوجد محتوى</p>
  </div>
<?php }?>
</div>
</div>
