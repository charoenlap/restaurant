<div class="container">
	<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id_content" value="<?php echo (isset($id_content)?$id_content:'');?>">
		<input type="hidden" name="id" value="<?php echo (isset($id)?$id:'');?>">
		<div class="row mt-2">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
				    <li class="breadcrumb-item"><a href="#">ตัววิ่ง</a></li>
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
		<!-- <div class="row mt-2">
			<div class="col-2">
				<label for="">รูป</label>
			</div>
			<div class="col-10">
				<input type="file" name="cover">
				<div class="mt-2">
					<?php if(isset($detail['cover'])){?>
						<img src="../uploads/content/<?php echo $detail['cover'];?>" alt="" style="width:100%;">
					<?php } ?>
				</div>
			</div>
		</div> -->
		<!--<div class="row mt-2">
			<div class="col-2">
				<label for="">รูปปก</label>
			</div>
			<div class="col-10">
				<input type="file" name="banner">
				<div class="mt-2">
					<?php if(isset($detail['banner'])){?>
						<img src="../uploads/content/<?php echo $detail['banner'];?>" alt="" style="width:100%;">
					<?php } ?>
				</div>
			</div>
		</div>
		-->
		<div class="row mt-2 mb-4">
			<input type="submit" class="btn btn-primary btn-block">
		</div>
	</form>
</div>