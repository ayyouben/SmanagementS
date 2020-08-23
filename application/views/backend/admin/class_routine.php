<hr> 
<div class="panel panel-gradient" >
 
 
<div class="panel-heading">
	<div class="panel-title" >
		<i class="entypo-plus-circled"></i>
		<?php echo get_phrase('Add_class_routine');?>
	</div>
</div>
<div class="panel-body">
<?php echo form_open(base_url() . 'index.php?admin/save_class_routine/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
<div class="form-group">
	<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('Class');?></label>
	
	<div class="col-sm-5">
		<select name="class_id" class="form-control select2">
				<option value=""><?php echo get_phrase('select class');?></option>
				<?php 
				$class = $this->db->get('class')->result_array();
				foreach($class as $row):
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
	<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('subject');?></label>
	<div class="col-sm-5">
		<select name="subject_id" class="form-control select2">
				<option value=""><?php echo get_phrase('select subject');?></option>
				<?php 
				$subject = $this->db->get('subject')->result_array();
				foreach($subject as $row):
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
<div class="form-group">
	<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('day');?></label>
	<div class="col-sm-5">
		<select name="day" class="form-control select2">

				<option value=""><?php echo get_phrase('select day');?></option>
				<option value="lundi"><?php echo get_phrase('lundi');?></option>
				<option value="mardi"><?php echo get_phrase('mardi');?></option>
				<option value="mercredi"><?php echo get_phrase('mercredi');?></option>
				<option value="jeudi"><?php echo get_phrase('jeudi');?></option>
			    <option value="vendredi"><?php echo get_phrase('vendredi');?></option>
				<option value="samedi"><?php echo get_phrase('samedi');?></option>
				<option value="dimanche"><?php echo get_phrase('dimanche');?></option>

		</select>
	</div>

</div>		
<div class="form-group">
		<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('debut');?></label>
		
		<div class="col-sm-5">
			<input type="text" class="form-control" name="time_start" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
		</div>
</div>
<div class="form-group">
		<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('debut');?></label>
		
		<div class="col-sm-5">
			<input type="text" class="form-control" name="time_end" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
		</div>
</div>
<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<button type="submit" class="btn btn-success btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo get_phrase('save_class_routine');?></button>
		</div>
</div>

<?php echo form_close();?>

</div>    
           
</div>