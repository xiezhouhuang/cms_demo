<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('upload_form', array('error' => ' ' ));
    }

    public function do_upload($path = '')
    {	
        if($path != ''){
            $path = $path.'/';
        }
        $config['upload_path']      = './uploads/'.$path;
        $config['allowed_types']    = 'jpg|png|gif|bmp|jpeg|svg|zip|rar|7z';
        $config['encrypt_name']    =  true;
        $config['max_size']     = 1000000;
        $config['max_width']        = 5000;
        $config['max_height']       = 5000;

        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file'))
        {
            $error = $this->upload->display_errors();
            $result = $this->upload->data();
            $data['code'] = 1;
            $data['msg'] = $error;
            $data['data'] = $result;
            $this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($data));
        }
        else
        {
            $result =  $this->upload->data();
            $data['code'] = 0;
            $data['msg'] = "上传成功";
            $name  = explode(".", $result['orig_name']);
            $data['data'] = array('src' => '/uploads/'.$path.''.$result['file_name'],'title' => $result['raw_name'],'orig_name' => $name[0]);
            $this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($data));
        }
    }
}
?>