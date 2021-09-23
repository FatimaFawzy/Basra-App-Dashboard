<?php
session_start();
if (!isset($_SESSION['Auth-Token'])) {
  header('location:login-merchant.php'); //redirect to login page
}
include 'init.php';
include $tp . 'merch_dashboard.php';
$Auth_token = $_SESSION['Auth-Token'];
$merch_id = $_SESSION['marchant_id'];
?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<span class="link" style="display:none;">ArabicBages/ar_product.php</span>
<link rel="stylesheet" href="<?php echo $css; ?>product.css" />
<style media="screen">
  .edit .fa-pencil-alt :hover {
    color: black;
  }

  .customer {
    background-color: #e55507a3;
    border: none;
  }

  .lang {
    display: none;
  }
</style>
<!--get prodect Request-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $GLOBALS['cat_id'] = $_POST['cat_id'];
  $GLOBALS['cat_name'] = $_POST['cat_name'];
  $GLOBALS['ar_cat_name'] = $_POST['ar_cat_name'];
}
$cat_id = $GLOBALS['cat_id'];
$cat_id = (int)$cat_id;
?>
<form class="form" action="ArabicBages/ar_product.php" method="POST" style="left: 94%;">
  <input type="hidden" name="cat_id" value=" <?php echo $cat_id; ?>">
  <input type="hidden" name="cat_name" value=" <?php echo $GLOBALS['cat_name']; ?>">
  <input type="hidden" name="ar_cat_name" value=" <?php echo  $GLOBALS['ar_cat_name']; ?>">
  <button type="submit" name="" class=" logout">AR</button>
</form>
<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://alrawaj.herokuapp.com/api/v1/merchants/$merch_id/categories/$cat_id/products",
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
$response = json_decode($response, true);
$product = $response['data'];
?>

