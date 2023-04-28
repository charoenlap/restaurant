<div class="container">
	<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id_content" value="<?php echo (isset($id_content)?$id_content:'');?>">
		<input type="hidden" name="id" value="<?php echo (isset($id)?$id:'');?>">
		<div class="row mt-2">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
				    <li class="breadcrumb-item"><a href="#">เนื้อหา</a></li>
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
				<input type="text" class="form-control" value="<?php echo (isset($detail['title'])?$detail['title']:'');?>" name="title">
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
				<input type="text" class="form-control" value="<?php echo (isset($detail['location'])?$detail['location']:'');?>" name="location">
			</div>
			<div class="col-2">
				<label for="">วันที่แข่ง</label>
			</div>
			<div class="col-4">
				<input type="text" class="form-control" id="datepicker" name="date_start" value="<?php echo (isset($detail['date_start'])?$detail['date_start']:date('Y-m-d'));?>">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">URL Stream</label>
			</div>
			<div class="col-10">
				<input type="text" class="form-control" name="url" value="<?php echo (isset($detail['url'])?$detail['url']:'wss://streaming01.thaisport-stadium.com:3334/sportlive/sport_live01');?>">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">Package</label>
			</div>
			<div class="col-10">
				<select name="id_package" id="id_package" class="form-control" required>
					<option value="">Choose</option>
					<?php 
						foreach($package as $val){ 
							$selected = '';
							if(isset($detail['id_package'])){
								if($detail['id_package']==$val['id']){
									$selected = 'selected';
								}
							}
					?>
					<option value="<?php echo $val['id'];?>" <?php echo $selected;?>>
					<?php echo $val['title'].' - '.$val['price'];?> บาท</option>
				<?php }?>
				</select>
			</div>
		</div>
		<div class="row mt-2">
			<!-- <div class="col-2">
				<label for="">รูป</label>
			</div>
			<div class="col-4">
				<input type="file" name="banner">
				<div class="mt-2">
					<?php if(isset($detail['banner'])){?>
						<img src="../uploads/content/<?php echo $detail['banner'];?>" alt="" style="width:100%;">
					<?php } ?>
				</div>
			</div> -->
			<div class="col-2">
				<label for="">ภาพปก</label>
			</div>
			<div class="col-4">
				<input type="file" name="cover">
				<div class="mt-2">
					<?php if(isset($detail['cover'])){?>
						<img src="../uploads/content/<?php echo $detail['cover'];?>" alt="" style="width:100%;">
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-2">
				<label for="">ภาพย่อย (หลายรูป)</label>
			</div>
			<div class="col-10">
				<input type="file" name="files[]" multiple >
				<div class="mt-2">
					<?php 
						// var_dump($images->rows);
						if(isset($images)){?>
						<?php foreach($images->rows as $val){ ?>
							<img src="../uploads/content_sub/<?php echo $val['image'];?>" alt="" style="height:35px;width:auto;">
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- <div class="row mt-2">
			<div class="col-2">
				<label for="">เพิ่มลงหน้าแรก</label>
			</div>
			<div class="col-10">
				<input type="checkbox" name="chkHome" value="1" checked>
			</div>
		</div> -->
		<div class="row mt-2">
			<div class="col-2">
				<label for="">เมมเบอร์สมัครใหม่ในวัน ดูฟรีไม่เสียค่าใช้จ่าย</label>
			</div>
			<div class="col-10">
				<?php $free = ''; 
					if(isset($detail['free'])){
						$free = $detail['free'];
					}
				?>
				<input type="checkbox" name="free" value="1" <?php echo ($free?'checked':'');?>>
			</div>
		</div>
		
		<div class="row mt-2 mb-4">
			<input type="submit" class="btn btn-primary btn-block">
		</div>
	</form>
</div>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(".select2-title").select2({
	  tags: true
	});
	$( function() {
	    $( "#datepicker" ).datepicker({
	    	"dateFormat":"yy-mm-dd"
	    });
	  } );
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>