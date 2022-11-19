<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

          <!-- TABLE -->

          <div class="card">
              <div class="card-body">
                <table id="staging" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>HDRID</th>
                    <th>Transaction Date</th>
                    <th>Date Scan</th>
                    <th>Continent Code</th>
                    <th>Kanban</th>
                    <th>Casemark</th>
                    <th>Staging 1</th>
                    <th>Staging 2</th>
                    <th>Staging 3</th>
                    <th>Staging 4</th>
                    <th>Status</th>
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
        var table = $("#staging").DataTable({
            // "lengthMenu": [[ 2, 10, 30, -1], [ 2, 10, 30, "All"]],
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('staging/ajaxList') ?>",
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