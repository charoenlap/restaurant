<div class="container">
	<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo (isset($id)?$id:'');?>">
		<div class="row mt-2">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
				    <li class="breadcrumb-item"><a href="#">สมาชิก</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><?php echo (isset($detail['username'])?$detail['username']:'');?></li>
				  </ol>
				</nav>
			</div>	
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">Username</label>
			</div>
			<div class="col-10">
				<input type="text" class="form-control" name="username" value="<?php echo (isset($detail['username'])?$detail['username']:'');?>">
			</div>
		</div>
		<div class="row mt-4 mb-4">
			<div class="col-2">
				Enable Agency
			</div>
			<div class="col-10">
				<?php $agency = (isset($detail['agency'])?$detail['agency']:'');?>
				<input type="radio" name="agency" value="1" <?php echo (!empty($agency)?'checked':'');?>> On
				<input type="radio" name="agency" value="0" <?php echo (empty($agency)?'checked':'');?>> Off
			</div>
		</div>
		<div class="row mt-4 mb-4">
			<div class="col-2">
				Agency
			</div>
			<div class="col-10">
				<?php $link = "http://thaisport-stadium.com/index.php?route=member/register&ref=".encode((isset($detail['username'])?$detail['username']:''),'lap');?>
				<input type="text" class="form-control" value="<?php echo $link;?>">
			</div>
		</div>
		<?php if($agency_list){?>
		<div class="row mt-4 mb-4">
			<div class="col-2">
				List Agency
			</div>
			<div class="col-10">
				<table class="table" id="table_id">
				<thead>
					<th>Agency</th>
					<th>Username</th>
				</thead>
				<tbody>
					<?php foreach($agency_list as $val){?>
					<tr>
						<td><?php echo (isset($detail['username'])?$detail['username']:'');?></td>
						<td><?php echo $val['username'];?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php } ?>
		<div class="row mt-2 mb-4">
			<input type="submit" class="btn btn-primary btn-block">
		</div>
	</form>
</div>
	<div class="container ">
		<div class="row">
			<div class="col-3">
				<label for="">แพคเกจ</label>
				<select name="" id="id_package" class="form-control">
					<option value="2">รายครั้ง</option>
				</select>
			</div>
			<div class="col-4">
				<label for="">เนื้อหา</label>
				<select name="" id="id_content" class="form-control">
					
					<option value="">เลือกเนื้อเฉพาะแบบรายครั้ง</option>
					<?php foreach($banners as $banner){ ?>
					<option value="<?php echo $banner['id']; ?>"><?php echo $banner['title']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-2">
				<label for="">วันที่สร้าง</label>
				<input type="text" class="form-control" id="date_create" value="<?php echo date('Y-m-d H:i:s');?>">
			</div>
			<div class="col-2">
				<label for="">วันที่หมดอายุ</label>
				<?php 
					$stop_date = date('Y-m-d H:i:s');
					$stop_date = date('Y-m-d H:i:s', strtotime($stop_date . ' +1 day'));
				?>
				<input type="text" class="form-control" id="date_expired" value="<?php echo $stop_date;?>">
			</div>
			<div class="col-1">
				<input type="button" class="btn btn-primary" id="add-package" value="เพิ่ม">
			</div>
		</div>
	<?php 
		// echo $sql = "SELECT * FROM gs_member_history LEFT JOIN gs_package ON gs_member_history.id_package = gs_package.id WHERE id_user = '".(int)$id."' AND date_expired >= '".date('Y-m-d H:i:s')."'";
	?>
	<div class="row">
		<div class="col-12">
			<table class="table">
				<thead>
					<th>ชื่อแพคเกจ</th>
					<th>เนื้อหา</th>
					<th>วันที่สร้าง</th>
					<th>วันหมดอายุ</th>
					<th></th>
				</thead>
				<tbody>
					<?php foreach($package as $val){ ?>
					<tr>
						<td>
							<?php echo $val['package_title'];?>
						</td>
						<td>
							<?php echo $val['id_content'];?> <?php echo $val['content_title'];?>
						</td>
						<td>
							<?php echo $val['date_create'];?>
						</td>
						<td>
							<?php echo $val['date_expired'];?>
						</td>
						<td>
							<a href="#" class="btn-del-package-member btn btn-danger btn-xs" data-id="<?php echo $val['id'];?>">ลบ</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
.tox-notifications-container {
	display:none;
}
</style>
<script>
	$(document).on('click','#add-package',function(e){
		$.ajax({
			url: 'index.php?route=member/addPackageMember',
			type: 'GET',
			dataType: 'json',
			data: {
				id_user:'<?php echo (isset($id)?$id:'');?>',
				id_package:$('#id_package').val(),
				id_content:$('#id_content').val(),
				date_create:$('#date_create').val(),
				date_expired:$('#date_expired').val(),
			},
		})
		.done(function(a,b,c) {
			console.log(a,b,c);
			console.log("success");
			window.location = 'index.php?route=member/edit&id=<?php echo (isset($id)?$id:'');?>';
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(document).on('click','.btn-del-package-member',function(e){
		var ele = $(this);
		$.ajax({
			url: 'index.php?route=member/deleteMemberPackage',
			type: 'GET',
			dataType: 'json',
			data: {
				id:$(ele).attr('data-id'),
			},
		})
		.done(function() {
			console.log("success");
			window.location = 'index.php?route=member/edit&id=<?php echo (isset($id)?$id:'');?>';
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
</script>	

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
	$(document).ready( function () {
		$('#table_id').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"pageLength": 50
		} );
	} );
</script>