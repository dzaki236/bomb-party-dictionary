<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Dictionary_model extends CI_Model 
{
    public function select($keywords)
    {
        // $this->db->select('word');
        // $this->db->from('dictionaries');
        if ($keywords != null) {
            //     # code...
            $keywords = $this->db->escape_str($keywords);
            // $this->db->like('word', $keywords);
            // $this->db->limit(500);
            $query = $this->db->query("SELECT word FROM `dictionaries` WHERE word LIKE"."'%".$keywords."%'"."ORDER BY RAND() LIMIT 500");
        }else{
            // $this->db->limit(0);
            $query = $this->db->query("SELECT word FROM `dictionaries` WHERE word LIKE"."'%".$keywords."%'"."ORDER BY RAND() LIMIT 0");
        }
        // $query = $this->db->get();
        return $query->result();
    }                        
                        
}


/* End of file Dictionary_model.php and path \application\models\Dictionary_model.php */
