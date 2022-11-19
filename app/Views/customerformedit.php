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

              <form action="/customer/update/<?= $customer['customer_code']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="customer_code">Customer Code</label>
                    <input type="text" name="customer_code" class="form-control" id="customer_code" placeholder="Enter customer Code" disabled value="<?= $customer["customer_code"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="customer Name">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter customer Code" value="<?= $customer["customer_name"]; ?>">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> ||
                  <a type="submit" class="btn btn-danger" href="/customer">Back</a>
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