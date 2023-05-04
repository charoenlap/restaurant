<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <th>
                        ชื่อ
                    </th>
                </thead>
                <tbody>
                    <?php foreach($menus as $menu){?>
                    <tr data-id="<?php echo $menu['id'];?>" data-image="<?php echo $menu['image'];?>">
                        <td><?php echo $menu['name'];?></td>
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
                <?php foreach($tags as $tag){?>
                    <a href="#" class="btn btn-default btn-tags" data-id="<?php echo $tag['id'];?>" id="tags_id_<?php echo $tag['id'];?>"><?php echo $tag['tag_name'];?></a>
                <?php }?>
                <form id="upload-form" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="form-group">
                        <div id="image-menu"></div>
                        <label for="image-file">Upload Image:</label>
                        <input type="file" class="form-control" id="image-file" name="image-file">
                    </div>
                    <input type="hidden" name="menu_id" value="" id="menu_id_form">
                    <button type="submit" class="btn btn-primary btn-block" id="upload-btn">Upload</button>
                </form>
                <div id="upload-message"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
    var menu_id = 0; 
    $(document).ready(function() {
        $('tr').click(function() {
            $('.btn-tags').removeClass('btn-primary');
            $('.btn-tags').removeClass('btn-default');
            $('.btn-tags').addClass('btn-default');
            
            $('#myModal').modal('show');
            menu_id = $(this).attr('data-id');
            var menu_image = $(this).attr('data-image');
            $('#menu_id_form').val(menu_id);
            $('#tags_id').text(menu_id);
            $('#image-menu').html('<img src="../uploads/'+menu_image+'" height="100px" width="auto">');
            $.ajax({
                url: 'index.php?route=menu/getListTagsMenuID',
                method: 'GET',
                data: { menu_id: menu_id },
                success: function(response) {
                    console.log(response);
                    $.each(response, function(index, value) {
                        $('#tags_id_'+value.tags_id).removeClass('btn-default');
                        $('#tags_id_'+value.tags_id).addClass('btn-primary');
                    })
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    console.log(error);
                }
            });
        });
    });
    $(document).on('click','.btn-tags',function(e){
        var ele = $(this);
        var tags_id = $(this).attr('data-id');
        var menu_id = parseInt($('#tags_id').text());
        if(!$(this).hasClass('btn-primary')){ 
            $.ajax({
                url: 'index.php?route=menu/addTagsMenu',
                method: 'GET',
                data: { 
                    menu_id: menu_id,
                    tags_id: tags_id,
                },
                success: function(response) {
                    console.log(response);
                    ele.removeClass('btn-default');
                    ele.addClass('btn-primary');
                    
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    console.log(xhr, status, error);
                }
            });
        }else{
            // console.log('tags_id',tags_id);
            $.ajax({
                url: 'index.php?route=menu/removeTagsMenu',
                method: 'GET',
                data: { 
                    menu_id: menu_id,
                    tags_id: tags_id
                },
                success: function(response) {
                    console.log(response);
                    ele.removeClass('btn-primary');
                    ele.addClass('btn-default');
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    console.log(xhr, status, error);
                }
            });
        }
        
    });
    $(document).ready(function() {
        $('#upload-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'index.php?route=menu/uploadImage',
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    $('#upload-message').html(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>