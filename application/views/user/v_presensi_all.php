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
                    <h4>Daftar Presensi Keseluruhan</h4>
                  </div>
                  <div class="card-body">
                  <input type="hidden" name="kode" id="kode">
                  <input type="hidden" name="mulai" id="mulai">
                  <input type="hidden" name="akhir" id="akhir">
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
                  <div class="section-title mt-0">Filter</div>
                    <div class="row">
                        <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control datepicker" id="start-date">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control datepicker" id="end-date">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2 col-md-2 col-lg-2">
                          <div class="form-group">
                            <label>Cari</label>
                            <div class="input-group">
                              <input type="hidden" name="start-date" id="start-date">
                              <input type="hidden" name="end-date" id="end-date">
                              <a href="javascript:void(0)" id="btn-filter" class="btn btn-primary daterange-btn icon-left btn-icon"><i class="fas fa-filter"></i> Filter</a>
                            </div>
                          </div>
                        </div>
                    </div>                    
                    <hr>
                    <div class="table-responsive">
                      <table class="table table-striped" id="presensi-all-table">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Pegawai</th>
                            <th>Status</th>
                            <th>Tipe Absen</th>
                            <th>Waktu</th>
                            <th>Kondisi Kesehatan</th>
                            <!-- <th>Aksi</th> -->
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