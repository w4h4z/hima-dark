<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title">Admin | Tambah Mahasiswa</h4>
          <?php if ($this->session->flashdata('success') != null): ?>
            <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span><b> Success - </b> <?php echo $this->session->flashdata('success'); ?></span>
            </div>
          <?php endif ?>
          <?php if ($this->session->flashdata('fail') != null): ?>
            <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
              <span><b> Failed - </b> <?php echo $this->session->flashdata('fail'); ?></span>
            </div>
            <?php endif ?>        
          </div>
          <hr>
            <div class="col-md-12">
              <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-csv">Upload CSV</button>
            </div>
          <hr>
            <div class="card-body">
              <form method="post" action="<?php echo base_url(); ?>index.php/senat/insert_mhs">
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>NPM</label>
                      <input type="number" class="form-control" placeholder="NPM" autocomplete="off" required name="npm">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" placeholder="Nama" autocomplete="off" required name="nama">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>Kelas</label>
                      <input type="text" class="form-control" placeholder="Kelas" autocomplete="off" required name="kelas">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>Departemen</label>
                      <input type="text" class="form-control" placeholder="Departemen" autocomplete="off" name="departemen">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" class="form-control" placeholder="Jabatan" autocomplete="off" name="jabatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 pr-md-1">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" autocomplete="off" required name="password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-info">Save</button>
                <button type="reset" class="btn btn-fill btn-danger">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modal-csv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>index.php/senat/insert_mhs_csv" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-form-label"></label>
            <input type="file" name="file-csv" class="form-control" id="file-csv" required style="opacity: 1; height: fit-content; color: black">
          </div>
          <a href="<?php echo base_url(); ?>doc/data.csv" target="_blank" style="margin-top: 20px" class="btn btn-info btn-sm">Download Template CSV</a>
          <p style="margin-top: 10px">*use ; for delimeter</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-pass" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>