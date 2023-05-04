<div class="container">
	<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id_content" value="<?php echo (isset($id_content)?$id_content:'');?>">
		<input type="hidden" name="id" value="<?php echo (isset($id)?$id:'');?>">
		<div class="row mt-2">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
				    <li class="breadcrumb-item"><a href="#">มวย</a></li>
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
				<label for="">สถานที่</label>
			</div>
			<div class="col-4">
				<input type="text" class="form-control" name="location" value="<?php echo (isset($detail['location'])?$detail['location']:'');?>">
			</div>
			<div class="col-2">
				<label for="">วันที่แสดง</label>
			</div>
			<div class="col-4">
				<input type="text" class="form-control" name="date_start" value="<?php echo (isset($detail['date_start'])?$detail['date_start']:'');?>">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">รูป</label>
			</div>
			<div class="col-10">
				<input type="file" name="banner">
				<div class="mt-2">
					<?php if(isset($detail['date_start'])){?>
						<img src="../uploads/content/<?php echo $detail['banner'];?>" alt="" style="width:100%;">
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<input type="submit" class="btn btn-primary btn-block">
		</div>
	</form>
</div>
 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
  tinymce.init({
    selector: '#detail',
    plugins: [
      'code','a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
      'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
      'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
    ],
    toolbar: 'code undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
      'alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist checklist outdent indent | removeformat table | a11ycheck help',
    height: 400,
  });
</script>
<style>
.tox-notifications-container {
	display:none;
}
</style>