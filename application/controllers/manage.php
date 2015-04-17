<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage extends CI_Controller {

    function Manage() {
        parent::__construct();
        session_start();
    }

    public function index() {

        $filters = FALSE; //$this->defineFilters();
        $config = getPaginationStyleConfig();
        $config["base_url"] = site_url("manage/index");
        $config["total_rows"] = $this->player_model->count($filters);
        $config["per_page"] = PAGINATION_PER_PAGE;
        $config["uri_segment"] = 3;

        if (count($_GET) > 0) {
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        }

        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array(
            "page" => "main",
            "title" => "IPL Fantasy League",
            "content" => "main",
        );

        $data["links"] = $this->pagination->create_links();
        $players = $this->player_model->get(FALSE, PAGINATION_PER_PAGE, $page, $filters, FALSE);
        $data["players"] = $players;
        $data["filters"] = $filters;
        $this->load->view('index', $data);
    }

    public function select() {

        $player_id = $this->input->post('player_id');

        if (isset($_SESSION['selected']) && count($_SESSION['selected']) <= 8) {
            array_push($_SESSION['selected'], $player_id);
        } else {
            $_SESSION['selected'] = array();
            array_push($_SESSION['selected'], $player_id);
        }

        $html = $this->load->view("content/teamlist", array(
            "selected" => $this->player_model->get($_SESSION['selected'])
                ), TRUE);
        echo $html;
    }

}
