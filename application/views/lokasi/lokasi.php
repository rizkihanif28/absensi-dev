<!-- Main Content -->


<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Lokasi WFH</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Lokasi WFH</a></div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-8 col-lg-7">
                    
                <div class="card">

                  <div class="card-body">
										<button class="btn btn-secondary" onclick="getLocation()">Dapatkan Lokasi Saya</button>
                    <h2 class="section-title mb-4">Lokasi WFH Tersimpan</h2>
										<?php if ($this->session->flashdata('success')) { ?>                
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php } ?>
											<?= form_open('lokasi/editlokasi'); ?>
											<div class="form-group row">
												<label class="col-form-label col-lg-3 col-md-4">Latitude</label>
												<div class="col-lg-9 col-md-8">
															<input type="text" name="latitude" id="latitude" class="form-control" value="<?= $user['latitude'];?>" required>
															<?= form_error('latitude', '<small class="text-danger pl-3">', '</small>'); ?>
												</div>
											</div>

												<div class="form-group row">
													<label class="col-form-label col-lg-3 col-md-4">Longitude</label>
													<div class="col-lg-9 col-md-8">
															<input type="text" name="longitude" id="longitude" value="<?= $user['longitude'];?>" class="form-control mb-1" required>
															<?= form_error('longitude', '<small class="text-danger pl-3">', '</small>'); ?>
															<small><a onclick="linkLocation()" href="javascript:void(0)" id="link-maps">Cek Lokasi di Google Maps <i class="fas fa-external-link-alt"></i></a></small>
														</div>
												</div>
		
											<div class="form-group row mt-4">
												<div class="col-lg-10">
													<button type="submit" class="btn btn-primary"> Simpan</button>
												</div>
											</div>
											<?= form_close(); ?>

                </div>     
            </div>
          </div>
        </section>
      </div>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
    let latVal = document.getElementById("latitude");
    let longVal = document.getElementById("longitude");
    let linkMaps = document.getElementById("link-maps");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else { 
        Swal.fire({
          title: "Geolocation tidak didukung oleh browser anda.",
          icon: "error"
        });    
      }
    }

    function showPosition(position) {
      var latlong = position.coords.latitude + "," + position.coords.longitude;
      
      latVal.value = position.coords.latitude;
      longVal.value = position.coords.longitude;
    }

		function linkLocation() {
			if (latVal.value == "" || longVal.value == "") {
				Swal.fire({
          title: "Lokasi Belum Terisi",
          icon: "error",
					html: "Pastikan koordinat latitude dan longitude anda telah terisi, silahkan klik tombol Dapatkan Lokasi Saya"
        });   
			} else {
				window.open(`https://www.google.com/maps/?q=${latVal.value},${longVal.value}`);
			}
		}

    function showError(error) {
      console.log(error);
      switch(error.code) {
        case error.PERMISSION_DENIED:
          Swal.fire({
            title: "Izin akses Geolokasi Mati.",
            html: "Pastikan anda memberikan izin akses lokasi",
            icon: "error"     
          });
          break;
        case error.POSITION_UNAVAILABLE:
          Swal.fire({
            title: "Location information is unavailable.",
            icon: "error"     
          });
          break;
        case error.TIMEOUT:
          Swal.fire({
            title: "The request to get user location timed out.",
            icon: "error"     
          });
          break;
        case error.UNKNOWN_ERROR:
          Swal.fire({
            title: "An unknown error occurred.",
            icon: "error"     
          });
          break;
      }
    }
    </script>
