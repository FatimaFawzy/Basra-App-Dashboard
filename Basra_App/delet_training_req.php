<?php
session_start();
$Auth_token=$_SESSION['Auth-Token'];
?>
<style media="screen">
.layout{
     height: 100%;
      position: absolute;
      width: 100%;
      background: #206f54ba;
      top: 0;
      right: 0;
      left: 0;
}
.success
{
  line-height: 2;
    margin: 100px auto;
    width: 22%;
    background-color: #021f2d6e;
    padding: 42px;
    text-align: center;
    color: #813c0b;
    border-radius: 10%;
    font-size: x-large;
}
.add_ok:hover{
    background: #206f54ba;
    color:#813c0b;
    border: none;
}
.add_ok{
     text-decoration: none;
      padding: 3px;
      width: 67px;
      border-radius: 10%;
      border: 1px solid #1e1e1ee3;
      background-color: #1e1e1e75;
      cursor: pointer;
      font-weight: bold;
      font-size: large;
      color: #009688;
}

</style>
<?php
if(isset($_POST['delet'])==1)
{
 $id=$_POST['id'];
 $id=(int)$id;
 $name=$_POST['name'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/trainingRequest/$id",
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
  <a href="training.php"class="btn btn-secondary add_ok" >OK</a>



 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response ;?></p>
<a href="training.php"class="btn btn-secondary add_ok" >Back</a>

   </div>
 </div>
 <?php
 }
}
?>
