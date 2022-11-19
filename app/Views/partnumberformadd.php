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

              <form action="/partnumber/save" method="post">
                <div class="card-body">
                <!-- <input id="date" name="date" hidden> -->
                  <div class="form-group">
                    <label for="part_number">Part Number</label>
                    <input type="text" name="part_number" class="form-control" id="part_number" placeholder="Enter Part Number" autofocus>
                  </div>
                  <div class="form-group">
                    <label for="part Name">Part Name</label>
                    <input type="text" name="part_name" class="form-control" id="part_name" placeholder="Enter Part Name">
                  </div>
                  <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <select class="form-control" id="product_code" name="product_code" onchange="autoFillProduct()">
                      <option value="">--//Pilih Product Code//--</option>
                      <?php foreach($product as $p): ?>
                        <option value="<?= $p['product_code']; ?>"><?= $p['product_code']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="customer_code">Customer Code</label>
                    <select class="form-control" id="customer_code" name="customer_code" onchange="autoFillCustomer()">
                      <option value="">--//Pilih Customer Code//--</option>
                      <?php foreach($customer as $cs): ?>
                        <option value="<?= $cs['customer_code']; ?>"><?= $cs['customer_code']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Customer Name" value="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="continent_code">Continent Code</label>
                    <select class="form-control" id="continent_code" name="continent_code" onchange="autoFillContinent()">
                      <option value="">--//Pilih Continent Code//--</option>
                      <?php foreach($continent as $cn): ?>
                        <option value="<?= $cn['continent_code']; ?>"><?= $cn['continent_code']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="continent_name">Continent Name</label>
                    <input type="text" name="continent_name" class="form-control" id="continent_name" placeholder="Enter Continent Name" value="" readonly>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> ||
                    <a type="submit" class="btn btn-danger" href="/partnumber">Back</a>
                  </div>
              </div>
            </form>

              </div>
          </div>


          </div>
        </div>
      </div>
</section>

<script>

        function autoFillProduct(){
        var product_code = $("#product_code").val();
        $.ajax({
          type : 'GET',
          url : '<?php echo site_url('/partnumber/ajaxProductName'); ?>',
          data : "product_code="+product_code,
        }).success(function (data){
          var json = data;
          console.log(data);
          obj = JSON.parse(json);
          // console.log(obj.product_code.product_name);
          $('#product_name').val(obj.product_code.product_name);
        })
      }

      function autoFillCustomer(){
        var customer_code = $("#customer_code").val();
        $.ajax({
          type : 'GET',
          url : '<?php echo site_url('/customer/ajaxCustomerName'); ?>',
          data : "customer_code="+customer_code,
        }).success(function (data){
          var json = data;
          console.log(data);
          obj = JSON.parse(json);
          // console.log(obj.customer_code.customer_name);
          $('#customer_name').val(obj.customer_code.customer_name);
        })
      }

      function autoFillContinent(){
        var continent_code = $("#continent_code").val();
        $.ajax({
          type : 'GET',
          url : '<?php echo site_url('/continent/ajaxContinentName'); ?>',
          data : "continent_code="+continent_code,
        }).success(function (data){
          var json = data;
          console.log(data);
          obj = JSON.parse(json);
          // console.log(obj.continent_code.continent_name);
          $('#continent_name').val(obj.continent_code.continent_name);
        })
      }
</script>



<?= $this->endSection('content'); ?>