<div class="auto-margin">
  <div class="prod-header">
    <i class="fa fa-shopping-bag pro-fa"></i>
    <h3 class="product-header">Product Of <span class="cat_name"><?php echo $cat_name; ?></span></h3>
    <span class="thecount"> There Are <span class="cnumb">
        <span style="color: #e55508;"><?php echo count($product); ?></span></span> Product</span>

    <!-- Button add products  modal -->
    <a class=" add" data-toggle="modal" data-target="#add-product">
      <span class="over-add">
        <i class="fas fa-plus-circle"></i>
      </span>
      <span style="position:relative"> Add<i class="fas fa-plus-circle"></i>Product</span>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="add-productLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="add-productLabel">Add Product To <span class="cat_name"><?php echo $cat_name; ?></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="font-size: 19px;">
            <input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>">
            <input type="hidden" name="ar_cat_name" value="<?php echo $ar_cat_name; ?>">
            <input type="hidden" id="merch_id" value="<?php echo $merch_id; ?>">
            <input type="hidden" id="cat_id" value="<?php echo $cat_id; ?>">
            <div class="loading" id="loading">Pleas Wait loading......</div>
            <form action="post" enctype="multipart/form-data" id="formElem">

              <div class=" row input_group">
                <div class="col-md-5" style="margin-left: 39px;">
                  <label>Name:</label>
                  <input type="text" name="name" required>
                </div>
                <div class="col-md-5">
                  <label>Arabic Name:</label>
                  <input type="text" name="nameAr" required>
                </div>
              </div>
              <div class=" row  in_price input_group">
                <div class="col-md-4">
                  <label>Price:</label>
                  <input type="text" name="price" placeholder="In Iraqi Coin" required>
                </div>

                <div class="col-md-4">
                  <label>Discount:</label>
                  <span class="dis-prec">%</span>
                  <input type="number" name="discount" id="discount" placeholder="number%" class="discount">
                  <span class="prcent"># This Percent(%) number</span>
                </div>
                <div class="col-md-4">
                  <label>Quantity:</label>
                  <input type="text" name="stock" required>
                </div>
              </div>
              <div class=" row input_group">
                <div class="col-md-5">

                  <textarea name="describtion" required rows="4" cols="40" required placeholder=" Description"></textarea>
                </div>
                <div class="col-md-6" style="margin-left: 57px;">

                  <textarea name="describtionAr" rows="4" cols="40" required placeholder="Arabic Description"></textarea>

                </div>

              </div>
              <div class="input_group" style="float:left;">
                <label>Image:</label>
                <input type="file" name="image" required>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-secondary" name="add_product" value="Add">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--end modal-->
  </div>
  <!-- end add product-->

  <div class=" row">
    <?php
    if (!empty($product)) {
      foreach ($product as $value) { ?>
        <div class="col-md-3 product-grid">
          <div class="product-items">
            <div class="prodect-img">

              <!-- Edit products  modal -->

              <form method="post" action="edit_product.php" enctype="multipart/form-data" style="    display: inline-block;">
                <input type="hidden" name="name" value="<?php echo $value['name']; ?>">
                <input type="hidden" name="nameAr" value="<?php echo $value['nameAr']; ?>">
                <input type="hidden" name="price" value="<?php echo $value['price']; ?>">
                <input type="hidden" name="discount" value="<?php echo $value['discount']; ?>">
                <input type="hidden" name="stock" value="<?php echo $value['stock']; ?>">
                <input type="hidden" name="describtion" value="<?php echo $value['describtion']; ?>">
                <input type="hidden" name="describtionAr" value="<?php echo $value['describtionAr']; ?>">
                <input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>">
                <input type="hidden" name="ar_cat_name" value="<?php echo $ar_cat_name; ?>">
                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                <input type="hidden" name="product_id" value="<?php echo $value['id']; ?>">
                <input type="hidden" name="image" value="<?php echo $value['image']; ?>">
                <abbr title="Edit Product">
                  <button type="submit" class="btn btn-secondary edit " name="editproduct" style="border: none;
    background: transparent">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </abbr>
              </form>

              <!--end edite-->
              <!-- Button Delet product modal -->
              <abbr title="Delet product">
                <a data-toggle="modal" data-target="#<?php echo $value['id']; ?>delet-product">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </abbr>
              <!-- Modal -->
              <div class="modal fade" id="<?php echo $value['id']; ?>delet-product" tabindex="-1" role="dialog" aria-labelledby="<?php echo $value['id']; ?>Labeldelet" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="<?php echo $value['id']; ?>Labeldelet">Delet Product </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ff1f00;">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="font-size: 19px;text-align: left;">
                      <p style="color: #404848;">Delet prodect<span style="color: #009688;"> <?php echo $value['name']; ?></span> Are you sure!?</p>

                      <form action="deletproduct.php" method="post">
                        <input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>">
                        <input type="hidden" name="merch_id" value="<?php echo $merch_id; ?>">
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $value['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $value['name']; ?>">

                        <div class="modal-footer">
                          <input type="submit" class="btn btn-secondary" name="delet_product" value="Delet">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--end modal-->
              <img class="img-responsive" src="<?php echo $value['image']; ?>" alt="">
            </div>
            <div class="produ-cost">

              <h3><?php echo $value['name']; ?></h3>
              <span class="color">Price:<span class="valcolor"><?php echo $value['price']; ?></span></span>

              / <p class="color">
                <span>Discount:<span class="valcolor">
                    <?php echo $value['discount'] * 100 . "%"; ?>
                  </span>
                </span>
              </p>/
              <p class="color"> <span>Quantity:<span class="valcolor"><?php echo $value['stock']; ?></span></span></p>
              <hr>
              <p class="discription"> <?php echo $value['describtion']; ?></p>

            </div>
          </div>
        </div>
      <?php
      }
    } else { ?>
      <div class="success">
        <p> No content</p>
      </div>
    <?php } ?>

  </div>
</div>
</div>
<!-- add product-->
<script>
  formElem.onsubmit = async (e) => {
    e.preventDefault();
    document.getElementById('loading').style.display = 'block';
    var discount = document.getElementById('discount').value / 100;
    var precent_dis = discount * 100;
    var discount = precent_dis / 100;

    document.getElementById('discount').value = discount;

    let myForm = document.getElementById('formElem');
    let formData = new FormData(myForm);
    var merchantsId = document.getElementById('merch_id').value;
    var categoriesId = document.getElementById('cat_id').value;
    var Auth_token = '<?php echo $Auth_token; ?>';

    axios.post("https://alrawaj.herokuapp.com/api/v1/merchants/" + merchantsId + "/categories/" + categoriesId + "/products", formData, {
        "headers": {
          "auth-token": Auth_token
        },
      })
      .then(res => {
        if (res.data.status == true) {
          location.reload();
        } else {

          window.alert(res.data.errMsg);
        }
      })
  };
</script>