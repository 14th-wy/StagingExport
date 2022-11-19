<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

          <!-- TABLE -->

          <div class="card">
            <div class="card-body">
                <form method="post" action="/import/simpanExcel" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>File Excel</label>
                    <input type="file" name="fileexcel" class="form-control-file" id="file" required accept=".xls, .xlsx" /></p>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Upload</button>
                  </div>
                </form>
                <table id="import" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Casemark</th>
                    <th>Kanban</th>
                    <th>Qty</th>
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
        var table = $("#import").DataTable({
            // "lengthMenu": [[ 2, 10, 30, -1], [ 2, 10, 30, "All"]],
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('import/ajaxList') ?>",
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