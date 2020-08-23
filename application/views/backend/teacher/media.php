<hr>
<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-gradient" data-collapsed="0">
    <div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Liste des cours');?>
            	</div>
    </div>
    <div class="table-resposive">
	<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('liste des cours');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Ajouter cour');?>
                    	</a></li>
		</ul>

    </div>
      
    <div class="tab-content">
            <div class="tab-pane box active" id="list">
                
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                    <tr>
                    <th>N° </th>
                    <th>Date</th>
                    <th>Titre</th>
                    <th>Déscription</th>
                    <th>Classe</th>
                    <th>Télécharger</th>
                    <th>Voir le coure</th>
                    <th>Options</th>
                    </tr>
                </thead>
                <tbody>
       
               <?php 
               $students   =  $this->db->get_where('media' , array('class_id'=>$class_id , 'teacher_id'=>$teacher_id))->result_array();
               foreach($students as $row):?>
                <tr>
                <td><?php echo $row['media_id']?></td>
                <td><?php echo $row['timestamp']?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['description']?></td>
                <td><?php echo $this->db->get_where('class', array('class_id'=>$row['class_id']))->row()->name ;?></td>
                <td>
                <a href="<?php echo base_url().'index.php?teacher/telecharger/'.$class_id.'/'.$row['file_name'] ;?>" class="btn btn-success btn-icon">
                Telecharger<i class="entypo-download"></i> 
                </a>
                
                </td>
                <td>
                <button type="button" class="btn btn-info btn-icon" 
                onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/moda_voir_cour/<?php echo $row['media_id'];?>');">
                Voir<i class="entypo-play"></i> </button>
                </td>
                <td>
                <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_media/<?php echo $row['media_id'];?>/<?php echo $class_id?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('modifier');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/media/<?php echo $class_id ?>/delete/<?php echo $row['media_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('suprimer');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
                
                </td>
                
           
                </tr>
               
               <?php endforeach;?>
                </tbody>
                </table>
                </div>
                <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?teacher/media/'.$class_id.'/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top',
                    'enctype'=>'multipart/form-data'));?>
                        
                                <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('classe');?></label>
                                <div class="col-md-5">
                                <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                        data-message-required="<?php echo get_phrase('value_required');?>"
                                            onchange="">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php 
                                        $classes = $this->db->get_where('class', array('teacher_id'=>$teacher_id))->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['class_id'];?>">
                                                    <?php echo $row['name'];?>
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
                                            onchange="">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php 
                                        $classes = $this->db->get_where('subject', array('teacher_id'=>$teacher_id))->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['subject_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                    ?>
                                </select>
                                </div>
                            
                            </div>
                            <input type="text" name="teacher_id" value="<?php echo  $teacher_id ?>" style="display:none">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Titre');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="title" required>
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
                                   
                                    <textarea class="form-control" name="description" id="" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date coure');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="timestamp" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Fichier cours');?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="userfile" id="userfile"/>
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
                         
                            
                           

                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
          <!--  <embed src="uploads/media_files/Quoran.mp4" width=800 height=500 type='video/mp4'/>-->
                </div>

            </div>
          


    



</div>
    </div>
</div>