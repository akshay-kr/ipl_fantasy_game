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
        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
            $data['selected'] = $this->player_model->get($_SESSION['selected']);
        }

        if (!isset($_SESSION['budget'])) {
            $_SESSION['budget'] = 100;
        }

        $data["budget"] = $_SESSION['budget'];

        $data["links"] = $this->pagination->create_links();
        $players = $this->player_model->get(FALSE, PAGINATION_PER_PAGE, $page, $filters, FALSE);
        $data["players"] = $players;
        $data["filters"] = $filters;
        $this->load->view('index', $data);
    }

    public function select() {

        $player_id = $this->input->post('player_id');
        $error = NULL;

        if (isset($_SESSION['selected'])) {
            if (count($_SESSION['selected']) < 8) {
                $result = $this->budget($player_id, 'select');
                if ($result) {
                    array_push($_SESSION['selected'], $player_id);
                } else {
                    $error = "You dont have enough budget to buy this player.";
                }
            } else if (count($_SESSION['selected']) == 8) {
                $error = "Maximum of 8 players can be selected.";
            }
        } else {
            $_SESSION['selected'] = array();
            array_push($_SESSION['selected'], $player_id);
            $result = $this->budget($player_id, 'select');
        }

        $html = $this->teamTable();
        echo json_encode(array("html" => $html, "budget" => $_SESSION['budget'], "error" => $error));
    }

    private function budget($player_id, $option) {

        $player_data = $this->player_model->get(array($player_id));
        $player_price = $player_data[0]->price;
        $current_budget = $_SESSION['budget'];
        if ($option == "select") {
            if ($current_budget >= $player_price) {
                $current_budget = $_SESSION['budget'] - $player_data[0]->price;
                $_SESSION['budget'] = $current_budget;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        if ($option == "remove") {
            $current_budget = $_SESSION['budget'] + $player_data[0]->price;
            $_SESSION['budget'] = $current_budget;
        }
    }

    private function teamTable() {

        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
            $selected = $this->player_model->get($_SESSION['selected']);
        } else {
            $selected = NULL;
        }
        $html = $this->load->view("content/teamlist", array(
            "selected" => $selected), TRUE);
        return $html;
    }

    public function remove() {
        $player_id = $this->input->post('player_id');
        $_SESSION['selected'] = array_diff($_SESSION['selected'], array($player_id));
        $this->budget($player_id, 'remove');
        $html = $this->teamTable();
        echo json_encode(array("html" => $html, "budget" => $_SESSION['budget']));
    }

}
