<!DOCTYPE html>
<html>
<head>
    <title>TEST LINK PORTAL</title>
    <link href="library/css/bootstrap.min.css" rel="stylesheet">
    <?php
    // include database and object files
    include_once 'classes/database.php';
    include_once 'classes/mapel.php';
    include_once 'classes/kelas.php';
    include_once 'classes/config.php';
    include_once 'initial.php';

    $mapel = new mapel($db);
    $kelas = new kelas($db);
    $conf = new config($db);
    $data_kelas = $kelas->getAll(TRUE);
    $jadwal = $mapel->get_jadwal();
    $config = $conf->get_config('main');
    ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        <img src="http://smkn1bangsri.sch.id/theme/images/logosekolah.png" alt="" height="50"> <?php echo @$config['judul'] ?>
                    </div>
                    <div class="panel panel-body">
                        <?php
                        $time = date('H:i:s');
                        $kosong = TRUE;
                        if(!empty($jadwal))
                        {
                            foreach ($jadwal as $key => $value) 
                            {
                                if(($time >= $value['start']) && ($time <= $value['end']))
                                {
                                    $kosong = FALSE;
                                    ?>
                                    <div class="form-group">
                                        <a class="btn btn-lg" style="width: 100%; background-color: <?php echo $value['color']?>; color: white;" href="<?php echo $value['link'] ?>"><?php echo $data_kelas[$value['kelas_id']] ?></a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        if($kosong){
                            echo '<h1>TIDAK ADA JADWAL UJIAN</h1>';
                        }
                        ?>
                        <a href="" class="btn btn-lg btn-warning" title="">refresh halaman</a>
                    </div>
                    <div class="panel panel-footer">
                        supported by : team RPL
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>