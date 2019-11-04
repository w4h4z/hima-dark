<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Leaderboard</h4>
            <?php if ($this->session->flashdata('notif') != null): ?>
              <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span><b> Success - </b> <?php echo $this->session->flashdata('notif'); ?></span>
                </div>
            <?php endif ?>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter" id="tableleader">
              <thead class=" text-primary">
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Tingkat
                  </th>
                  <th>
                    Emas
                  </th>
                  <th>
                    Perak
                  </th>
                  <th>
                    Perunggu
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($leader as $data): ?>
                  <tr>
                    <td>
                      <?php echo htmlentities(++$i); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->tingkat); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->emas); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->perak); ?>
                    </td>
                    <td>
                      <?php echo htmlentities($data->perunggu); ?>
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
