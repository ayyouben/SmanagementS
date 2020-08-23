<?php
$edit_data = $this->db->get_where('media' , array('media_id' => $param2))->result_array(); 
 ?>

<div class="row">
    <div class="col-md-12">


    <?php foreach($edit_data as $row):?>

        <video width="100%" height="100%" id="video" class="video" controls>
            <source src="uploads/media_files/<?php echo $row['file_name']; ?>" width="100%">
            
        </video>

    <?php endforeach;?>
    
    

    </div>
</div>