<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');






    class Teacher extends CI_Controller{


        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            
           /*cache control*/
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            
        }

        public function index()
        {
            if ($this->session->userdata('teacher_login') != 1)
                redirect(base_url() . 'index.php?login', 'refresh');
            if ($this->session->userdata('teacher_login') == 1)
                redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
        }
        function dashboard()
        {
            if ($this->session->userdata('teacher_login') != 1)
                redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'dashboard';
            $page_data['page_title'] = get_phrase('teacher_dashboard');
            $this->load->view('backend/index', $page_data);
        }
         function list_class($class_id){
            if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'list_class';
            $page_data['page_title'] = get_phrase('liste classe');
            $page_data['class_id']= $class_id;
            $this->load->view('backend/index',$page_data);

        }


        function list_exam($class_id){

            if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'list_exam';
            $page_data['page_title'] = get_phrase('liste examen');
            $page_data['class_id']= $class_id;
            $this->load->view('backend/index',$page_data);

        }

        // Manage Exam


        function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
           
            $data['comment']    = $this->input->post('comment');
            $data['date']    = $this->input->post('date');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['class_id'] = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');

           if( $this->db->insert('exam', $data)){
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/list_exam/'.$data['class_id'], 'refresh');
           }else{
               //print_r($data);
               $this->session->set_flashdata('error_message' , get_phrase('les donnes ne sont pas bien ajouter !'));
           }

   
        }

        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/list_exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'list_exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }
    // liste des cours 

    public function list_cour($class_id){

        if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
        
        $page_data['page_name']  = 'list_cour';
        $page_data['page_title'] = get_phrase('liste des cours');
        $page_data['class_id']= $class_id;
        $this->load->view('backend/index',$page_data);


    }
    public function media($class_id,$param1='',$param2='',$param3=''){

        if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');
        if($param1=="create"){

            $data['timestamp']   = $this->input->post('timestamp');
            $data['title']       = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['file_name']   = $_FILES['userfile']['name'];
            $data['file_type']   =$this->input->post('file_type');
            $data['class_id']    = $this->input->post('class_id');
            $data['teacher_id']  = $this->input->post('teacher_id');
            $data['mlink']  = '';
            $data['subject_id']  = $this->input->post('subject_id');;
        

           if(move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/media_files/'.$_FILES['userfile']['name']))
           {
                if($this->db->insert('media',$data))
                {

                    $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                    redirect(base_url() . 'index.php?teacher/list_cour/'.$data['class_id'], 'refresh');
                }
                else
                {
                    echo  $this->input->post('userfile')."<br>";
                    var_dump($this->db->error());
                }   
            
           }

        }
        if($param1=="edit"){

            $data['timestamp']   = $this->input->post('timestamp');
            $data['title']       = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            
            $data['file_type']   =$this->input->post('file_type');
            $data['class_id']    = $this->input->post('class_id');
            $data['teacher_id']  = $this->input->post('teacher_id');
            $data['mlink']  = '';
            $data['subject_id']  = $this->input->post('subject_id');
            if($_FILES['userfile']['name'] != null){
                $data['file_name']=$_FILES['userfile']['name'];
            }
            $this->db->where('media_id', $param2);
           
            if( $this->db->update('media', $data))
            {
 
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/media_files/'.$_FILES['userfile']['name']);
                $this->session->set_flashdata('flash_message' , get_phrase('cour bien modifier !'));
                redirect(base_url() . 'index.php?teacher/media/'.$class_id, 'refresh');
            }else{
                $this->session->set_flashdata('error_message' , get_phrase('cour na pas modifier !'));
                redirect(base_url() . 'index.php?teacher/media/'.$class_id, 'refresh');
            }
        }

        if($param1=='delete'){
            $this->db->where('media_id', $param2);
            $this->db->delete('media');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/media/'.$class_id, 'refresh');

        }
  
        $page_data['page_name']  = 'media';
        $page_data['page_title'] = get_phrase('liste des cours');
        $page_data['class_id']= $class_id;
        $this->load->view('backend/index',$page_data);

   
    }
    function telecharger($class_id,$file_name)
    {
            
        $this->load->helper('download');
        
        if(force_download('uploads/media_files/'.$file_name, NULL))
        {
                redirect(base_url() . 'index.php?teacher/media/'.$class_id, 'refresh');
        }

    
    }

    function attendance($param1='',$param2='',$param3='')
    {
        if ($this->session->userdata('teacher_login') != 1)
        redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'presence';
        $page_data['page_title'] = get_phrase('liste presence cours');
        $this->load->view('backend/index',$page_data);

    }
    public function get_student_attendance($param1='',$param2=''){

        if ($this->session->userdata('teacher_login') != 1)
        redirect('login', 'refresh');

       $this->load->model('Crud_model');
       if($param1=='student'){
        $query= $this->db->get_where('student',array('class_id'=>$param2))->result_array();
        $createTable="";
      foreach($query as $customerData)
      {
          $createTable .= '<tr>';
          $createTable .= '<td>'.$customerData['student_id'].'</td>';
          $createTable .= '<td>'.$customerData['name'].'</td>';
        
          $createTable .= '<td>'.$this->db->get_where('class',array('class_id'=>$customerData['class_id']))->row()->name.'</td>';
          $createTable .= '<td>'.$this->db->get_where('attendance',array('student_id'=>$customerData['student_id']))->num_rows().'</td>';
          $createTable .= '<td>'.'<button class="btn btn-blue btn-icon" name="detail_student" value="'.$customerData['student_id'].'" onclick="get_student_detail(this);">
          Détail<i class="entypo-right-open-big"></i></button>
          <label id="btn_value" style="display:none">'.$customerData['student_id'].'</label></td>';
          $createTable .= '</tr>';
          	
      }
      echo $createTable;
        
       }else if($param1=='attendance'){
        $query= $this->db->get_where('attendance',array('student_id'=>$param2))->result_array();
        $createTable="";
      foreach($query as $customerData)
      {
          $createTable .= '<tr>';
          $createTable .= '<td>'.$customerData['date'].'</td>';
        
          $createTable .= '<td>'.$customerData['hour'].'</td>';
          $createTable .= '<td>'.$this->db->get_where('subject',array('subject_id'=>$customerData['subject_id']))->row()->name.'</td>';
            if($customerData['justifiyed']=='0'){
                $createTable .= '<td><span class="badge badge-danger">non justiffier</span></td>';
            }else if($customerData['justifiyed']=='1'){
                $createTable .= '<td><span class="badge badge-success">justiffier</span></td>';
            }
         

          $createTable .= '</tr>';	
        
      }
      echo $createTable;
       }
 
        
    }



    }





?>