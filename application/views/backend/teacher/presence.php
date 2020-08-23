<div class="">
<div class="row">

</div>
<div class="panel panel-gradient">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('Liste presence');?>
                    </div>
                </div>
                <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <label for=""class="col-md-1 control-label">Classe</label>
                    <div class="col-md-3">
                    <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                    data-message-required="<?php echo get_phrase('value_required');?>"
                        onchange="">
                <option value="" selected><?php echo get_phrase('select');?></option>
                <?php 
                    $classes = $this->db->get_where('class', array('teacher_id'=>$row['teacher_id']))->result_array();
                    foreach($classes as $rows):
                        ?>
                        <option value="<?php echo $rows['class_id'];?>">
                                <?php echo $rows['name'];?>
                                </option>
                    <?php
                    endforeach;
                ?>
            </select>
                    </div>
                  
                </div>
                </div>
                </div>
                <hr>
                <div class="row">
                </div>
           
              
                <div class="col-md-6">
                    <table class="table table-bordered datatable" id="table_export"> 
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom Etudiant </th>
                            <th>Classe</th> 
                            <th>Totale Absence</th> 
                            <th>Détail</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        
                        </tbody>
                    </table>
                </div>
                 
                <div class="col-md-6">
                <table class="table table-striped"> 
                        <thead>
                        <tr>
                            <th>date</th>
     
                            <th>Heure</th> 
                            <th>Matiere</th> 
                            <th>Justification</th>
                        </tr>
                        </thead>
                        <tbody id="data2">
                        
                        </tbody>
                    </table>
                </div>
                </div>
    </div>

    <div class="tab-content">
            <div class="tab-pane active" id="home">
                
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                    <tr>
                    <th>N° </th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>telephone</th>
                    <th>Email</th>
                    <th>Parent</th>
                    </tr>
                </thead>
                <tbody>
       
               <?php 
               $students   =   $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
               foreach($students as $row):?>
                <tr>
                <td><?php echo $row['student_id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['birthday']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                <td><?php echo $row['email']?></td>
                <td>
                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_parent_info/<?php echo $row['parent_id'];?>');">
                        <i class="entypo-user"></i>
                        <?php echo get_phrase('Parent');?>
                </a>
                </td>
                </tr>
               
               <?php endforeach;?>
                </tbody>
                </table>
                </div></div>


</div>


<script>

        $('#class_id').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;

            $.ajax({
                    url: '<?php echo base_url();?>index.php?teacher/get_student_attendance/student/'+valueSelected,
                    type:'GET', 
                //   data:{class_id:class_id},
                    success:function(data)
                    {
                        
                        jQuery('#data').html(data);

                    }
                });


                $('#data2').html('');

        });
  
  



    function get_student_detail(event){

        //alert(event.value); // true
       var student_id=
        $.ajax({
			url: '<?php echo base_url();?>index.php?teacher/get_student_attendance/attendance/'+event.value,
			type:'GET', 
		//   data:{class_id:class_id},
            success:function(data)
            {
				
                jQuery('#data2').html(data);

            }
        });
    }


</script>