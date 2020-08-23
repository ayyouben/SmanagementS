<?php   $teacher_id=$this->session->userdata('teacher_id');?>
<div class="sidebar-menu">

<header class="logo-env" >

<!-- logo -->
<div class="logo" style="">
    <a href="<?php echo base_url(); ?>">
        <img src="uploads/logo.png"  style="max-height:60px;"/>
    </a>
</div>

<!-- logo collapse icon -->
<div class="sidebar-collapse" style="">
    <a href="#" class="sidebar-collapse-icon with-animation">

        <i class="entypo-menu"></i>
    </a>
</div>

<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
<div class="sidebar-mobile-menu visible-xs">
    <a href="#" class="with-animation">
        <i class="entypo-menu"></i>
    </a>
</div>
</header>

<div style=""></div>
    <ul id="main-menu" class="">
    
    <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
       

    <li class="">
        <a href="#">
          <i class="entypo entypo-download"></i> 
          <span><?php echo get_phrase('Boite message'); ?></span>
        </a>
    </li>

    <li>
        <a href="#">
            <i class="entypo entypo-archive"></i>
            <span><?php echo get_phrase('Liste classes'); ?></span>
        </a>
        <ul>
                        <?php
                      
                        $classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'list_class' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?teacher/list_class/<?php echo $row['class_id'] ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </li>

    <li>
    <a href="<?php echo base_url(); ?>index.php?teacher/attendance">
        <i class="entypo entypo-hourglass"></i>
            <span><?php echo get_phrase('Présence'); ?></span>
        </a>
                    
            
                 
    </li>

    <li><a href="#">
        <i class="entypo entypo-clipboard"></i>
            <span><?php echo get_phrase('Notebook'); ?></span>
        </a>
    </li>

    <li><a href="#">       
        <i class="entypo entypo-docs"></i>
            <span><?php echo get_phrase('Devoir'); ?></span>
        </a>
        <ul>
                        <?php
                      
                        $classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="#">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </li>
 
    <li><a href="#">
    <i class="entypo entypo-book"></i>
            <span><?php echo get_phrase('list des Coures'); ?></span>
        </a>
        <ul>
                        <?php
                      
                        $classes =  $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?teacher/media/<?php echo $row['class_id'] ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </li>
    
    <li><a href="#">
        <i class="entypo entypo-users"></i>
            <span><?php echo get_phrase('Comportement'); ?></span>
        </a>
        <ul>
                        <?php
                      
                        $classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="#">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </li>
    
    <li><a href="#">
        <i class="entypo entypo-book"></i>
            <span><?php echo get_phrase('Exams'); ?></span>
        </a>
        <ul>
                        <?php
                      
                        $classes = $this->db->get_where('class', array('teacher_id' => $teacher_id))->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'list_exam' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?teacher/list_exam/<?php echo $row['class_id']?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    </li>
    
    </ul>


</div>