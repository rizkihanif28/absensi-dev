<!-- Main Content -->


<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Presensi Kehadiran</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item"><a href="#">Presensi</a></div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">Presensi Kehadiran BSN</h2>
			<p class="section-lead">Pilih status bekerja anda terlebih dahulu, lalu klik tombol hadir. </p>

			<div class="row">
				<div class="col-12 col-md-6 col-lg-6">

					<div class="card">

						<div class="card-header">
							<h4>Waktu Server : <div id="clock-w-step-cb"></div> <?php echo $tanggal ?></h4>
						</div>

						<div class="card-body">
							<?= form_open('absen/save', ['id' => 'frm-absen']) ?>
							<!-- <div class="form-group"> -->
							<!-- <div id="embedMap"></div>										 -->
							<input type="hidden" name="lat" id="lat">
							<input type="hidden" name="long" id="long">
							<input type="hidden" name="status_wfh" id="status_wfh" value="-">
							<!-- </div> -->
							<div class="form-group">
								<label class="form-label">Status Bekerja</label>
								<div class="row gutters-sm">

									<?php if ($stat_abs == "v") { ?>
										<div class="col-8 col-sm-6">
											<label class="imagecheck mb-4">
												<input name="status_kerja" type="radio" value="1" class="imagecheck-input" checked=checked />
												<figure class="imagecheck-figure">
													<img src="../assets/img/news/WFO.png" alt="}" class="imagecheck-image">
												</figure>
											</label>
										</div>
										<div class="col-8 col-sm-6">
											<label class="imagecheck mb-4">
												<input name="status_kerja" type="radio" value="2" class="imagecheck-input" disabled=disabled />
												<figure class="imagecheck-figure">
													<img src="../assets/img/news/WFH.png" alt="}" class="imagecheck-image">
												</figure>
											</label>
										</div>
									<?php } else { ?>
										<div class="col-8 col-sm-6">
											<label class="imagecheck mb-4">
												<input name="status_kerja" type="radio" value="1" class="imagecheck-input" disabled=disabled />
												<figure class="imagecheck-figure">
													<img src="../assets/img/news/WFO.png" alt="}" class="imagecheck-image">
												</figure>
											</label>
										</div>
										<div class="col-8 col-sm-6">
											<label class="imagecheck mb-4">
												<input name="status_kerja" type="radio" value="2" class="imagecheck-input" checked=checked />
												<figure class="imagecheck-figure">
													<img src="../assets/img/news/WFH.png" alt="}" class="imagecheck-image">
												</figure>
											</label>
										</div>
									<?php } ?>

								</div>

							</div>
							<div class="form-group">
								<label class="form-label">Kondisi Kesehatan</label>
								<div class="custom-switches-stacked mt-2">
									<?php foreach ($l_kondisi as $kon) : ?>
										<label class="custom-switch">
											<input type="radio" name="kondisi[]" id="kondisi" <?= $kon['id'] == 1 ? 'checked' : '' ?> value="<?= $kon['id'] ?>" class="custom-switch-input">
											<span class="custom-switch-indicator"></span>
											<span class="custom-switch-description"><?= $kon['kondisi'] ?></span>
										</label>
									<?php endforeach; ?>
								</div>
							</div>
							<div id="cek-sakit" class="form-group" style="display:none;">
								<label class="form-label">Keluhan</label>
								<div class="custom-switches-stacked mt-2">
									<?php $no = 1;
									foreach ($l_sakit as $kon) : ?>
										<div class="form-check">
											<input type="checkbox" name="keluhan[]" id="keluhan<?= $no; ?>" value="<?= $kon['id'] ?>" class="keluhan form-check-input">
											<label class="form-check-label" for="keluhan<?= $no; ?>"><?= $kon['keluhan'] ?></label>
										</div>
									<?php $no++;
									endforeach; ?>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
									<i class="fas fa-fingerprint"></i>Hadir
								</button>
							</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
	</section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/time/jquery.time-to.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
	/**
	 * Set timer countdown in seconds with callback
	 */
	$('#countdown-1').timeTo(120, function() {
		alert('Countdown finished');
	});
	$('#reset-1').click(function() {
		$('#countdown-1').timeTo('reset');
	});

	/**
	 * Hide hours
	 */
	$('#countdown-11').timeTo({
		seconds: 100,
		displayHours: false
	});

	$('#clock-w-step-cb').timeTo({
		step: function() {
			console.log('Executing every 3 ticks');
		},
		stepCount: 3
	});

	var date = getRelativeDate(2);

	// document.getElementById('date-str').innerHTML = date.toISOString();

	/**
	 * Set timer countdown to specyfied date
	 */
	$('#countdown-2').timeTo(date);

	var time = '23:59:54';
	// document.getElementById('date2-str').innerHTML = time;

	/**
	 * Set theme and captions
	 */
	$('#countdown-3').timeTo({
		time: time,
		displayDays: 2,
		theme: "black",
		displayCaptions: true,
		fontSize: 48,
		captionSize: 14,
		lang: 'es'
	});

	/**
	 * Simple digital clock
	 */
	$('#clock-1').timeTo();

	function getRelativeDate(days, hours, minutes) {
		var d = new Date(Date.now() + 60000 /* milisec */ * 60 /* minutes */ * 24 /* hours */ * days /* days */ );

		d.setHours(hours || 0);
		d.setMinutes(minutes || 0);
		d.setSeconds(0);

		return d;
	}
