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

              <form action="/partnumber/update/<?= $part_number['part_number']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="part_number">Part Number</label>
                    <input type="text" name="part_number" class="form-control" id="part_number" placeholder="Enter Part Number" readonly value="<?= $part_number["part_number"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" name="part_name" class="form-control" id="part_name" placeholder="Enter Part Name" value="<?= $part_number["part_name"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <select class="form-control" id="product_code" name="product_code" onchange="autoFillProduct()">
                    <option value="" disabled>--//Pilih Product Code//--</option>
                    <option value="P202201001" <?php if($part_number['product_code'] == "P202201001") {echo "selected";} ?>>P202201001</option>
                    <option value="P202201002" <?php if($part_number['product_code'] == "P202201002") {echo "selected";} ?>>P202201002</option>
                    <option value="P202201003" <?php if($part_number['product_code'] == "P202201003") {echo "selected";} ?>>P202201003</option>
                    <option value="P202201004" <?php if($part_number['product_code'] == "P202201004") {echo "selected";} ?>>P202201004</option>
                    <option value="P202201005" <?php if($part_number['product_code'] == "P202201005") {echo "selected";} ?>>P202201005</option>
                    <option value="P202201006" <?php if($part_number['product_code'] == "P202201006") {echo "selected";} ?>>P202201006</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name" readonly value="<?= $part_number['product_name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="customer_code">Customer Code</label>
                    <select class="form-control" id="customer_code" name="customer_code" onchange="autoFillCustomer()">
                      <option value="" disabled>--//Pilih Customer Code//--</option>
                      <option value="CS202201001" <?php if($part_number['customer_code'] == "CS202201001") {echo "selected";} ?>>CS202201001</option>
                      <option value="CS202201002" <?php if($part_number['customer_code'] == "CS202201002") {echo "selected";} ?>>CS202201002</option>
                      <option value="CS202201003" <?php if($part_number['customer_code'] == "CS202201003") {echo "selected";} ?>>CS202201003</option>
                      <option value="CS202201004" <?php if($part_number['customer_code'] == "CS202201004") {echo "selected";} ?>>CS202201004</option>
                      <option value="CS202201005" <?php if($part_number['customer_code'] == "CS202201005") {echo "selected";} ?>>CS202201005</option>
                      <option value="CS202201006" <?php if($part_number['customer_code'] == "CS202201006") {echo "selected";} ?>>CS202201006</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Customer Name" readonly value="<?= $part_number['customer_name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="continent_code">Continent Code</label>
                    <select class="form-control" id="continent_code" name="continent_code" onchange="autoFillContinent()">
                      <option value="" disabled>--//Pilih Continent Code//--</option>
                      <option value="CN202201001" <?php if($part_number['continent_code'] == "CN202201001") {echo "selected";} ?>>CN202201001</option>
                      <option value="CN202201002" <?php if($part_number['continent_code'] == "CN202201002") {echo "selected";} ?>>CN202201002</option>
                      <option value="CN202201003" <?php if($part_number['continent_code'] == "CN202201003") {echo "selected";} ?>>CN202201003</option>
                      <option value="CN202201004" <?php if($part_number['continent_code'] == "CN202201004") {echo "selected";} ?>>CN202201004</option>
                      <option value="CN202201005" <?php if($part_number['continent_code'] == "CN202201005") {echo "selected";} ?>>CN202201005</option>
                      <option value="CN202201006" <?php if($part_number['continent_code'] == "CN202201006") {echo "selected";} ?>>CN202201006</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="continent_name">Continent Name</label>
                    <input type="text" name="continent_name" class="form-control" id="continent_name" placeholder="Enter Continent Name" readonly value="<?= $part_number['continent_name']; ?>">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button> ||
                  <a type="submit" class="btn btn-danger" href="/partnumber">Back</a>
                </div>
              </form>
            </div>

              </div>
          </div>


          </div>
        </div>
      </div>
</section>

<script type="text/javascript">
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