<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('nip')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['judul'] = 'Bahan';
        $data['user'] = $this->Ahsp_model->getTablewhere('biodata', 'nip', $this->session->userdata('nip'))->row_array();
        $data['bahan'] = $this->Ahsp_model->getTable('bahan', 'kode')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('bahan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('kode', 'Kode', 'required|trim|is_unique[bahan.kode]', [
            'is_unique' => '{field} sudah ada',
            'required' => '{field} harus diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[bahan.nama]', [
            'is_unique' => '{field} sudah ada',
            'required' => '{field} harus diisi'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
            'required' => '{field} harus diisi'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric', [
            'required' => '{field} harus diisi',
            'numeric' => '{field} harus Angka'
        ]);
        $data['judul'] = 'Tambah Data Bahan';
        $data['user'] = $this->Ahsp_model->getTablewhere('biodata', 'nip', $this->session->userdata('nip'))->row_array();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('bahan/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Ahsp_model->tambah('bahan');
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('bahan');
        }
    }

    public function hapus($id = null)
    {
        $data['cekid'] = $this->Ahsp_model->getTablewhere('bahan', 'id', $id)->num_rows();
        if ($id == null || $data['cekid'] < 1) {
            redirect('bahan');
        } else {
            $this->Ahsp_model->hapus('bahan', $id);
            $this->session->set_flashdata('flash', 'Dihapus');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function edit($id = null)
    {
        $data['cekid'] = $this->Ahsp_model->getTablewhere('bahan', 'id', $id)->num_rows();
        if ($id == null || $data['cekid'] < 1) {
            redirect('bahan');
        } else {
            $data['bahan'] = $this->Ahsp_model->getTablewhere('bahan', 'id', $id)->row_array();
            $this->form_validation->set_rules('kode', 'Kode', 'required|trim', ['required' => '{field} harus diisi']);
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => '{field} harus diisi']);
            $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', ['required' => '{field} harus diisi']);
            $this->form_validation->set_rules('harga', 'Harga', 'required|trim', ['required' => '{field} harus diisi']);
            $data['judul'] = 'Edit Data Bahan';
            $data['user'] = $this->Ahsp_model->getTablewhere('biodata', 'nip', $this->session->userdata('nip'))->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('bahan/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Ahsp_model->edit('bahan');
                $this->session->set_flashdata('flash', 'Diubah');
                redirect('bahan');
            }
        }
    }
}