<hr> 
<div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
					 <?php echo get_phrase('exam_information_page'); ?>
					</div>
					</div>
<div class="table-responsive">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('exam_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_exam');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('N°');?></div></th>
                    		<th><div><?php echo get_phrase('Date examEN');?></div></th>
                    		<th><div><?php echo get_phrase('Matière');?></div></th>
                    		<th><div><?php echo get_phrase('Professeur');?></div></th>
                            <th><div><?php echo get_phrase('Remarque');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php 
                
                        //$this->db->where('teacher_id',$teacher_id);
                        //$this->db->where('class_id',$class_id);
                        $cond=array('teacher_id'=>$teacher_id,'class_id'=>$class_id);
                         $exams = $this->db->get_where('exam',$cond);
                         foreach($exams->result_array() as $row):
                        ?>
                        <tr>
							<td><?php echo $row['exam_id'];?></td>
							<td><?php  echo $row['date'];?></td>
							<td><?php echo $this->db->get_where('subject', array('subject_id'=>$row['subject_id']))->row()->name ;?></td>
                            <td><?php echo $this->db->get_where('teacher', array('teacher_id'=>$teacher_id))->row()->name ;?> </td>
                            <td><?php echo $row['comment'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/exam/delete/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                         <?php endforeach; ?>
                        </tr>
                      
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?teacher/exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Date examen');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Remarque');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>

                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_exam');?></button>
                              	</div>
								</div>

                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>