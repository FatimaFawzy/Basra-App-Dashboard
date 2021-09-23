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
<span class="link" style="display:none;">ArabicBages\ar_marchant.php</span>
<div class="auto-margin">
  <div class="Customer-header">
    <h3>Merchants</h3>

    <span class="count"> There Are <span class="cnumb"><span style="color: #e55508;"><?php echo count($marchent);?></span></span> Merchants</span>
  </div>

  <div class="container-fluid">
<?php if(!empty($marchent)){?>
  <div class="table-responsive">
    <table class="table table-hover ">
    <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">StoreName</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">Way Paid</th>
      <th scope="col">Action</th>
    </tr>
    </thead>
    <?php
    foreach ($marchent as $value) {?>
    <tbody>

    <tr>

     <td scope="row"><?php echo $value['name'];?></td>
      <td scope="row"><?php echo $value['phone'];?></td>
      <td scope="row"><?php echo $value['email'];?></td>
      <abbr title="<?php echo $value['description'];?>">
    <td scope="row"><?php echo $value['storeName'];?></td>
      </abbr>
      <td scope="row"><?php
foreach ($value['type'] as $type)
{
  if($type==".")
  { $type="";}else{
    echo $type."<br>";
   } } ?>
  </td>
      <td scope="row"><?php
          $newDate = date("d-m-Y h:m:s", strtotime($value['createdAt']));
          echo $newDate ;
            ?></td>

<td>
<?php if($value['zcMsisdn']==null ){echo "Cash Payed";}
else {
  echo "Zain Cash <br> & <br> Cash Payed";
}?>

</td>
      <td scope="row">

        <!-- Button Delet maerchant modal -->
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id'];?>"
           style="background: transparent;border: none;">
          <abbr title="Delet marchent " ><i class="fas fa-trash-alt"></i></abbr>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="<?php echo $value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id'];?>Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="<?php echo $value['id'];?>Label">Delet Merchant </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="font-size: 19px;">
                <p>Delet  Merchant<span style="color: #009688;"> <?php echo $value['name'];?></span> Are you sure!?</p>

                <form action="merchants.php" method="post">
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
        </div> |
<abbr title="Edit marchent" >

<form action="edite_marchent.php" method="post" style="    display: inline-block;">
  
    <input type="hidden" name="march_id" value="<?php echo $value['id'];?>">
    <input type="hidden" name="march_name" value="<?php echo $value['name'];?>">
    <input type="hidden" name="ar_march_name" value="<?php echo $value['nameAr'];?>">
    <button type="submit" name="editmarchent"style="background: transparent;border: none;" > <i class="fas fa-pencil-alt"></i> </button>
   </form>
 </abbr>

     </td>
<td ><abbr title=" Discription : <?php echo $value['description'];?>">
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
     <p> No content</p>
      </div>
  <?php }?>
    </table>
  </div>
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
    <p>merchent<span style="color: #5a1c08;" ><?php echo " ".$name." " ; ?></span> Deleted successfuly</p>
       <a href="merchants.php" class="btn btn-secondary add_ok">OK</a>
  </div>
</div>
<?php
}
else{?>
    <div class="layout">
    <div class="success">
      <p> <?php echo $response?></p>
         <a href="merchants.php" class="btn btn-secondary add_ok">OK</a>
    </div>
  </div>
  <?php
  }
}
