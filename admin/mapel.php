<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Atur Jadwal Mapel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../library/css/bootstrap.min.css" rel="stylesheet">
	<script src="../library/js/jquery.min.js"></script>
	<script src="../library/js/bootstrap.min.js"></script>
	<script src="../library/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../library/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
	<?php
	if(!empty($_SESSION['user']))
	{
		include_once '../classes/database.php';
		include_once '../classes/mapel.php';
		include_once '../classes/config.php';
		include_once '../classes/kelas.php';
		include_once '../initial.php';

		$mapel = new mapel($db);
		$kelas = new kelas($db);
		$config = new config($db);
		$data_kelas = $kelas->getAll(TRUE);
		$msg = '';
		$data_config = $config->get_config('main');
		if(!empty($_POST))
		{
			if($mapel->tambah_mapel($_POST))
			{
				$msg = 'mapel berhasil ditambahkan';
				if(!empty(@$_GET['edit']))
				{
					$msg = 'mapel berhasil diubah';
				}
			}else{
				$msg = 'mapel gagal ditambahkan';
			}
		}
		$ubah_mapel = array();
		if(!empty(@$_GET['edit']))
		{
			$ubah_mapel = $mapel->get_mapel($_GET['edit']);
		}

		if(!empty(@$_GET['hapus']))
		{
			if($mapel->del_mapel($_GET['hapus']))
			{
				$msg = 'berhasil hapus mapel';
			}else{
				$msg = 'gagal hapus mapel';
			}
		}
		$tgl = '';
		if (!empty($_GET['tgl'])) {
			$tgl = $_GET['tgl'];
		}
		$data = $mapel->getAll($data_config, $tgl);
		?>
		<div class="container">
			<div class="row">
				<?php include 'menu.php';
				if(!empty($data_config['kegiatan_id']))
				{
					 ?>
					<div class="col-md-12">
						<div class="row">
							<div class="row">
								<div class="col-md-6">
									<div class="panel">
										<div class="panel-body">
											<form action="" method="get">
												<div class="form-group form-inline">
													<input type="date" name="tgl" class="form-control" value="<?php echo $tgl ?>">
													<input type="submit" value="Filter" class="btn btn-default btn-sm">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<form action="" method="post">
									<div class="panel panel-default">
										<div class="panle panel-heading">
											tambah mapel
										</div>
										<div class="panel panel-body">
											<?php echo $msg ?>
											<br>
											<form action="" method="post">
												<div class="form-group">
													<?php if (!empty($ubah_mapel['id'])): ?>
														<input type="hidden" name="id" value="<?php echo $ubah_mapel['id'] ?>">
													<?php endif ?>
													<input type="text" name="title" class="form-control" placeholder="nama mapel" value="<?php echo @$ubah_mapel['title'] ?>">
												</div>
												<div class="form-group">
													<select class="form-control" name="kelas_id">
														<?php foreach ($data_kelas as $key => $value): ?>
															<?php $selected = ($key==$ubah_mapel['kelas_id']) ? 'selected' : ''; ?>
															<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group">
													<input type="text" name="kode" class="form-control" placeholder="kode mapel" value="<?php echo @$ubah_mapel['kode'] ?>">
												</div>
												<div class="form-group">
													<label for="">Warna</label>
													input
													<input type="color" name="color" class="form-control" placeholder="warna" value="<?php echo @$ubah_mapel['color'] ?>">
												</div>
												<div class="form-group">
													<input type="text" name="link" class="form-control" placeholder="link" value="<?php echo @$ubah_mapel['link'] ?>">
												</div>
												<div class="form-group">
													<label for="tanggal">tanggal</label>
													<input type="date" name="date" class="form-control" placeholder="tanggal" value="<?php echo @$ubah_mapel['date'] ?>">
												</div>
												<div class="form-group">
													<label for="">waktu mulai</label>
													<input type="time" name="start" class="form-control" placeholder="waktu mulai" value="<?php echo @$ubah_mapel['start'] ?>">
												</div>
												<div class="form-group">
													<label for="">waktu habis</label>
													<input type="time" name="end" class="form-control" placeholder="waktu habis" value="<?php echo @$ubah_mapel['end'] ?>">
												</div>
												<div class="form-group">
													<select name="status" class="form-control">
														<option value="1">Aktif</option>
														<option value="0">Tidak Aktif</option>
													</select>
												</div>
												<input type="hidden" name="kegiatan_id" value="<?php echo $data_config['kegiatan_id'] ?>">
												<div class="form-group">
													<button class="btn btn-sm btn-success">simpan</button>
												</div>
											</form>
										</div>
									</div>
								</form>
							</div>

							<div class="col-md-8">
								<div class="panel panel-default">
									<div class="panel panel-heading">
										data mapel
									</div>
									<div class="panel panel-body">
										<?php echo @$msg; ?>
										<div class="table-responsive">
											<table id="mapel" class="table table-bordered table-striped">
											<thead>
											<tr>
												<th>TITLE</th>
												<th>kode</th>
												<th>link</th>
												<th>kelas</th>
												<th>tanggal</th>
												<th>mulai</th>
												<th>selesai</th>
												<th>action</th>
											</tr>
											</thead>
											<tbody>
													<?php 
													if(!empty($data))
													{
														foreach ($data as $key => $value) 
														{
															?>
															<tr>
																<td><?php echo $value['title'] ?></td>
																<td><?php echo $value['kode'] ?></td>
																<td><a href="<?php echo $value['link'] ?>"><?php echo $value['link'] ?></a></td>
																<td><?php echo $data_kelas[$value['kelas_id']] ?></td>
																<td><?php echo $value['date'] ?></td>
																<td><?php echo $value['start'] ?></td>
																<td><?php echo $value['end'] ?></td>
																<td><a href="?hapus=<?php echo $value['id']?>" title="">hapus</a> | <a href="?edit=<?php echo $value['id']?>" title="">Ubah</a></td>
															</tr>
															<?php		
														} 
													}
													?>
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}else{
					msg('konfig kegiatan belum di atur','danger');
				}
				?>
			</div>
		</div>

		<script>
		$(function () {
			$('#mapel').DataTable();
		})
		</script>
		<?php
	}else{
		header('location: login.php');
	}?>
</body>
</html>