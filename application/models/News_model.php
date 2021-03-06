<?php
class News_model extends CI_Model {

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
   function m_list_news()
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $query = $this->db->get();
      return $query->result();
   }
   function m_list_category()
   {
      $this->db->select('*');    
      $this->db->from('mst_category');
      $query = $this->db->get();
      return $query->result();
   }
   function m_edit_news_active($data,$id)
   {
      $this->db->where('id', $id);
      if ($this->db->update('mst_news',$data)) 
      {
         return 1;
      }
      else
      {
         return 0;
      }
   }
   function m_delete_news_data($data,$id)
   {
      $query=$this->db->where('id', $id);
      $query = $this->db->get('mst_news');
      $count = $this->db->count_all_results();
      foreach ($query->result() as $row){
         if ($row->image !=null | $row->image !="") {
            unlink("./assets/images/news/".$row->image);
         }
      }
      if($this->db->delete('mst_news',$data))
      {
         return 1;
      }
      
   }
   function m_insert_news($data)
   {
      print_r($data);
      $this->db->insert('mst_news',$data);
   }
   function m_edit_news($data)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where($data);
      $query = $this->db->get();
      return $query->result();

   }
   function m_edit_news_data($data,$id)
   {
      $this->db->where('id', $id);
      $query = $this->db->get('mst_news');
      $count = $this->db->count_all_results();
      
      if ($this->upload->file_name == "") 
      {
         foreach ($query->result() as $row){}
            unlink("./assets/images/news/".$row->image);
      }  

      $this->db->where('id', $id);
      $this->db->update('mst_news',$data);
   }

   // FRONTS
   function m_home_hot_promo()
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","1");
      $this->db->where("status","1");
      $this->db->limit("4");
      $query = $this->db->get();
      return $query->result_object();
   }
   function m_home_hot_news()
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","4");
      $this->db->where("status","1");
      $this->db->limit("3");
      $query = $this->db->get();
      return $query->result();
   }
   function m_home_hot_product()
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","3");
      $this->db->where("status","1");
      $this->db->limit("3");
      $query = $this->db->get();
      return $query->result();
   }
   function m_home_hot_event()
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","2");
      $this->db->where("status","1");
      $this->db->limit("6");
      $query = $this->db->get();
      return $query->result();
   }
   function m_all_promo($perPage, $uri)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","1");
      $this->db->where("status","1");

      $getData = $this->db->get('', $perPage, $uri);

      if ($getData->num_rows() > 0)
      {
         return $getData->result_array();
      }
      else
      {
         return null;
      }
   }
   function m_all_event($perPage, $uri)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","2");
      $this->db->where("status","1");

      $getData = $this->db->get('', $perPage, $uri);

      if ($getData->num_rows() > 0)
      {
         return $getData->result_array();
      }
      else
      {
         return null;
      }
   }
   function m_all_news($perPage, $uri)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","4");
      $this->db->where("status","1");

      $getData = $this->db->get('', $perPage, $uri);

      if ($getData->num_rows() > 0)
      {
         return $getData->result_array();
      }
      else
      {
         return null;
      }
   }
   function m_all_product($perPage, $uri)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","3");
      $this->db->where("status","1");

      $getData = $this->db->get('', $perPage, $uri);

      if ($getData->num_rows() > 0)
      {
         return $getData->result_array();
      }
      else
      {
         return null;
      }
   }

   function m_detail_promo($id)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","1");
      $this->db->where("status","1");
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result();
   }
   function m_detail_event($id)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","2");
      $this->db->where("status","1");
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result();
   }
   function m_detail_news($id)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","4");
      $this->db->where("status","1");
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result();
   }
   function m_detail_product($id)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where("category","3");
      $this->db->where("status","1");
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result();
   }
   function m_detail_search($id)
   {
      $this->db->select('*');    
      $this->db->from('mst_news');
      $this->db->where('id', $id);
      $this->db->where("status","1");
      $query = $this->db->get();
      return $query->result();
   }

   function m_search($perPage, $uri, $search_keyword)
   {
      $this->db->select('*');
      $this->db->from('mst_news');
      $this->db->where("status","1");

      if (!empty($search_keyword)) 
      {
         $this->db->like('title', $search_keyword);
      }
      $this->db->order_by('id','asc');
      $getData = $this->db->get('', $perPage, $uri);

      if ($getData->num_rows() > 0)
      {
         return $getData->result_array();
      }
      else
      {
         return null;
      }
   }
}