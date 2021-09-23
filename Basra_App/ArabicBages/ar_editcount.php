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
<style media="screen">
.count {
  background-color: #e55507a3;
  border: none;
  }
</style>
<link rel="stylesheet" href="<?php echo $css ;?>add-merch.css" />
<span class="link" style="display:none;">../editcount.php</span>
<div class="auto-margin Ar_auto-margin">
<div class="add-merchent " style="direction: ltr;">
  <h1> تعديل معلومات المتجر </h1>
<form action="ar_editcount.php" method="post">
 <div class="row">
  <div class=" col-md-12">
    <div class="row input-group">
      <div class="col-md-6">
        <label class="input-label" >New Name:</label>
            <input type="text" name="name">
      </div>

      <div class="col-md-6">
          <input type="text" name="ar_name">
          <label class="input-label" >: تعديل الاسم  </label>
      </div>

    </div>

    <div class="row input-group" >
      <div class="col-md-6 ">

            <input type="text" name="phone">
            <label class="input-label" >: تعديل الهاتف</label>
      </div>

      <div class="col-md-6 ">

            <input type="password" name="password" >
            <label class="input-label" >: كلمة مرور جديدة</label>

      </div>
      <div class="col-md-12  ">

        <input type="email" name="email" class="email">
        <label class="input-label" >: تعديل البريد الاكتروني</label>

      </div>
</div>
    <div class="row input-group">
      <div class="col-md-6 ">
        <label class="input-label" >New Store Name:</label>
            <input type="text" name="store_name">
      </div>
      <div class="col-md-6">
        <input type="text" name="ar_store_name">
        <label class="input-label" > : تعديل اسم المتجر</label>

      </div>
    </div>
    <div class="row input-group"style="justify-content: center; ">

      <div class="">
      دفع نقدي  <input  type="checkbox" name="paid-way" class="input-label CashPayed"value="CashPayed" >
      </div>

      <div class="" style="    margin-left: 14px;">
      زين كاش<input  type="checkbox" class="input-label ZainCash" name="paid-way"value="ZainCash" >
      </div>
<label > : طريقة الدفع </label>

    </div>

    <div class="paid-way">
        <div class="input-group">
            <label>ZcMsisdn:</label>
            <input type="text" name="msisdn" >
          </div>
          <div class="input-group">
              <label>ZcMerchantID:</label>
              <input type="text" name="merchentid" >
            </div>
            <div class="input-group">
                <label>zcSecret:</label>
                <input type="text" name="Secret" >
              </div>

  </div>



  <div class="row disc input-group">
    <div class="col-md-6 ">
      <label class="input-label" >New Discription</label>
          <textarea  name="discription" rows="6" cols="25"></textarea>
    </div>
    <div class="col-md-6">
       <textarea name="ar_discription" rows="6" cols="29"></textarea>
       <label class="input-label" > الوصف</label>
    </div>
  </div>

  <div class="row input-group" style="direction: ltr;">
    <div class="col-md-12 ">
      <label class="input-label" > New Type Of Store:</label><br>
     <input type="checkbox" name="type0" value="Cosmetics"><label>cosmetics </label>  |
      <input type="checkbox" name="type1" value="Clothes"><label>Clothes </label>   |
      <input type="checkbox" name="type2" value="Electronics"><label>Electronics </label>  |
      <input type="checkbox" name="type3" value="Food supplies"> <label>Food supplies </label> |
      <input type="checkbox" name="type4" value="Market"> <label>Market </label> |
      <input type="checkbox" name="type5" value="All"> <label>All </label> |
    <input type="checkbox" name="type6" value="Other Type"><label>Other Type </label><br>

    </div>
    <div class="col-md-12 " style="margin-top: 50px;">
      <label class="input-label" >: نوع المتجر</label><br>
      <input type="checkbox" name="ar_type0" value="كوزمتك"><label>كوزمتك </label> |
      <input type="checkbox" name="ar_type1" value="ملابس"><label>ملابس </label> |
      <input type="checkbox" name="ar_type2" value="الكترونيات"><label> الكترونيات</label> |
      <input type="checkbox" name="ar_type3" value="تجهيزات غذائية "><label>تجهيزات غذائية </label>  |
      <input type="checkbox" name="ar_type4" value="ماركت"><label>ماركت </label> |
      <input type="checkbox" name="ar_type5" value="الكل"><label>الكل </label> |
      <input type="checkbox" name="ar_type6" value="اخرى"><label>اخرى </label> <br>
    </div>
  </div>
