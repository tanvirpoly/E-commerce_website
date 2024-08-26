<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
    }

    public function index()
    {
        $this->load->view('backup');
    }

    public function download()
    {
        // Backup filename
        $filename = 'backup-' . date('YmdHis') . '.sql';

        // Backup filepath
        $filepath = FCPATH . 'backups/' . $filename;

        // Create backup file
        $prefs = array(
            'format'      => 'sql',
            'filename'    => $filename,
            'add_drop'    => TRUE,
            'add_insert'  => TRUE,
            'newline'     => "\n"
        );
        $backup = $this->dbutil->backup($prefs);
        write_file($filepath, $backup);

        // Download backup file
        force_download($filename, $backup);
    }
}