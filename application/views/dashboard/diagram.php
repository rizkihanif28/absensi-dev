<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        .chartBox {
            width: 1000px;
        }

        .btn {
            margin-top: 30px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
        }
    </style>
</head>

<body>

    <h3><strong>Kategori Pegawai</strong> </h3>

    <select class="form-select" aria-label="Default select example">
        <option selected>Tahun</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>

    <select class="form-select" aria-label="Default select example">
        <option selected>Bulan</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>

    <select class="form-select" aria-label="Default select example">
        <option selected>Tanggal</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>


    <div class="chartBox">
        <canvas id="myChart"></canvas>
    </div>

    <div class="center">
        <button id="dl-png" class="btn btn-primary" onclick="download()">Download</button>
    </div>


    <script src="<?= base_url('assets/modules/boostrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/modules/chart.js/dist/chart.min.js') ?>"></script>

    <script>
        // setup
        const data = {

            labels: [<?php foreach ($unit_kerja as $unker) { ?> "<?= $unker->singkatan ?>",
                <?php } ?>,
            ],
            datasets: [{
                    label: "WFH",
                    data: [<?php foreach ($unit_kerja as $unker) {

                                $this->db->select('p.status');
                                $this->db->join('presensi p', 'p.email = us.email', 'left');
                                $this->db->join('siap_m_pegawai smp', 'us.id = smp.ldap_id', 'left');
                                $this->db->where('p.status', 2);
                                // $this->db->where('p.tanggal');
                                $this->db->where('smp.unit_kerja_id', $unker->id);
                                $jumlahWFH = $this->db->get('user us');
                                echo $jumlahWFH->num_rows();

                            ?>,
                        <?php } ?>

                    ],
                    backgroundColor: "#AFC6FF", //blue
                },
                {
                    label: "WFO",
                    data: [<?php foreach ($unit_kerja as $unker) {

                                $this->db->select('p.status');
                                $this->db->join('presensi p', 'p.email = us.email', 'left');
                                $this->db->join('siap_m_pegawai smp', 'us.id = smp.ldap_id', 'left');
                                $this->db->where('p.status', 1);
                                // $this->db->where('p.tanggal');
                                $this->db->where('smp.unit_kerja_id', $unker->id);
                                $jumlahWFH = $this->db->get('user us');
                                echo $jumlahWFH->num_rows();

                            ?>,
                        <?php } ?>

                    ],
                    backgroundColor: "#FB9333",
                    borderColor: "rgba(255, 159, 64, 1)",
                }
            ]

        };

        // config
        const config = {
            type: 'bar',
            data,
            options: {
                responsive: true,
                scales: {
                    // membuat stack diagaram
                    x: {
                        stacked: true,
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true,
                    },
                },
            },
        };

        // render
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        // membuat fungsi download dari fungsi onClick
        function download() {
            // membuat element a atau seperti anchor tag di html
            const imgStatistic = document.createElement('a');
            // panggil id chart untuk di download
            const chart = document.getElementById('myChart');
            // panggil fungsi download 
            imgStatistic.download = 'statistic.png';
            // panggil href dari anchor tag yang dibuat dengan parameter image, kualiatas image
            imgStatistic.href = chart.toDataURL('image/png', 1);
            // panggil fungsi click
            imgStatistic.click();
        }
    </script>


</body>

</html>