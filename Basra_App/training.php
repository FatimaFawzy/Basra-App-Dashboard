<?php
session_start();
include 'init.php';
if (!isset($_SESSION['Auth-Token'])) {
  header('location:login.php'); //redirect to login page
}
include $tp . 'dashboard.php';
$Auth_token = $_SESSION['Auth-Token'];
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="<?php echo $css; ?>training.css" />
<link rel="stylesheet" href="<?php echo $css; ?>request.css" />
<span class="link" style="display:none;">ArabicBages/ar_training.php</span>
<style media="screen">
  .training {
    background-color: #009688;
    border: none;
  }
</style>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/training",
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
$response = json_decode($response, true);
$service = $response['data'];
?>
<div class="auto-margin">
  <div class="Customer-header">
    <h3>Training</h3>
    <span class="count"> There Are <span class="cnumb"><span style="color: #e55508;"><?php echo count($service); ?></span></span> Training</span>

    <!-- Button add products  modal -->
    <a class=" add" data-toggle="modal" data-target="#add-product">
      <span class="over-add">
        <i class="fas fa-plus-circle"></i>
      </span>
      <span style="position:relative"> Add<i class="fas fa-plus-circle"></i>Training</span>
    </a>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="add-productLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content add_serv">
        <div class="modal-header">
          <h5 class="modal-title" id="add-productLabel">Add Training </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 19px;">
          <div class="loading" id="loading">Pleas Wait loading......</div>
          <form action="post" enctype="multipart/form-data" id="formElem">
            <div class=" row input_group">
              <div class="col-md-5" style="margin-left: 39px;">
                <label>Tite:</label>
                <input type="text" name="title" required>
              </div>

              <div class="col-md-5">
                <label>Arabic Titl:</label>
                <input type="text" name="titleAr">
              </div>
            </div>
            <div class="input_group" style="float:left;">
              <label style="margin-left: 47px;margin-top: 25px;">Image:</label>
              <input type="file" name="image" required>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-secondary view" name="add_service" value="Add">
              <button type="button" class="btn btn-secondary view" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end add rervice-->


  <div>
    <div class="row service">
      <?php
      if (!empty($service)) {
        foreach ($service as $value) { ?>

          <div class="info">
            <div class="row">
              <img src="<?php echo $value['image']; ?>" />
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <h4 class="title"><?php echo $value['title']; ?> </h4>
                </div>
                <div class="row" style="    margin-left: 20px;">

                  <!-- delet service-->
                  <button type="button" class="btn btn-primary view" data-toggle="modal" data-target="#<?php echo $value['id']; ?>delet" style="margin-left: -27px;
    padding-left: 15px;">
                    Delete<i class="fas fa-trash-alt"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="<?php echo $value['id']; ?>delet" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>deletLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content" style="margin-top: 67px;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="<?php echo $value['id']; ?>deletLabel">Delet Training </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="color: #c7421b;" aria-hidden="true" style="color: #ff1f00;">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="font-size: 19px;">
                          <p>Delet Training<span style="color: #009688;"> <?php echo $value['title']; ?></span> Are you sure!?</p>

                          <form action="training.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                            <input type="hidden" name="name" value="<?php echo $value['title']; ?>">
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-secondary view" name="delet" value="Delet">
                              <button type="button" class="btn btn-secondary view delet" data-dismiss="modal">Cancel</button>

                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--end Delet service-->
                  <!-- Button View Request -->
                  <button type="button" class="btn btn-primary view" data-toggle="modal" data-target="#<?php echo $value['id']; ?>">
                    View Request
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>req" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content req">
                        <div class="modal-header">
                          <h5 class="modal-title" id="<?php echo $value['id']; ?>req">Request Of
                            <span class="train-title"> <?php echo $value['title']; ?></span>
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="color: #c7421b;" aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body body">
                          <?php if (!empty($value['trainingRequests'])) { ?>
                            <table class="table">

                              <thead>
                                <tr>
                                  <th scope="col">Name</th>
                                  <th scope="col">Phone</th>
                                  <th scope="col">City</th>
                                  <th scope="col">Duration</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Action</th>
                              </thead>
                              </tr>
                              <?php foreach ($value['trainingRequests'] as $value) { ?>
                                <tr>
                                  <td scope="row"><?php echo $value['clientName']; ?></td>
                                  <td scope="row"><?php echo $value['phone']; ?></td>
                                  <td scope="row"><?php echo $value['city']; ?></td>
                                  <td scope="row"><?php echo $value['duration']; ?></td>
                                  <td scope="row"><?php echo $value['email']; ?></td>
                                  <td scope="row">
                                    <!-- Button Delet Request modal -->
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id']; ?>del" style="background: transparent;border: none;">
                                      <abbr title="Delet Request"><i class="fas fa-trash-alt"></i></abbr>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal  modal-dismiss fade" id="<?php echo $value['id']; ?>del" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>delLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="<?php echo $value['id']; ?>delLabel">Delet Training Request </h5>

                                          </div>
                                          <div class="modal-body" style="font-size: 19px;">
                                            <p>Delet Request Of<span style="color: #009688;"> <?php echo $value['clientName']; ?></span> Are you sure!?</p>

                                            <form action="delet_training_req.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                              <input type="hidden" name="name" value="<?php echo $value['clientName']; ?>">
                                              <div class="modal-footer delet">
                                                <button type="button" class="btn btn-secondary delet-req-close" data-dismiss="">Cancel</button>
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
                            } else { ?>
                              <style>
                                .req-no {
                                  width: 550px;
                                }

                                .success {
                                  width: 50%;
                                  margin: 40px auto;
                                }
                              </style>
                              <div class="modal-content  req-no">
                                <div class="success">
                                  <p> No content</p>
                                </div>
                              </div>
                            <?php } ?>
                            </table>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!--end Delet model-->

                </div>
              </div>
            </div>
          </div>
      <?php }
      } else {
        echo "No content";
      } ?>
    </div>
    <!--end view serviceRequests model-->
    <!--request for delet service -->

    <?php
    if (isset($_POST['delet']) == 1) {
      $id = $_POST['id'];
      $id = (int)$id;
      $name = $_POST['name'];

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/training/$id",
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
      $responses = json_decode($response, true);
      if ($responses['status'] == 1) {
    ?>

        <div class="add-success success">

          <p>Training<span style="color: #5a1c08;"><?php echo " " . $name . " "; ?></span>Deleted successfuly</p>
          <a href="training.php" class="btn btn-secondary add_ok">OK</a>


        </div>
      <?php
      } else { ?>

        <div class="add-success success">
          <p> <?php echo $response; ?></p>
          <a href="training.php" class="btn btn-secondary add_ok">Back</a>


        </div>
    <?php
      }
    }
    ?>
    <!-- add Services-->

    <script>
      formElem.onsubmit = async (e) => {
        e.preventDefault();
        document.getElementById('loading').style.display = 'block';
        let myForm = document.getElementById('formElem');
        let formData = new FormData(myForm);

        var Auth_token = '<?php echo $Auth_token; ?>';
        axios.post("https://alrawaj.herokuapp.com/api/v1/training", formData, {
            "headers": {
              "auth-token": Auth_token
            },
          })
          .then(res => {
            if (res.data.status == true) {
              window.alert("Training Add Successfuly");
              location.reload();
            } else {

              window.alert(res.data.errMsg);
            }
          })

      };
    </script>