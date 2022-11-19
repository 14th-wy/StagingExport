<?= $this->extend('layout/template'); ?>



<?= $this->section('content'); ?>



<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
            <a type="submit" class="btn btn-success" href="/partnumber/formadd">Tambah Data</a>
              <div class="card-body">
                <table id="partnumber" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Transaction Date</th>
                    <th>Part Number</th>
                    <th>Part Name</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Continent Code</th>
                    <th>Continent Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($join as $j): ?>
                        <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $j['transaction_date']; ?></td>
                        <td><?= $j['part_number']; ?></td>
                        <td><?= $j['part_name']; ?></td>
                        <td><?= $j['product_code']; ?></td>
                        <td><?= $j['product_name']; ?></td>
                        <td><?= $j['customer_code']; ?></td>
                        <td><?= $j['customer_name']; ?></td>
                        <td><?= $j['continent_code']; ?></td>
                        <td><?= $j['continent_name']; ?></td>
                        <td>
                            <a href="/partnumber/edit/<?= $j['part_number']; ?>" class="btn btn-primary">Edit</a> || 
                            <form action="/partnumber/delete/<?= $j['part_number']; ?>" class="d-inline" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return deleteconfig()">Delete</button>
                            </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
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
        var table = $("#partnumber").DataTable({
        });
    });
</script>

<?= $this->endSection('content'); ?>


