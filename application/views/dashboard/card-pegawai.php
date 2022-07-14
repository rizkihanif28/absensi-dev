<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Statistic Harian Pegawai</h1>
            <div class="section-header-breadcrumb">
                <!-- <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Presensi</a></div> -->
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class=" card-wrap">
                                <div class="card-header">
                                    <h4>Semua Pegawai</h4>
                                </div>
                                <div class="card-body" style="line-height: 35px;">
                                    <?php echo $jumlahPegawai ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-calendar-minus"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pegawai Cuti</h4>
                                </div>
                                <div class="card-body" style="line-height: 50px" ;>
                                    //
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-building" style="line-height: 50px;"></i>
                            </div>
                            <div class=" card-wrap">
                                <div class="card-header">
                                    <h4>Pegawai WFO</h4>
                                </div>
                                <div class="card-body" style="line-height: 50px;">
                                    <?php echo $status_WFO ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pegawai WFH</h4>
                                </div>
                                <div class="card-body" style="line-height: 50px">
                                    <?php echo $status_WFH ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>