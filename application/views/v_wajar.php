<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Data Mahasiswa Wajib Belajar</h4>
            <?php if ($this->session->flashdata('notif') != null): ?>
              <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Success - </b> <?php echo $this->session->flashdata('notif'); ?></span>
                </div>
            <?php endif ?>
          <!-- Admin -->
            <?php if ($this->session->userdata('departemen') == 'Departemen Akademik Mahasiswa' || $this->session->userdata('akses') == 'ADMIN'): ?>
            <div style="float: left;">
              <div>
                <form method="post" action="<?php echo base_url(); ?>index.php/senat/reset_wajar">
                  Reset data wajib belajar : <br><button type="submit" onclick="return confirm('Yakin?')" class="btn btn-sm btn-warning">Reset</button>
                </form>
              </div>
            </div>
            <?php endif ?>
            <br>
            <br>
            <br>
            <!-- End Admin -->
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link <?php if ($active == 'Sudah'): ?>active<?php endif ?>" href="<?php echo base_url(); ?>index.php/senat/wajar">Sudah Absen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if ($active == 'Belum'): ?>active<?php endif ?>" href="<?php echo base_url(); ?>index.php/senat/belum_wajar">Belum Absen</a>
            </li>
          </ul>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter" id="tablewajar">
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
                <?php $i=0; foreach ($absen as $data): ?>
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
