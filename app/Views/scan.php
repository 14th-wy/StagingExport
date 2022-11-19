<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

          <!-- TABLE -->

          <div class="card">
              <div class="card-body">
              <table id="scan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>HDRID</th>
                    <th>Transaction Date</th>
                    <th>Part Number</th>
                    <th>Part Name</th>
                    <th>Production Date</th>
                    <th>QTY</th>
                    <th>Date Scan</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Continent Code</th>
                    <th>Continent Name</th>
                    <th>Casemark</th>
                    <th>Kanban</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

          <!-- END TABLE -->
          </div>
        </div>
      </div>
</section>

<script>
      $(document).ready(function() {
        var table = $("#scan").DataTable({
            // "lengthMenu": [[ 2, 10, 30, -1], [ 2, 10, 30, "All"]],
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('scan/ajaxList') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
        });
    });
</script>

<?= $this->endSection('content'); ?>