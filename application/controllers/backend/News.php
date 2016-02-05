<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Backend {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('news_model');
  }
  public function index()
  {
    $this->header();
    $this->load->view('backend_view/news/index');
    $this->footer();
  }
  public function list_data()
  {

    $data['data'] =$this->news_model->m_list_news();
    echo json_encode( $data );

  }
  public function list_data_category()
  {

    $data=$this->news_model->m_list_category();
    echo json_encode( $data );

  }
  function insert()
  {
    $this->header();
    $this->load->view('backend_view/news/add');
    $this->footer();
  }
  function insert_data()
  {

    $this->form_validation->set_rules('title', 'Title','is_unique[mst_news.title]');
    if ($this->form_validation->run() == true)
    {  
      $config = array(
        'allowed_types' => 'jpg|jpeg|gif|png',
        'max_size' => 2000,
        'file_name' => url_title($this->input->post('file_upload')),
        'upload_path' => './assets/images/news/'
        );
      $this->load->library('upload',$config);

      $data=array(
        'title' => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'category' => $this->input->post('category')
        );
      if ($this->input->post('userfile') !="")
      {
        if($this->upload->do_upload())
        {
          $file = $this->upload->file_name;
          $data['image']=$file;
          $this->news_model->m_insert_news($data); 
          $out= array(
            'isSuccess' => 1,
            'message' => "File Has Been Save"
            );
          echo json_encode( $out );
        }
        else
        {
          $out= array(
            'isSuccess' => 0,
            'message' => $this->upload->display_errors()
            );
          echo json_encode( $out );
        }

      }
      else
      {
        $this->news_model->m_insert_news($data); 
        $out= array(
            'isSuccess' => 1,
            'message' => "File Has Been Save Without Image"
            );
        echo json_encode( $out );
      }
    }
    else
    {
      $out= array(
        'isSuccess' => 0,
        'message' => "Data With That Title Has been Exist!"
        );
      echo json_encode( $out );
    }
  }
  function delete_news_data($id)
  {      
    $data=array(
      'id' => $id
      );


    $param=$this->news_model->m_delete_news_data($data,$id);
    if($param == 1)
    {
      $out= array(
        'isSuccess' => 1,
        'message' => "Success Delete Data"
        );
      echo json_encode( $out );
    }
    else
    {
      $out= array(
        'isSuccess' => 0,
        'message' => "Failed Delete Data"
        );
      echo json_encode( $out );
    }

  }
}
