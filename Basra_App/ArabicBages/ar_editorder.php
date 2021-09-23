<?php
session_start();
include 'init.php';
$Auth_token=$_SESSION['Auth-Token'];
$merch_id=$_SESSION['marchant_id'];
?>

<link rel="stylesheet" href="<?php echo $css ;?>dashboared.css" />
<link rel="stylesheet" href="<?php echo $css ;?>orders.css" />
<?php
if(isset($_POST['edit'])==1)
{
  $address=$_POST['address'];
  $comment=$_POST['comment'];
  $payed=$_POST['payed'];
  $status=$_POST['status'];
  $id=$_POST['id'];
  $id=(int)$id;

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/orders/merchant/$merch_id/order/$id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS =>"{\r\n    \"address\":\"$address\",
    \r\n    \"comments\":\"$comment\",
    \r\n    \"payed\":$payed,
    \r\n    \"status\":\"$status\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
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

   <p> تم  التحرير بنجاح </p>
   <a href="ar_orders.php" class="btn btn-secondary add_ok"style="text-decoration: none;
    font-family: serif;">تم</a>
</div>
</div>
<?php
   }
   else {?>
     <div class="layout">
     <div class="success">
       <p> هناك مشكلة  حاول مرة اخرى </p>
       <a href="ar_orders.php" class="btn btn-secondary add_ok" style="text-decoration: none;
    font-family: serif;">رجوع</a>
    </div>
    </div>
   <?php }
}?>
