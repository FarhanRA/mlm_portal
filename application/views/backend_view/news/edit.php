<div class="col-sm-12" id="news_add">
   <ol class="breadcrumb">
      <li><a href="<?php echo base_url('backend/dashboard/index/')?>">Dashboard</a></li>
      <li class="active">News</a></li>
      <li class="active">Edit</li>
      <li style="float:right;"><a href="<?php echo base_url('backend/news/index/')?>">List Data</a></li>
   </ol>
  <div class="grid">
    <div class="panel panel-default">
      <div class="panel-heading black-chrome">Edit Data</div>
      <div class="panel-body">
        <div align="center" class="col-md-12" style="margin-left:25px;">
          <?php if(isset($_SESSION)) {
            echo $this->session->flashdata('flash_data');
          } ?>
        </div>
        <div class="col-md-12">
        <?php foreach ($data_edit as $val) {?>
          <?php echo form_open_multipart('backend/news/edit_news_data'); ?>
          <div class="form-group" style="display:none">
            <label>ID</label>
            <input type="text" name="id" id="id" class="form-control" value="<?php echo $val->id ?>">
          </div>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo $val->title ?>" required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="description" class="form-control ckeditor"><?php echo $val->description ?></textarea> 
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="category" name="category">
              <option value="1" <?php if($val->category == '1'){ echo 'selected'; } ?> >Promo</option>
              <option value="2" <?php if($val->category == '2'){ echo 'selected'; } ?> >Event</option>
              <option value="3" <?php if($val->category == '3'){ echo 'selected'; } ?> >Product</option>
              <option value="4" <?php if($val->category == '4'){ echo 'selected'; } ?> >News</option>
            </select>
          </div>
          <div class="form-group">
            <label>Related video link</label>
            <input type="text" name="link" id="link" class="form-control" value="<?php echo $val->link ?>">
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="userfile" class="form-control" id="userfile">
            <br>
            <?php if ($val->image ==""): ?>
              <img class="show_foto" src= "<?php echo base_url().'assets/images/no_photo.png' ?>" id="div_image_edit">  
            <?php else: ?>
            <img class="show_foto" src= "<?php echo base_url().'assets/images/news/'.$val->image ?>" id="div_image_edit">
            <?php endif ?>
          </div>
          <input type="submit" name="save" value="submit" class="btn btn-success">        
          <a class="btn btn-primary" href="<?php echo base_url('backend/news/index/')?>">Beranda</a>
          <?php echo form_close();?> 
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var base_url= "<?php echo base_url()?>";
  $(document).ready(function()
  {
    load_category();
  });

  function load_category()
  {
    $.ajax({
      type:"GET",
      dataType: 'json',
      "url": base_url+'backend/news/list_data_category',
      datatype:'application/json',
      success:function(success){

        $('select#category').html('');
        for(var i=0;i<success.length;i++)
        {
          $("<option />").val(success[i].id)
          .text(success[i].category)
          .appendTo($('select#category'));
        }

      }
    });

    var getCategory = 
  }
</script>