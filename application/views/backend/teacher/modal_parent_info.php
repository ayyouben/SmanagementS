<?php
$edit_data = $this->db->get_where('parent' , array('parent_id' => $param2) )->result_array(); 
 ?>

<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default panel-shadow" data-collapsed="0"> 
    <div class="panel-heading">
    <div class="panel-title"><?php echo get_phrase('parent Information');?></div>
    </div>
    <div class="panel-body">

    <?php foreach($edit_data as $row):?>

    <div class="col-md-3">  <label for="">Nom Complet : </label> </div>
    <input type="text" value="<?php echo $row['name'] ?>" disabled><br>
    <hr>

    <div class="col-md-3">  <label for="">Fonction : </label> </div>
   
    <input type="text" value="<?php echo $row['profession'] ?>" disabled><br>
    <hr>

    <div class="col-md-3">  <label for="">Email : </label> </div>
   
   <input type="text" value="<?php echo $row['email'] ?>" disabled><br>
    <hr>
    

<div class="col-md-3">  <label for="">Telephone : </label> </div>

<input type="text" value="<?php echo $row['phone'] ?>" disabled><br>
    <hr>
    <div class="col-md-3"><label for="">Adresse : </label> </div>
    <textarea name="" id="" cols="30" rows="3" disabled>
    <?php echo $row['address']?>
    </textarea>

    

    <?php endforeach;?>
    
 
    </div>
    </div>
    </div>
</div>