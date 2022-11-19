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

              <form action="/continent/update/<?= $continent['continent_code']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="continent_code">Continent Code</label>
                    <input type="text" name="continent_code" class="form-control" id="continent_code" placeholder="Enter Continent Code" disabled value="<?= $continent["continent_code"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Continent Name">Continent Name</label>
                    <input type="text" name="continent_name" class="form-control" id="continent_name" placeholder="Enter Continent Code" value="<?= $continent["continent_name"]; ?>">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> ||
                  <a type="submit" class="btn btn-danger" href="/continent">Back</a>
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