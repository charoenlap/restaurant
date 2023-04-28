<div class="container">
  <form action="<?php echo $action;?>" method="get">
    <div class="card mt-2">
      <div class="card-header">
        ค้นหา
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2">
            <label for="">ปี</label>
            <select name="year" id="year" class="form-control">
              <?php //for(date('Y');$i<=date('Y');$i++){?>
              <option value="<?php echo date('Y');?>" <?php echo (date('Y')==$year?'selected':'')?>><?php echo date('Y');?></option>
              <?php //} ?>
            </select>
          </div>
          <div class="col-2">
            <label for="">เดือน</label>
            <select name="month" id="month" class="form-control">
              <option value="">ทุกเดือน</option>
              <?php for($i=1;$i<=12;$i++){?>
                <option value="<?php echo $i;?>" <?php echo ($i==$month?'selected':'')?>><?php echo $i;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-2">
            <label for="">วัน</label>
            <select name="day" id="day" class="form-control">
              <option value="">ทุกวัน</option>
              <?php for($i=1;$i<=31;$i++){?>
                <option value="<?php echo $i;?>" <?php echo ($i==$day?'selected':'')?>><?php echo $i;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-1">
            <input type="submit" class="btn btn-primary">
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php // echo "<pre>";var_dump($result);?>
  <div class="row mt-2">
    <div class="col-12">
      <table class="table table-striped" id="table_id">
      		<thead>
      			<th>ชื่อผู้เติม</th>
      			<th>ราคา</th>
      			<th>รหัสในระบบ</th>
            <th>ศึก</th>
      			<th>วันที่เติม</th>
      		</thead>
      		<tbody>
      		<?php $sum=0; foreach($result as $val){ $sum+=$val['amount'];?>
	      		<tr>
	      			<td><?php echo $val['payerName'];?></td>
	      			<td><?php echo $val['amount'];?></td>
              <td><?php echo $val['username'];?></td>
	      			<td><?php echo $val['title'];?></td>
	      			<td><?php echo $val['create_date'];?></td>
	      		</tr>
	      	<?php } ?>
      	</tbody>
      </table>
      <p>ยอดรวมทั้งหมด <?php echo number_format($sum);?> บาท</p>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-6">
      <!-- <div id="curve_chart" style="width: 100%; height: 500px"></div> -->
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
        "pageLength": 50,
        order: [[4, 'desc']],
    } );
} );
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(
          // ['Month', 'Sales'],
          <?php echo $resultGraph; ?>
        );

        var options = {
          title: 'Sales <?php echo date('Y');?>',
          // curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>