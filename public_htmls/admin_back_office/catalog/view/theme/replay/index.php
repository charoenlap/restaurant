<div class="container">
	<div class="row mt-2 mb-2">
		<div class="col-12 text-right">
			<a href="<?php echo route('news/add');?>" class="btn btn-primary">เพิ่ม</a>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-12">
			<table class="table table-striped" id="table_id">
				<thead>
					<th width="30px;"></th>
					<th width="50px;">ภาพ</th>
					<th class="text-center">ชื่อเรื่อง</th>
					<th>สร้างเมื่อ</th>
					<th width="150px;">จัดการ</th>
				</thead>
				<tbody>
					<?php $i=1;foreach($result as $val){ ?>
					<tr>
						<td><?php echo $i;?></td>
						<td>
							<?php if($val['cover']){ ?><img src="../uploads/content/<?php echo $val['cover']; ?>" alt="" style="height:50px;">
							<?php }
								 ?>
						</td>
						<td><?php echo $val['title']; ?></td>
						<td><?php echo $val['date_create']; ?></td>
						<td>
							<a href="<?php echo route('replay/edit&id='.$val['id']);?>" class="btn btn-warning">แก้ไข</a>
							<a href="#" data-id="<?php echo $val['id'];?>" class="btn btn-danger btn-del">ลบ</a>
						</td>
					</tr>
					<?php $i++;} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
	$(document).on('click','.btn-del',function(e){
		if (confirm("ยืนยันการลบ!") == true) {
			var tr = $(this).parents('tr');
			var id = $(this).attr('data-id');
		    $.ajax({
				url: 'index.php?route=news/del',
				type: 'GET',
				dataType: 'json',
				data: {
					id: id
				},
			})
			.done(function() {
				console.log("success");
				tr.remove();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			e.preventDefault();
		}
	});
</script>