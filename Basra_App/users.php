<?php
session_start();
include 'init.php';
if ( !isset($_SESSION['Auth-Token']))
{
header('location:login.php');//redirect to login page
}
include $tp.'dashboard.php' ;
$Auth_token=$_SESSION['Auth-Token']
?>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/users",
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
$user=$response['data'];
?>
<span class="link" style="display:none;">ArabicBages/ar_users.php</span>
<link rel="stylesheet" href="<?php echo $css ;?>merchants.css" />
<style media="screen">
.user {
 background-color: #009688;
 border: none;
 }
</style>
<div class="auto-margin">
 <div class="Customer-header">
   <h3>Users</h3>

   <span class="count"> There Are <span class="cnumb"><span style="color: #e55508;"><?php echo count($user);?></span></span> user</span>
 </div>

 <div class="container-fluid">
<?php if(!empty($user)){?>
   <table class="table table-hover">
   <thead>
   <tr>
     <th scope="col">Name</th>
     <th scope="col">Phone</th>
     <th scope="col">Email</th>
     <th scope="col">Date</th>
     <th scope="col">Action</th>
   </tr>
   </thead>
 <?php foreach ($user as $value) {?>
   <tbody>
   <tr>

     <td data-label="Forename"scope="row"><?php echo $value['name'];?></td>
     <td data-label="Surname"scope="row"><?php echo $value['phone'];?></td>
     <td data-label="Email"scope="row"><?php echo $value['email'];?></td>
     <td scope="row"><?php
         $newDate = date("d-m-Y h:m:s", strtotime($value['createdAt']));
         echo $newDate ;
           ?></td>
     <td data-label="country"scope="row">
       <!-- Button Delet user modal -->
       <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id'];?>"
          style="background: transparent;border: none;">
         <abbr title="Delet user" ><i class="fas fa-trash-alt"></i></abbr>
       </button>

       <!-- Modal -->
       <div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="<?php echo $value['id'];?>Label">Delet User </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
               </button>
             </div>
             <div class="modal-body" style="font-size: 19px;">
               <p>Delet  User<span style="color: #009688;"> <?php echo $value['name'];?></span> Are you sure!?</p>

               <form action="users.php" method="post">
                 <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                 <input type="hidden" name="name" value="<?php echo $value['name'];?>">
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                   <input type="submit" class="btn btn-secondary" name="delet" value="Delet">
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>

    </td>
  </tr>

</tbody>
 <?php }?>
 </table>
<?php  }else {
  echo "<div class='success'>
 <p> No content</p>
  </div>";
}?>


</div>
</div>



<!--,,,,,,Request of delet Merchants !-->
<?php
if(isset($_POST["delet"])==1)
{

 $id=$_POST['id'];
 $name=$_POST['name'];
$curl = curl_init();
curl_setopt_array($curl, array(
 CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/user/$id",
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
   <p>User<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span> Deleted successfuly</p>
      <a href="users.php" class="btn btn-secondary add_ok">OK</a>
 </div>
</div>
<?php
}
else{?>
   <div class="layout">
   <div class="success">
     <p> <?php echo $response?></p>
        <a href="usrs.php" class="btn btn-secondary add_ok">OK</a>
   </div>
 </div>
 <?php
 }
}
