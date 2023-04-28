<div class="container">
	<div class="row mt-2 mb-2">
		<div class="col-12 text-right">
			<a href="<?php echo route('member/add&id_content='.$id_content);?>" class="btn btn-primary">เพิ่ม</a>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-12">
			<table class="table table-striped" id="table_id">
				<thead>
					<th></th>
					<th>Username</th>
					<th>วันที่เริ่ม</th>
					<th>สถานะ</th>
					<th class="text-right">จัดการ</th>
				</thead>
				<tbody>
					<?php $i=1;foreach($result as $val){ ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $val['username']; ?></td>
						<td><?php echo $val['date_create']; ?></td>
						<td><?php echo ($val['agency']?'Agency':'Normal'); ?></td>
						<td class="text-right">
							<a href="#" data-id="<?php echo $val['id'];?>" class="btn btn-info btn-reset">รีเซตรหัสผ่าน</a>
							<a href="<?php echo route('member/edit&id='.$val['id']);?>" class="btn btn-warning">แก้ไข</a>
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
<script>
	$(document).on('click','.btn-del',function(e){
		if (confirm("ยืนยันการลบ!") == true) {
			var tr = $(this).parents('tr');
			var id = $(this).attr('data-id');
		    $.ajax({
				url: 'index.php?route=member/del',
				type: 'GET',
				dataType: 'json',
				data: {
					id: id
				},
			})
			.done(function() {
				console.log("success");
				tr.remove();
				window.location='index.php?route=member';
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
	$(document).on('click','.btn-reset',function(e){
		if (confirm("ยืนยันการเปลี่ยนรหัสผ่าน!") == true) {
			var tr = $(this).parents('tr');
			var id = $(this).attr('data-id');
		    $.ajax({
				url: 'index.php?route=member/reset',
				type: 'GET',
				dataType: 'json',
				data: {
					id: id
				},
			})
			.done(function(data) {
				alert('ระบบได้รีเซตรหัสผ่านเป็น'+data.password);
			})
			.fail(function(a,b,c) {
				console.log(a);
				console.log(b);
				console.log(c);
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			e.preventDefault();
		}
	});
</script>