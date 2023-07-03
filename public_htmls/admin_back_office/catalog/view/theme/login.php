<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-3">
			<div class="card mt-4">
				<div class="card-header">
					<!-- <label for="">เข้าสู่ระบบ</label> -->
					<img src="../uploads/gosportlogo.png" alt="" class="w-100">
				</div>
				<div class="card-body">
					<?php if($result){?>
						<p class="alert alert-danger"><?php echo $result; ?></p>
					<?php } ?>
					<form action="<?php echo $action;?>" method="POST">
						<label for="">ชื่อผู้ใช้</label>
						<input type="text" class="form-control" name="username">
						<label for="">รหัสผ่าน</label>
						<input type="password" class="form-control" name="password">
						<input type="submit" class="btn btn-primary mt-2 btn-block" value="เข้าสู่ระบบ">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>