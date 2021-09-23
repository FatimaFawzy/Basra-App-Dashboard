<?php
session_start();
include 'init.php';
if (!isset($_SESSION['Auth-Token'])) {
  header('location:login.php'); //redirect to login page
}
include $tp . 'ar_dashboard.php';
$Auth_token = $_SESSION['Auth-Token'];
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="<?php echo $css; ?>services.css" />
<link rel="stylesheet" href="<?php echo $css; ?>request.css" />
<span class="link" style="display:none;">../services.php</span>

<style media="screen">
  .services {
    background-color: #009688;
    border: none;
  }

  form {
    direction: ltr;

  }

  .modal-content {
    font-weight: bold;
  }

  .add {
    float: left;
  }

  .Customer-header {
    margin-right: 21px;
    margin-left: 21px;
  }
</style>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/service",
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
<div class="auto-margin Ar_auto-margin">
  <div class="Customer-header">
    <h3>الخدمات</h3>
    <span class="count"> يوجد <span class="cnumb"><span style="color: #e55508;"><?php echo count($service); ?></span></span> خدمة</span>

    <!-- Button add service  modal -->
    <a class=" add" data-toggle="modal" data-target="#add-product">
      <span class="over-add">
        <i class="fas fa-plus-circle"></i>
      </span>
      <span style="position:relative"> اضافة<i class="fas fa-plus-circle"></i>خدمة</span>
    </a>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="add-productLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content add_serv">
        <div class="modal-header">
          <h5 class="modal-title" id="add-productLabel">اضافة خدمة </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    margin: 0;">
            <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
          </button>
        </div>
        <div class="modal-body Ar_body" style="font-size: 19px;">
          <div class="loading" id="loading"> جاري التحميل الرجاء الانتظار......</div>
          <form action="post" enctype="multipart/form-data" name="form" id="formElem">
            <div class=" row input_group">
              <div class="col-md-6">
                <label> Tite :</label>
                <input type="text" name="title" required>
              </div>

              <div class="col-md-6">

                <input type="text" name="titleAr" required>
                <label>: عنوان الخدمة</label>
              </div>
            </div>
            <div class="input_group" style="float:left;">
              <label style="margin-left: 77px;margin-top: 25px;">صورة : </label>
              <input type="file" name="image" required>
            </div>
            <div class="modal-footer ar_modal-footer">
              <button type="button" class="btn btn-secondary view" data-dismiss="modal">الغاء</button>
              <input type="submit" class="btn btn-secondary view" name="add_service" value="اضافة">
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
                  <h4 class="title"><?php echo $value['titleAr']; ?> </h4>
                </div>
                <div class="row">

                  <!-- delet service-->
                  <button type="button" class="btn btn-primary view" data-toggle="modal" data-target="#<?php echo $value['id']; ?>delet" style="margin-right: -27px;
    padding-right: 15px;">
                    حذف<i class="fas fa-trash-alt"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="<?php echo $value['id']; ?>delet" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>deletLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content" style="margin-top: 67px;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="<?php echo $value['id']; ?>deletLabel">حذف الخدمة </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    margin: 0;">
                            <span style="color: #c7421b;" aria-hidden="true" style="color: #ff1f00;">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body ِAr_body" style="font-size: 19px;">
                          <p>حذف خدمة<span style="color: #009688;"> <?php echo $value['titleAr']; ?></span> هل انت متأكد !؟</p>

                          <form action="ar_services.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                            <input type="hidden" name="name" value="<?php echo $value['titleAr']; ?>">
                            <div class="modal-footer ar_modal-footer">

                              <button type="button" class="btn btn-secondary view delet" data-dismiss="modal">الغاء</button>
                              <input type="submit" class="btn btn-secondary view" name="delet" value="حذف">

                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--end Delet service-->
                  <!-- Button View Request -->
                  <button type="button" class="btn btn-primary view" data-toggle="modal" data-target="#<?php echo $value['id']; ?>">
                    طلبات الخدمة
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>req" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content req">
                        <div class="modal-header">
                          <h5 class="modal-title" id="<?php echo $value['id']; ?>req">طلبات الخدمة
                            <span class="train-title"><?php echo $value['titleAr']; ?></span>
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    margin: 0;">
                            <span style="color: #c7421b;" aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body body Ar_body">
                          <?php if (!empty($value['serviceRequests'])) { ?>
                            <table class="table">

                              <thead>
                                <tr>
                                  <th scope="col">الاسم</th>
                                  <th scope="col">الهاتف</th>
                                  <th scope="col">المدينة</th>
                                  <th scope="col">الفترة الزمنية</th>
                                  <th scope="col">الايام</th>
                                  <th scope="col">العملية</th>
                              </thead>
                              </tr>
                              <?php foreach ($value['serviceRequests'] as $value) { ?>
                                <tr>
                                  <td scope="row"><?php echo $value['clientName']; ?></td>
                                  <td scope="row"><?php echo $value['phone']; ?></td>
                                  <td scope="row"><?php echo $value['city']; ?></td>
                                  <td scope="row"><?php echo $value['duration']; ?></td>
                                  <td scope="row"><?php echo $value['days']; ?></td>
                                  <td scope="row">
                                    <!-- Button Delet Request modal -->
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?php echo $value['id']; ?>del" style="background: transparent;border: none;">
                                      <abbr title=" حذف الطلب"><i class="fas fa-trash-alt"></i></abbr>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal   modal-dismiss fade" id="<?php echo $value['id']; ?>del" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>delLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="<?php echo $value['id']; ?>delLabel"> حذف طلب الخدمة </h5>

                                          </div>
                                          <div class="modal-body Ar_body" style="font-size: 19px;">
                                            <p>حذف طلب<span style="color: #009688;"> <?php echo $value['clientName']; ?></span> هل انت متأكد!؟</p>

                                            <form action="ar_delet_service_req.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                              <input type="hidden" name="name" value="<?php echo $value['clientName']; ?>">
                                              <div class="modal-footer ar_modal-footer">
                                                <button type="button" class="btn btn-secondary delet-req-close" data-dismiss="">الغاء</button>
                                                <input type="submit" class="btn btn-secondary" name="delet" value="حذف">
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
                                  <p> لايوجد محتوى</p>
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
        echo "لايوجد محتوى";
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
        CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/service/$id",
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

        <div class="success add-success">
          <p>الخدمة<span style="color: #5a1c08;"><?php echo " " . $name . " "; ?></span>حذفت بنجاح</p>
          <a href="ar_services.php" class="btn btn-secondary add_ok">تم</a>

        </div>
      <?php
      } else { ?>

        <div class="success add-success">
          <p> <?php echo $response; ?></p>
          <a href="ar_services.php" class="btn btn-secondary add_ok">رجوع</a>

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
        axios.post("https://alrawaj.herokuapp.com/api/v1/service", formData, {
            "headers": {
              "auth-token": Auth_token
            },
          })
          .then(res => {
            if (res.data.status == true) {
              window.alert("تمت اضافة الخدمة بنجاح");
              location.reload();
            } else {

              window.alert(res.data.errMsg);
            }
          })

      };
    </script>