</div>
<div class="col-md-12" style="text-align:center;">
  <input type="submit" name="edit-merchent" value="حفظ " class="submit">
</div>

</div>
</form>

</div>
</div>

<?php
if(isset($_POST["edit-merchent"])==1)
{
$name=$_POST['name'];
$AR_name=$_POST['ar_name'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$email=$_POST['email'];
$storename=$_POST['store_name'];
$AR_storename=$_POST['ar_store_name'];
$discription=$_POST['discription'];
$AR_discription=$_POST['ar_discription'];

for ($i=0; $i < 7 ; $i++) {
if(empty($_POST['type'.$i])){
$_POST['type'.$i]=".";
   }
}
$type_array[0]=$_POST['type0'];
$type_array[1]=$_POST['type1'];
$type_array[2]=$_POST['type2'];
$type_array[3]=$_POST['type3'];
$type_array[4]=$_POST['type4'];
$type_array[5]=$_POST['type5'];
$type_array[6]=$_POST['type6'];
$msisdn=$_POST['msisdn'];
$secret=$_POST['Secret'];
$merchantid=$_POST['merchentid'];

if ($msisdn=="" && $secret=="" && $merchantid=="")
 {
  $msisdn='null';
    $secret='null';
      $merchantid='null';
   }
$type_Array="[\"$type_array[0]\",\"$type_array[1]\",\"$type_array[2]\",\"$type_array[3]\",\"$type_array[4]\",\"$type_array[5]\",\"$type_array[6]\"]";

for ($i=0; $i < 7; $i++) {
if(empty($_POST['ar_type'.$i])){
$_POST['ar_type'.$i]=".";
   }
}
$ar_type_array[0]=$_POST['ar_type0'];
$ar_type_array[1]=$_POST['ar_type1'];
$ar_type_array[2]=$_POST['ar_type2'];
$ar_type_array[3]=$_POST['ar_type3'];
$ar_type_array[4]=$_POST['ar_type4'];
$ar_type_array[5]=$_POST['ar_type5'];
$ar_type_array[6]=$_POST['ar_type6'];

$ar_type_Array="[\"$ar_type_array[0]\",\"$ar_type_array[1]\",\"$ar_type_array[2]\",\"$ar_type_array[3]\",\"$ar_type_array[4]\",\"$ar_type_array[5]\",\"$ar_type_array[6]\"]";




$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchant/$merch_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS =>"{\r\n\"name\": \"$name\",\r\n\"nameAr\": \"$AR_name\",\r\n\"storeName\": \"$storename\",\r\n\"storeNameAr\":\"$AR_storename\",\r\n\"description\": \"$discription\",\r\n\"descriptionAr\":\"$AR_discription\",\r\n\"phone\":\"$phone\",
    \r\n\"email\":\"$email\",\r\n\"password\":\"$password\",\r\n\"type\":$type_Array,\r\n\"typeAr\":$ar_type_Array,\r\n\"zcMsisdn\": \" $msisdn\",\r\n\"zcMerchant\":\"$merchantid\",\r\n\"zcSecret\": \"$secret\"\r\n}",
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
  <div class="success">
    <p>تم تحديث البيانات </p>
       <a href="ar_Category.php" class="btn add_ok">تم</button>
  </div>
<?php
}
else{?>
    <div class="success">
      <p> <?php echo $response?></p>
         <button class="add_ok">حسنا</button>
      >
    </div>
  <?php
  }
}
