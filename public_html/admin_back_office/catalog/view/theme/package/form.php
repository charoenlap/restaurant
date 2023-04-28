<div class="container">
	<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo (isset($id)?$id:'');?>">
		<div class="row mt-2">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
				    <li class="breadcrumb-item"><a href="#">แพคเกจ</a></li>
				    <li class="breadcrumb-item active" aria-current="page"><?php echo $title;?></li>
				  </ol>
				</nav>
			</div>	
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">หัวข้อ</label>
			</div>
			<div class="col-10">
				<input type="text" class="form-control" name="title" value="<?php echo (isset($detail['title'])?$detail['title']:'');?>">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">รายละเอียด</label>
			</div>
			<div class="col-10">
				<textarea class="form-control" name="detail" id="detail"><?php echo (isset($detail['detail'])?$detail['detail']:'');?></textarea>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">ราคา</label>
			</div>
			<div class="col-10">
				<input type="text" class="form-control" name="price" id="price" value="<?php echo (isset($detail['price'])?$detail['price']:'');?>">
			</div>
		</div>
		<div class="row mt-2 mb-4">
			<input type="submit" class="btn btn-primary btn-block">
		</div>
	</form>
</div>