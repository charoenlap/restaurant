<div class="container">
	<div class="row mt-4">
		<div class="col-12">
			<p>มีผู้ที่เข้าชมในขณะนี้ <?php echo count($result);?> คน</p>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-12">
			<table class="table table-striped" id="table_id">
				<thead>
					<th></th>
					<th>Username</th>
					<th>เข้าชมล่าสุด</th>
					<th></th>
				</thead>
				<tbody>
					<?php $i=1;foreach($result as $val){ ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $val['username']; ?></td>
						<td><?php echo $val['last_online']; ?></td>
						<td><a href="#" class="btn btn-kick btn-danger" data-id="<?php echo $val['id']; ?>">เตะ</a></td>
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
	$(document).on('click','.btn-kick',function(e){
		if (confirm("ยืนยันการเตะ!") == true) {
			var tr = $(this).parents('tr');
			var id = $(this).attr('data-id');
		    $.ajax({
				url: 'index.php?route=member/kick',
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