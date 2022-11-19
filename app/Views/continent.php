<?= $this->extend('layout/template'); ?>



<?= $this->section('content'); ?>



<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
            <a type="submit" class="btn btn-success" href="/continent/formadd">Tambah Data</a>
              <div class="card-body">
                <table id="continent" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Continent Code</th>
                    <th>Continent Name</th>
                    <th>Action</th>
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

<!-- <script>
        function deleteconfig(){
            var tujuan=$(this).attr('id');
            var hapusin=confirm("Apakah Anda yakin ingin menghapus data ini?");
                if(hapusin==true){
                    window.location.href=tujuan;
                }
                else{
                    alert("Data Batal dihapus");
                }
            return hapusin;
        }
    </script> -->

<script type="text/javascript">
    function deleteconfig(){
        var tujuan=$(this).attr('id');
        var hapusin=confirm("Apakah Anda yakin ingin menghapus data ini?");
            if(hapusin==true){
                window.location.href=tujuan;
            }
            else{
                alert("Data Batal dihapus");
            }
        return hapusin;
    }

    $(document).ready(function() {
        var table = $("#continent").DataTable({
            // "lengthMenu": [[ 2, 10, 30, -1], [ 2, 10, 30, "All"]],
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('continent/ajaxList') ?>",
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