</script>
<script>
	$(document).ready(function() {
		$('[name="kondisi[]"]').change(function() {
			var value = $('[name="kondisi[]"]:checked').val();
			if (value == 2) { // check if the radio is checked
				$('#cek-sakit').show()
			} else {
				$('#cek-sakit').hide()
			}
		});
	});

	var statusKerja = $('[name="status_kerja"]:checked').val();

	$('#frm-absen').submit(function(e) {
		e.preventDefault();
		var cek_kondisi = $('[name="kondisi[]"]:checked');
		var cek_keluhan = $('[name="keluhan[]"]:checked');
		var lati = $('#lat').val();
		var longi = $('#long').val();

		Swal.fire({
			icon: 'question',
			title: 'Isi Kehadiran',
			text: "Apakah semua data telah terisi dengan benar ?",
			showCloseButton: true,
			showCancelButton: true
		}).then((result) => {
			console.log(result);
			if (result.value) {
				// cek status kerja wfh
				if (cek_kondisi.val() == 2 && cek_keluhan.length < 1) {
					Swal.fire({
						icon: 'error',
						title: 'Keluhan Wajib Terisi',
						showCloseButton: true,
					})
				} else if (statusKerja == 2) {
					<?php if ($latitude == "" || $longitude == "") : ?>
						// cek database lat long
						Swal.fire({
							title: "Data Lokasi Belum Terisi",
							html: "Silahkan isi terlebih dahulu data lokasi anda di menu Lokasi WFH",
							icon: 'error',
							showCloseButton: true,
							showConfirmButton: true,
							confirmButtonText: "Isi Data Lokasi"
						}).then((result) => {
							if (result.value) window.location = "<?= base_url('lokasi') ?>";
						});
					<?php else : ?>
						if (lati == "" || longi == "") {
							Swal.fire({
								icon: 'error',
								title: "Izin akses Geolokasi Mati.",
								html: "Pastikan anda memberikan izin akses lokasi",
								showCloseButton: true,
							});
						} else {
							var myLoc = {
								lat: lati,
								lng: longi
							};
							var registeredLoc = {
								lat: <?= $latitude ?>,
								lng: <?= $longitude ?>
							};

							var cekZone = arePointsNear(myLoc, registeredLoc, 4);

							if (cekZone == false) {
								// Swal.fire({
								// 	icon: 'error',
								// 	title: "Anda Berada Diluar Zona WFH",
								// 	html: "Pastikan anda melakukan presensi didalam radius 3KM dari lokasi WFH anda",
								// 	showCloseButton: true,
								// });
								$('#status_wfh').val('Diluar Zona');
								action();
							} else {
								$('#status_wfh').val('Didalam Zona');
								action();
							}
						}
					<?php endif; ?>
				} else {
					action();
				}

				// $("form :input").appendTo("#frm-absen");
				// $("#frm-absen").submit();
			}
		})
	});

	function action() {
		save($('#frm-absen').serialize(), "<?= base_url('absen/save') ?>")
			.then(function(response) {
				if (response.success == "timeValidation") {
					Swal.fire({
						title: response.title,
						html: response.message,
						icon: 'error',
						showCloseButton: true,
						showConfirmButton: false,
					});
				}
				if (response.success) {
					Swal.fire({
						icon: 'success',
						title: response.title,
						showConfirmButton: false,
						timer: 2000
					}).then(function() {
						window.location = "<?= base_url('profile') ?>";
					})
				} else {
					Swal.fire({
						title: response.title,
						html: response.message,
						icon: 'error',
						showCloseButton: true,
						showConfirmButton: true,
						confirmButtonText: "Isi Data Lokasi"
					}).then((result) => {
						if (result.value) window.location = "<?= base_url('lokasi') ?>";
					});
				}
			})
			.catch(function(err) {
				console.log(err)
			})
	}

	// save function
	function save(string, action) {
		return new Promise(function(resolve, reject) {
			$.ajax({
				url: action,
				type: 'POST',
				data: string,
				dataType: 'JSON',
				// processData: false,
				// contentType: false,
				// cache: false,
				// async: false,
			}).done(function(res) {
				resolve(res)
			}).fail(function() {
				reject('Gagal Simpan!')
			})
		})
	}
</script>

<script>
	if (statusKerja == 2) getLocation();
	let latVal = document.getElementById("lat");
	let longVal = document.getElementById("long");

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

		// Set Google map source url
		// var mapLink = "https://maps.googleapis.com/maps/api/staticmap?center="+latlong+"&zoom=16&size=400x300&output=embed";
		// Create and insert Google map
		// document.getElementById("embedMap").innerHTML = "<img alt='Map Holder' src='"+ mapLink +"'>";

		latVal.value = position.coords.latitude;
		longVal.value = position.coords.longitude;
	}

	function showError(error) {
		console.log(error);
		switch (error.code) {
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

	function arePointsNear(checkPoint, centerPoint, km) {
		var ky = 40000 / 360;
		var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
		var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
		var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
		return Math.sqrt(dx * dx + dy * dy) <= km;
	}
</script>