<link href="../library/css/bootstrap.min.css" rel="stylesheet">
<script src="../library/js/jquery.min.js"></script>
<script src="../library/js/bootstrap.min.js"></script>
<script src="../library/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<?php
session_start();
if(!empty($_SESSION['user']))
{
	include_once '../classes/database.php';
	include_once '../classes/kelas.php';
	include_once '../initial.php';

	$kelas = new Kelas($db);

	$msg = '';
	if(!empty($_POST))
	{
		if($kelas->tambah_kelas($_POST))
		{
			$msg = 'kelas berhasil ditambahkan';
			if(!empty(@$_GET['edit']))
			{
				$msg = 'kelas berhasil diubah';
			}
		}else{
			$msg = 'kelas gagal ditambahkan';
		}
	}
	$ubah_kelas = array();
	if(!empty(@$_GET['edit']))
	{
		$ubah_kelas = $kelas->get_kelas($_GET['edit']);
	}

	if(!empty(@$_GET['hapus']))
	{
		if($kelas->del_kelas($_GET['hapus']))
		{
			$msg = 'berhasil hapus kelas';
		}else{
			$msg = 'gagal hapus kelas';
		}
	}
	$data = $kelas->getAll();
	?>
	<div class="container">
		<div class="row">
			<?php include 'menu.php' ?>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<form action="" method="post">
							<div class="panel panel-default">
								<div class="panle panel-heading">
									tambah kelas
								</div>
								<div class="panel panel-body">
									<?php echo $msg ?>
									<br>
									<form action="" method="post">
										<div class="form-group">
											<?php if (!empty($ubah_kelas['id'])): ?>
												<input type="hidden" name="id" value="<?php echo $ubah_kelas['id'] ?>">
											<?php endif ?>
											<input type="text" name="title" class="form-control" placeholder="title" value="<?php echo @$ubah_kelas['title'] ?>">
										</div>
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
								data kelas
							</div>
							<div class="panel panel-body">
								<?php echo @$msg; ?>
								<div class="table-responsive">
									<table id="kelas" class="table table-bordered table-striped">
									  <thead>
									  <tr>
									    <th>ID</th>
									    <th>TITLE</th>
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
														<td><?php echo $value['id'] ?></td>
														<td><?php echo $value['title'] ?></td>
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
		</div>
	</div>

	<script>
	  $(function () {
	    $('#kelas').DataTable();
	  })
	</script>
	<?php
}else{
	header('location: login.php');
}