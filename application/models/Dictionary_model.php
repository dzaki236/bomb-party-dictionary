<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Dictionary_model extends CI_Model 
{
    public function select($keywords)
    {
        $keywords = $this->db->escape_str($keywords);
        $query = $this->db->query("SELECT * FROM `dictionaries` WHERE word LIKE"."'%".$keywords."%'"."ORDER BY RAND();");
        return $query->result();
    }                        
                        
}


/* End of file Dictionary_model.php and path \application\models\Dictionary_model.php */
