<?php
session_start();
if (!isset($_SESSION['Auth-Token'])) {
  header('location:login-merchant.php'); //redirect to login page
}

include 'init.php';
include $tp . 'header.php';
$Auth_token = $_SESSION['Auth-Token'];
$merch_id = $_SESSION['marchant_id'];
?>
<link rel="stylesheet" href="<?php echo $css; ?>dashboared.css" />
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="<?php echo $css; ?>product.css" />
<style media="screen">
  .row {
    text-align: center;
    justify-content: center;
  }

  #image {
    display: block;
    margin-top: 15px;
    color: #009688;
    border: 1px solid #009688;
    background: #e8dfc4;
    padding: 6px;
    width: 70%;
  }

  h3 {
    text-align: center;
    color: #35a87c;
    margin-top: -31px;
  }

  .edite-image button {
    font-size: larger;
    background: #009688ba;
    border: 1px solid #009688;
    color: white;
    border-radius: 36%;
    line-height: 1.5;
    margin-left: 14px;
  }

  label {
    font-size: x-large;
  }

  .edite-image {
    float: right;

  }

  .modal-footer {
    margin-top: 10px;
  }
</style>
<?php
if (isset($_POST['editproduct']) == 1) {
  $cat_id = $_POST['cat_id'];
  $product_id = $_POST['product_id'];
  $cat_name = $_POST['cat_name'];
  $ar_cat_name = $_POST['ar_cat_name'];
  $ar_product_name = $_POST['ar_product_name'];
  $image = $_POST['image'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $discount = $_POST['discount'];
  $stock = $_POST['stock'];
  $description = $_POST['describtion'];
  $descriptionAr = $_POST['describtionAr'];
}
?>

<input type="hidden" id="cat_id" value="<?php echo $cat_id; ?>">
<input type="hidden" id="product_id" value="<?php echo $product_id; ?>">
<div class="container">
  <div class="add-prod" style="padding: 41px;">
    <h3>تعديل المنتج <span><?php echo $ar_product_name; ?></span></h3>
    <div class="loading" id="loading">..... جاري التحميل الرجاء الانتظار</div>
    <form action="Post" enctype="multipart/form-data" id="formElem">
      <div class=" row input_group">
        <div class="col-md-6">
          <label>New Name:</label>
          <input type="text" name="name" value="<?php echo $name; ?>" required>
        </div>

        <div class="col-md-6">
          <input type="text" name="nameAr" value="<?php echo $ar_product_name; ?>" required>
          <label>: تحديث الاسم </label>

        </div>
      </div>
      <div class=" row  in_price input_group">
        <div class="col-md-4">
          <input type="text" name="price" value="<?php echo $price; ?>" required>
          <label>: تحديث السعر</label>

        </div>

        <div class="col-md-4">

          <span class="dis-prec" style=" top: 9px;">%</span>
          <input type="number" name="discount" id="discount" placeholder="رقم%" class="discount" required>
          <label>: تحديث الخصم</label>
          <span class="prcent">يجب ان تكون نسبة مئوية(%)</span>

        </div>
        <div class="col-md-4">

          <input type="text" name="stock" value="<?php echo $stock; ?>">
          <label>: تحديث الكمية</label>
        </div>
      </div>
      <div class=" row input_group">
        <div class="col-md-5">

          <textarea name="describtion" rows="4" cols="40" placeholder=" New Description" required><?php echo $description; ?></textarea>
        </div>
        <div class="col-md-6" style="margin-left: 57px;">

          <textarea name="describtionAr" rows="4" cols="40" placeholder="تحديث الوصف " style="direction: rtl" required><?php echo $descriptionAr; ?></textarea>

        </div>

      </div>
      <div class=" row input_group" id="append" style="float:right;">

        <img id="img" src="<?php echo $image; ?>" width="150px" height="100px" />
        <input type="file" accept="image/*" name="image" id="image" style="display:none">
        <input type="hidden" name="image" id="imgtext" value="<?php echo $image; ?>">
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary" name="editproduct" value="حفظ">
      </div>
    </form>
    <div class="edite-image" id="edite-image">
      <label id="label" style="display: block;"> تحديث الصورة؟ </label>
      <button id="yes" onclick="removetext()">نعم</button>
      <button id="no" onclick="removefile()">كلا</button>
      <button id="cancele" onclick="cancel()" style="display:none">الغاء</button>
    </div>

    <div class="modal-footer">
      <form action="ar_product.php" method="post">
        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
        <input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>">
        <input type="hidden" name="ar_cat_name" value="<?php echo $ar_cat_name; ?>">
        <button type="submit" class="btn btn-secondary">رجوع</button>
      </form>
    </div>
  </div>
</div>
<script>
  var label = document.getElementById("label");
  var yes = document.getElementById("yes");
  var no = document.getElementById("no");
  var text = document.getElementById("imgtext");
  var file = document.getElementById("image");
  var cancele = document.getElementById("cancele");

  function removetext() {
    document.getElementById("image").style.display = 'block';
    text.remove();
    yes.remove();
    no.remove();
    label.remove();
    cancele.style.display = 'block';

  }

  function removefile() {
    file.remove();
    yes.remove();
    no.remove();
    label.remove();
    cancele.style.display = 'block';
  }

  function cancel() {
    var parentElement = document.getElementById("edite-image");
    var append = document.getElementById("append");
    parentElement.append(label);
    parentElement.append(yes);
    parentElement.append(no);
    append.append(file);
    file.style.display = 'none';
    append.append(text);
    cancele.style.display = 'none';
  }

  formElem.onsubmit = async (e) => {
    e.preventDefault();
    document.getElementById('loading').style.display = 'block';
    var discount = document.getElementById('discount').value / 100;
    var precent_dis = discount * 100;
    var discount = precent_dis / 100;

    let myForm = document.getElementById('formElem');
    let formData = new FormData(myForm);
    console.log(formData)
    var productId = document.getElementById('product_id').value;
    var categoriesId = document.getElementById('cat_id').value;
    var Auth_token = '<?php echo $Auth_token; ?>';
    var merch_id = '<?php echo $merch_id; ?>';
    axios.put("https://alrawaj.herokuapp.com/api/v1/merchants/" + merch_id + "/categories/" + categoriesId + "/products/" + productId, formData, {
        "headers": {
          "auth-token": Auth_token
        },
      })
      .then(res => {
        if (res.data.status == true) {
          window.alert("تم تعديل المنتج بنجاح")
          location.reload();


        } else {

          window.alert(res.data.errMsg);
        }

      })

  };
</script>
<?php include $tp . 'footer.php'; ?>