<hr>
<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-gradient" data-collapsed="0">
    <div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('list classes');?>
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
    </div>
</div>