<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Key extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => 'Success Get Api Key!',
                    'status' => 200,
                    'data' => ['key'=>md5(getenv('API_KEY'))]
                ]));

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
