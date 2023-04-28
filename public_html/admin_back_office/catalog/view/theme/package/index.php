<div class="container">
	<div class="row mt-2 mb-2">
		<div class="col-12 text-right">
			<a href="<?php echo route('package/add&id_content='.$id_content);?>" class="btn btn-primary">เพิ่ม</a>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-12">
			<table class="table table-striped">
				<thead>
					<th width="30px;">ลำดับ</th>
					<th>ชื่อเรื่อง</th>
					<th>ราคา</th>
					<th width="140px;">จัดการ</th>
				</thead>
				<tbody>
					<?php $i=1;foreach($result as $val){ ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $val['title']; ?></td>
						<td><?php echo $val['price']; ?></td>
						<td>
							<a href="<?php echo route('package/edit&id='.$val['id']);?>" class="btn btn-warning">แก้ไข</a>
							<a href="#" data-id="<?php echo $val['id'];?>" class="btn btn-danger btn-del">ลบ</a>
						</td>
					</tr>
					<?php $i++;} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).on('click','.btn-del',function(e){
		if (confirm("ยืนยันการลบ!") == true) {
			var tr = $(this).parents('tr');
			var id = $(this).attr('data-id');
		    $.ajax({
				url: 'index.php?route=package/del',
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