<hr> 

		<div class="panel panel-gradient" >
			<img src="uploads/img/academic.png"  alt="" />
			<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('academic_syllabus');?>
            	</div>
				<div class="panel-body">
				<ul class="nav nav-tabs bordered">
						<li class="active">
						<a href="#home" data-toggle="tab">
							<span class="visible-xs"><i class="entypo-users"></i></span>
							<span class="hidden-xs"><?php echo get_phrase('all_students');?></span>
						</a>
					</li>
				</ul>
			
				<div class="col-md-3">
				<select name="class_id" class="form-control" data-validate="required" id="class_id" 
				data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="">
									<option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
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
            </div>
		</div>

