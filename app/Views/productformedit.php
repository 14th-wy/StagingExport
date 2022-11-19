<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">



          <div class="card">
              <div class="card-body">

              <div class="card card-success">
              <div class="card-header">
              </div>

              <form action="/product/update/<?= $product['product_code']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <input type="text" name="product_code" class="form-control" id="product_code" placeholder="Enter product Code" disabled value="<?= $product["product_code"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="product Name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product Code" value="<?= $product["product_name"]; ?>">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> ||
                  <a type="submit" class="btn btn-danger" href="/product">Back</a>
                </div>
              </form>
            </div>

              </div>
          </div>


          </div>
        </div>
      </div>
</section>





<?= $this->endSection('content'); ?>