<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Data JDIH</h4>
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
            <!-- Admin -->
            <?php if ($this->session->userdata('akses') == 'MPM' || $this->session->userdata('akses') == 'ADMIN'): ?>
            <div style="float: left;">
              <p>Upload Data JDIH :</p>
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/senat/upload_jdih">
                <input type="text" name="judul_jdih" class="form-control" placeholder="Judul JDIH" required>
                <input type="file" name="file_jdih" class="form-control" required>
                <button type="submit" class="btn btn-info btn-sm">Upload</button>
              </form>
              <hr>
            </div>
            <?php endif ?>
            <!-- End Admin -->
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter" id="myTable">
              <thead class=" text-primary">
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Judul
                  </th>
                  <th>
                    Tanggal Upload
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($jdih as $data): ?>
                  <tr>
                    <td>
                      <?php echo ++$i; ?>
                    </td>
                    <td>
                      <?php echo $data->nama; ?>
                    </td>
                    <td>
                      <?php echo $data->tgl_upload; ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url(); ?>jdih/<?php echo $data->files; ?>" target="_blank" class="btn btn-sm btn-success">Download</a>
                      <?php if ($this->session->userdata('akses') == 'MPM' || $this->session->userdata('akses') == 'ADMIN'): ?>
                        <a href="<?php echo base_url(); ?>index.php/senat/deleteJdih/<?php echo $data->nomor; ?>" class="btn btn-sm btn-danger">Hapus</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
