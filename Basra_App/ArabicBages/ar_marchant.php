<?php
session_start();
include 'init.php';
if ( !isset($_SESSION['Auth-Token']))
{
header('location:login.php');//redirect to login page
}
include $tp.'ar_dashboard.php' ;
$Auth_token=$_SESSION['Auth-Token'];
?>
<?php
$curl = curl_init();
curl_setopt_array($curl, array(
 CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants",
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
$marchent=$response['data'];
?>
<link rel="stylesheet" href="<?php echo $css ;?>merchants.css" />
<style media="screen">
.customer {
 background-color: #009688;
 border: none;
 }
</style>
<span class="link" style="display:none;">../merchants.php</span>
<div class="auto-margin Ar_auto-margin">
 <div class="Customer-header">
   <h3>التجار</h3>

   <span class="count"> يوجد <span class="cnumb"><span style="color: #e55508;"><?php echo count($marchent);?></span></span> تاجر</span>
 </div>

 <div class="container-fluid">
<?php if(!empty($marchent)){?>
   <table class="table table-hover">
   <thead>
   <tr>
     <th scope="col">الاسم</th>
     <th scope="col">الهاتف</th>
     <th scope="col">البريد الالكتروني</th>
     <th scope="col">اسم المتجر</th>
     <th scope="col">نوع المتجر</th>
     <th scope="col">التاريخ</th>
     <th scope="col">طريقة الدفع</th>
     <th scope="col">العملية</th>
   </tr>
   </thead>
   <?php
   foreach ($marchent as $value) {?>
   <tbody>
   <tr>

     <td scope="row"><?php echo $value['nameAr'];?></td>
     <td scope="row"><?php echo $value['phone'];?></td>
     <td scope="row"><?php echo $value['email'];?></td>
     <td scope="row"><?php echo $value['storeNameAr'];?></td>
     <td scope="row"><?php
foreach ($value['typeAr'] as $type) {
 if($type==".")
 { $type="";}else{
   echo "- ". $type."<br>";
}
}
   ?></td>
     <td scope="row"><?php
         $newDate = date("d-m-Y h:m:s", strtotime($value['createdAt']));
         echo $newDate ;
           ?></td>
           <td>
           <?php if($value['zcMsisdn']==null ){echo "دفع نقدي";}
           else {
             echo "زين كاش <br> & <br> دفع نقدي";
           }?>

           </td>
     <td scope="row">
       <!-- Button Delet maerchant modal -->
       <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id'];?>"
          style="background: transparent;border: none;">
         <abbr title="حذف التاجر" ><i class="fas fa-trash-alt"></i></abbr>
       </button>

       <!-- Modal -->
       <div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="<?php echo $value['id'];?>Label">حذف التاجر </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    margin: 0;">
                 <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
               </button>
             </div>
             <div class="modal-body Ar_body" style="font-size: 19px;">
               <p>حذف التاجر<span style="color: #009688;"> <?php echo $value['nameAr'];?></span> هل انت متأكد !؟</p>

               <form action="ar_marchant.php" method="post">
                 <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                 <input type="hidden" name="name" value="<?php echo $value['nameAr'];?>">
                 <div class="modal-footer ar_modal-footer">
                   <input type="submit" class="btn btn-secondary" name="delet" value="حذف">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div> |
<abbr title="تعديل التاجر" >

<form action="ar_edite_marchent.php" method="post" style="    display: inline-block;">

    <input type="hidden" name="march_id" value="<?php echo $value['id'];?>">
   <input type="hidden" name="ar_march_name" value="<?php echo $value['nameAr'];?>">
   <input type="hidden" name="march_name" value="<?php echo $value['name'];?>">
    <button type="submit" name="editmarchent"style="background: transparent;border: none;" > <i class="fas fa-pencil-alt"></i> </button>
  </form>
</abbr>
</td>
<td ><abbr title=" الوصف :   <?php echo $value['descriptionAr'];?>">
  <i class="fas fa-file-prescription"></i>
</abbr>
</td>
  </tr>

</tbody>

 <?php
}//for each
}// if statment
   else{?>
     <div class="success">
    <p> لايوجد محتوى</p>
     </div>
 <?php }?>
   </table>
   </div>
</div>
<!--,,,,,,Request of delet Merchants !-->
<?php
if(isset($_POST["delet"])==1)
{

 $id=$_POST['id'];
 $name=$_POST['nameAr'];
$curl = curl_init();
curl_setopt_array($curl, array(
 CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$id",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 0,
 CURLOPT_FOLLOWLOCATION => true,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "DELETE",
 CURLOPT_HTTPHEADER => array(
   "auth-token: $Auth_token",
 )

));

$response = curl_exec($curl);

curl_close($curl);
$responses=json_decode($response, true);
if( $responses['status']==1)
{?>
 <div class="layout">
 <div class="success">
   <p>التاجر<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span> حذف بنجاح</p>
      <a href="ar_merchant.php" class="btn btn-secondary add_ok">نعم</a>
 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response?></p>
        <a href="ar_merchant.php" class="btn btn-secondary add_ok">رجوع</a>
   </div>
 </div>
 <?php
 }
}
