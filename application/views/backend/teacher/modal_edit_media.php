
<?php

$edit_data=$this->db->get_where('media',array('media_id'=>$param2))->result_array();

?>

<div class="row">
    <div class="col-md-12">
    
     <?php foreach($edit_data as $row):?> 
    <?php echo form_open(base_url() . 'index.php?teacher/media/'.$param3."//edit/".$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top',
                    'enctype'=>'multipart/form-data'));?>
                         
                                <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('classe');?></label>
                                <div class="col-md-5">
                                <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php 
                                        $classes = $this->db->get_where('class', array('teacher_id'=>$row['teacher_id']))->result_array();
                                        foreach($classes as $rows):
                                            ?>
                                            <option value="<?php echo $rows['class_id'];?>" <?php if($rows['class_id']==$row['class_id']){echo 'selected';}?>>
                                                    <?php echo $rows['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                    ?>
                                </select>
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Matière');?></label>
                                <div class="col-md-5">
                                <select name="subject_id" class="form-control" data-validate="required" id="subject_id" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="selectSubject();">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php 
                                        $classes = $this->db->get('subject')->result_array();
                                        foreach($classes as $rows):
                                            ?>
                                            <option value="<?php echo $rows['subject_id'];?>" <?php if($rows['subject_id']==$row['subject_id']){echo 'selected';}?>>
                                                    <?php echo $rows['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                    ?>
                                </select>
                                </div>
                            
                            </div>
                            <input type="text" name="teacher_id" value="<?php echo $row['teacher_id'] ?>" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Titre');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('type fichier');?></label>
                            <div class="col-md-5">
                                <select name="file_type" class="form-control" data-validate="required" id="file_type" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="">
                                    <option value=""><?php echo get_phrase('choisir type fichier');?></option>
                                    <option value="video"><?php echo get_phrase('Video');?></option>
                                    <option value="pdf"><?php echo get_phrase('PDF');?></option>
                                    <option value="document"><?php echo get_phrase('Document');?></option>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                                <div class="col-sm-5">
                                   
                                    <textarea class="form-control" name="description" id="" cols="30" rows="5"  required><?php echo $row['description'] ;?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date coure');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="timestamp" 
                                     value="<?php echo $row['timestamp']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Fichier cours');?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" value="<?php echo 'uploads/media_files/'.$row['file_name'];?>" 
                                    name="userfile" id="userfile"/>
                                </div>
                            </div>

                            <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('Enregistrer');?></button>
           
                            </div>
                     
                            </div>
                            <div class="form-group">
                            <label for=""class="col-md-3 control-label"></label>
                            <div class="col-sm-5">
                             
                             <div class="progress progress-striped active"> 
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div> </div> 

                                </div>
                            </div>
                            </div>
                         
                            <?php endforeach;?>  
                           

                    </form>   
    
    
    
    
    </div>
</div>

<script>

function selectSubject(){

    var class_id = $('#class_id').val();
    $.ajax({
			url: '<?php echo base_url();?>index.php?admin/get_class_section/'+class_id,
			type:'GET', 
		//   data:{class_id:class_id},
            success:function(data)
            {
				console.log(data);
                jQuery('#subject_id').html(data);

            }
        });

}
$(document).ready(function(){
	
		
		var class_id = $('#class_id').val();
	
		
	
	});
});

</script>
