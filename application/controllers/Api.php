<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {
    public function __construct($config = 'rest')
    {
        // Construct the parent class
        // $this->load->model('dictionary_model');
        parent::__construct($config);
    }
    public function dictionary_post()
    {
        # code...
        // if ($this->post('api_key') == md5(getenv('API_KEY'))) {
            # code...
            $keywords = ($this->post('keywords'));
            $data = $this->dictionary_model->select($keywords);
            return $this->response([
                'message' => 'Success!',
                'status' => 200,
                'total'=>count($data),
                'data' => $data
            ],200);
        // }
        // else{
        //     return $this->response([
        //         'message' => 'Uknown Api Key!',
        //         'status' => 401,
        //         // 'data'=>md5(getenv('API_KEY'))
        //     ],401);
        // }
    }
    public function key_post()
    {
        return $this->response([
            'message' => 'Success Get Api Key!',
            'status' => 200,
            'data' => ['key'=>md5(getenv('API_KEY'))]
        ]);
    }
}