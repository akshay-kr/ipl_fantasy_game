<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage extends CI_Controller {

    function Manage() {
        parent::__construct();
        session_start();
        unset($_SESSION['filter']);
    }

    public function index() {

        $filter = $this->input->get('filter');
        if ($filter) {
            $_SESSION['filter'] = $filter;
        }
        $filter = $this->defineFilter($filter);
        $config = getPaginationStyleConfig();
        $config["base_url"] = site_url("manage/index");
        $config["total_rows"] = $this->player_model->count($filter);
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

        if (isset($_SESSION['squad'])) {
            $data['squad'] = $_SESSION['squad'];
        }

        $data["budget"] = $_SESSION['budget'];

        $data["links"] = $this->pagination->create_links();
        $players = $this->player_model->get(FALSE, PAGINATION_PER_PAGE, $page, $filter);
        $data["players"] = $players;
        $data["filter"] = $filter;
        $this->load->view('index', $data);
    }

    private function defineFilter($filter) {
        if ($filter == 1) {
            $filter = "bat";
        } else if ($filter == 2) {
            $filter = "wk";
        } else if ($filter == 3) {
            $filter = "all";
        } else if ($filter == 4) {
            $filter = "bow";
        } else {
            $filter = FALSE;
        }
        return $filter;
    }

    public function select() {

        $player_id = $this->input->post('player_id');
        $squad = $_SESSION['squad'];
        $error = NULL;
        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
            $strategy = getStrategy($squad);
            $skill_count = $this->skillCount();

            if (count($_SESSION['selected']) < 8) {
                $result = $this->budget($player_id, 'select');
                if ($result) {
                    array_push($_SESSION['selected'], $player_id);
                    $strategy = getStrategy($squad);
                    $skill_count = $this->skillCount();
                    $strategy_flag = $this->checkStrategy($skill_count, $strategy);
                    if ($strategy_flag) {
                        $error = $strategy_flag;
                        $_SESSION['selected'] = array_diff($_SESSION['selected'], array($player_id));
                        $result = $this->budget($player_id, 'remove');
                    }
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

    private function skillCount() {

        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
            $selected = $this->player_model->get($_SESSION['selected']);
            $skill = array();
            foreach ($selected as $player) {
                array_push($skill, $player->skill);
            }
            $skill_count = array_count_values($skill);
            return $skill_count;
        } else {
            return FALSE;
        }
    }

    private function checkStrategy($skill_count, $strategy) {

        $error = NULL;
        if (isset($skill_count['bat']) && $skill_count['bat'] > $strategy['bat']) {
            $error = "Only " . $strategy['bat'] . " batsman allowed";
        } else if (isset($skill_count['wk']) && $skill_count['wk'] > $strategy['wk']) {
            $error = "Only " . $strategy['wk'] . " wicket keeper allowed";
        } else if (isset($skill_count['all']) && $skill_count['all'] > $strategy['all']) {
            $error = "Only " . $strategy['all'] . " all rounder allowed";
        } else if (isset($skill_count['bow']) && $skill_count['bow'] > $strategy['bow']) {
            $error = "Only " . $strategy['bow'] . " bowler allowed";
        }

        return $error;
    }

    public function remove() {
        $player_id = $this->input->post('player_id');
        $_SESSION['selected'] = array_diff($_SESSION['selected'], array($player_id));
        $this->budget($player_id, 'remove');
        $html = $this->teamTable();
        echo json_encode(array("html" => $html, "budget" => $_SESSION['budget']));
    }

    public function changeSquad() {
        $squad = $this->input->post('squad');
        $_SESSION['squad'] = $squad;
        unset($_SESSION['selected']);
        unset($_SESSION['budget']);
        echo "1";
    }

    public function setName() {

        $name = $this->input->post('name');
        $_SESSION['name'] = $name;
        echo $_SESSION['name'];
    }

}
