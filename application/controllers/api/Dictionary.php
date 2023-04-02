<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dictionary extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dictionary_model');
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            //its a get
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode([
                    'message' => 'Method Not Allowed!',
                    'status' => 405,
                    'data' => []
                ]));
        } elseif ($this->input->server('REQUEST_METHOD') === 'POST') {
            //its a post
            if ($this->input->post('api_key') == md5(getenv('API_KEY'))) {
                # code...
                $keywords = htmlspecialchars($this->input->post('keywords',true));
                $data = $this->dictionary_model->select($keywords);
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => 'Success!',
                    'status' => 200,
                    'total'=>count($data),
                    'data' => $data
                ]));
            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode([
                    'message' => 'Uknown Api Key!',
                    'status' => 401,
                ]));
            }

        }
        // return $this->output
        //     ->set_content_type('application/json')
        //     ->set_status_header(200)
        //     ->set_output(json_encode([
        //         'text' => '200',
        //         'type' => 'good',
        //         'input' => $this->input->post()
        //     ]));
    }
}
