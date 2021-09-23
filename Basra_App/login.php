<?php
include 'init.php';
include $tp.'header.php' ;
?>

<link rel="stylesheet" href="<?php echo $css ;?>login.css" />
<body style="	background-image:url('layout/images/bg2.jpg');">
 <h1 class="alrawaj"> ALRAWAJ</h1>
 <div class="layout">

   <div class="lg-container">
   	<h1>Admin Area</h1>
   	<form action="" class="lg-form" name="lg-form" method="post">

   		<div>

   			<input type="email" name="email" id="username" placeholder="Admin E-mail" required/>
   		</div>

   		<div class="password">
        <i class="far fa-eye"></i>
        <i class="fas fa-eye-slash"></i>
   			<label for="password">Password:</label>
   			<input type="password" name="password" id="password" placeholder="password"required />
   		</div>

     <div class="btn-container">

   		<button  calss="button-effect from-top" type="submit"name="login" >
          <span class="first">
            <span class="over-login">Login</span>
          </span>
         <span class="last">Login</span>
       </button>
    </div>

   	</form>
   	
   </div>
 </div>

  <?php
  if(isset($_POST['login']))
  {
  $email=$_POST['email'];
  $password=$_POST['password'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/admin/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_HEADER=> true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"\r\n{\r\n    \"email\" : \"$email\",\r\n    \"password\" :\"$password\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$ret_headers = explode("\n", explode("\r\n\r\n",$response)[0]);
$headers = [];
array_shift($ret_headers);
foreach ($ret_headers as $header_str) {
    $h = explode(":", $header_str);
    $headers[trim($h[0])] = trim($h[1]);
}
if(isset($headers['Auth-Token'])==1)
{
  session_start();
$_SESSION['Auth-Token']=$headers['Auth-Token'];

header('location:merchants.php');
}
else{
  ?>
  <div class="my-alert" >
    <?php echo "Wronge Email Or Password pleas try again!"?>
    <br>
  </div>

 <?php
  }
} ?>

 <?php include $tp.'footer.php' ;?>
