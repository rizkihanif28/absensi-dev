      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title;?></h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Daftar Presensi Saya</h4>
                  </div>
                  <div class="card-body">
                  <input type="hidden" name="kode" id="kode">
                  <div class="text-center">
                    <!-- Alert absensi -->
                    <?php if ($this->session->flashdata('success')) { ?>                
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php } ?>
                  </div>
                    <div class="table-responsive">
                      <table class="table table-striped" id="presensi-table">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Tipe Absen</th>
                            <th>Waktu</th>
                            <th>Kondisi Kesehatan</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>

<!-- Modal -->
<div class="modal fade" id="mdl-sakit" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
              <div class="list-peserta">
                <div class="form-group">
                  <div class="table-responsive">
                      <table class="table table-striped" id="tbl-keluhan">
                          <thead class="text-center" style="background-color:#6777ef;">
                              <tr>                                  
                                  <th class="text-white">No</th>
                                  <th class="text-white">Keluhan</th>
                              </tr>
                          </thead>
                      </table>
                  </div>                
                </div>
              </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
