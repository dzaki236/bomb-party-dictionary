<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_Dictionaries extends CI_Migration
{
    protected $tableName  = 'dictionaries';

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'word' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP");
        $this->dbforge->add_field("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

        // If you want to add a foriegn key.
        // role_id must be a column of this table, please add it above in the table. And make sure admin_roles table is added before this table. 
        // $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (role_id) REFERENCES admin_roles(id) ON DELETE RESTRICT ON UPDATE CASCADE');

        $this->dbforge->create_table($this->tableName);

        //Inserting first row
        // $this->db->insert($this->tableName, [
        //     'username'   => 'murad_ali',
        //     'phone'      => '123-123-7834',
        //     'password'   => password_hash('123456', PASSWORD_BCRYPT),
        // ]);

        //Inserting two rows
        // $data = [
        //      [
        //          'username'   => 'murad_ali',
        //          'phone'      => '123-123-7834',
        //          'password'   => password_hash('123456', PASSWORD_BCRYPT),
        //      ],
        //      [
        //          'username'   => 'murad_ali',
        //          'phone'      => '123-123-7834',
        //          'password'   => password_hash('123456', PASSWORD_BCRYPT),
        //      ]
        // ];

        $file_handle = fopen(APPPATH . 'migrations/' . "list.txt", "rb");
        $arr = array();
        while (!feof($file_handle)) {

            $line_of_text = fgets($file_handle);
            $parts = explode('=', $line_of_text);

            $arr[] = ['word' => $parts[0]];
        }
        $_datas = array_chunk($arr, 300);
        foreach ($_datas as $key => $data) {
            $this->db->insert_batch($this->tableName, $data);
        }

        $this->db->trans_complete();
        fclose($file_handle);
        // $this->db->insert_batch($this->tableName, $arr);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}


/* End of file 20230402074232_dictionaries.php and path \application\migrations\20230402074232_dictionaries.php */
