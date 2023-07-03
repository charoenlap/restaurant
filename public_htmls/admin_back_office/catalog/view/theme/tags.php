<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo route('tags');?>" method="POST">
                <input type="text" class="form-control" value="" name="tag_name" required>
                <input type="submit" value="เพิ่ม Tag" class="btn btn-primary btn-block">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <th>
                        ชื่อ
                    </th>
                </thead>
                <tbody>
                    <?php foreach($tags as $tag){ ?>
                    <tr data-id="<?php echo $tag['id'];?>">
                        <td><?php echo $tag['tag_name'];?></td>
                        <td class="text-right"><a href="<?php echo route('tags/delete&id='.$tag['id']);?>" class="btn btn-danger">ลบ</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tags <span id="tags_id"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>