<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Data Mahasiswa Puasa</h4>
            <?php if ($this->session->flashdata('notif') != null): ?>
              <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Success - </b> <?php echo $this->session->flashdata('notif'); ?></span>
                </div>
            <?php endif ?>
            <div class="switchToggle" style="float: right;">
              <p>Daftar Puasa :</p> 
              <p>Tanggal <?php echo $tanggal_puasa; ?></p>
              <form method="post" action="<?php echo base_url(); ?>index.php/senat/daftar_puasa" <?php if ($status_puasa == 'Tidak'): ?>onClick="alert('Pendaftaran Puasa ditutup')"<?php endif ?>>
                <input type="checkbox" name="switch_daftar_puasa" id="switch" <?php if ($status_puasa == 'Tidak'): ?>disabled<?php endif ?> <?php if ($this->session->userdata('puasa') == 'Ya'): ?>
                  checked
                <?php endif ?> onChange="this.form.submit()" value="<?php if ($this->session->userdata('puasa') == 'Tidak'): ?>Ya<?php else: ?>Tidak<?php endif ?>">
                <label for="switch">Toggle</label>
              </form>
            </div>
            <!-- Admin -->
            <?php if ($this->session->userdata('departemen') == 'Departemen Rohani' || $this->session->userdata('akses') == 'ADMIN'): ?>
            <div style="float: left;">
              <p>Buka/Tutup Puasa :</p>
              <form method="post" action="<?php echo base_url(); ?>index.php/senat/buka_tutup_puasa">
                <input type="checkbox" <?php if ($status_puasa == 'Ya'): ?>checked<?php endif ?> data-toggle="toggle" data-on="Buka" data-off="Tutup" data-onstyle="success" data-offstyle="danger" onChange="this.form.submit()">
              </form>
              <hr>
              <div>
                <form method="post" action="<?php echo base_url(); ?>index.php/senat/reset_puasa">
                  Reset data puasa : <br><button type="submit" onclick="return confirm('Yakin?')" class="btn btn-sm btn-warning">Reset</button>
                </form>
              </div>
              <hr>
              <form method="post" action="<?php echo base_url(); ?>index.php/senat/tanggal_puasa">
                <p>Pilih tanggal puasa : </p>
                <div class="row">
                  <div class="col-md-8">
                     <input type="date" name="tanggal_puasa" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-success btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <?php endif ?>
            <!-- End Admin -->
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter" id="tablepuasa">
              <thead class=" text-primary">
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Nama
                  </th>
                  <th>
                    NPM
                  </th>
                  <th>
                    Kelas
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($puasa as $data): ?>
                  <tr>
                    <td>
                      <?php echo htmlentities(++$i); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->nama); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->NPM); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->kelas); ?>
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
