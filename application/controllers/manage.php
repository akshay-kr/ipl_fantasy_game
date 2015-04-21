<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage extends CI_Controller {

    function Manage() {
        parent::__construct();

        session_start(); //Strat the session.
        unset($_SESSION['filter']); //Unset the filter.
    }

    /**
     * Index function passing data to the view.
     * $_SESSION['selected'] --> Stores the selected players id.
     * $_SESSION['budget'] -->Stores the current budget.
     * $_SESSION['squad'] --> Stores the selected squad strategy.
     */
    public function index() {

        if (isset($_SESSION['username'])) {

            //Get the total number of players from database.
            $pdata['TotalRec'] = $this->player_model->count();

            //Set the no. of records to be displayed per page for pagination.
            $pdata['perPage'] = PAGINATION_PER_PAGE;

            //Set the pagination function.
            $pdata['ajax_function'] = 'pagination_ajax';

            //Parse paging file to create pagination links.
            $subdata['paging'] = $this->parser->parse('../views/content/paging', $pdata, TRUE);

            //Get the offset value.
            $page = $this->getOffset();

            //Get records of all the players.
            $subdata['all_players'] = $this->player_model->get(FALSE, PAGINATION_PER_PAGE, $page);

            //Array of data to passed to the view.
            $data = array(
                "page" => "main",
                "title" => "IPL Fantasy League",
                "content" => "main",
            );

            $data['body_content'] = $this->parser->parse('../views/content/playerlist', $subdata, TRUE);

            //Pass the selected player data to the view.
            if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
                $data['selected'] = $this->player_model->get($_SESSION['selected']);
            }

            //Set and assign budget in session.
            if (!isset($_SESSION['budget'])) {
                $_SESSION['budget'] = 100;
            }

            //Pass the squad value to the view.
            if (isset($_SESSION['squad'])) {
                $data['squad'] = $_SESSION['squad'];
            }

            //Pass current budget to the view.
            $data["budget"] = $_SESSION['budget'];

            //Load the view.
            $this->load->view('index', $data);
        } else {
            redirect('/user/index', 'refresh');
        }
    }

    /**
     * Set offset value from post data.
     * @return int -> Offset value
     */
    private function getOffset() {
        $page = $this->input->post('page');
        if (!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        return $offset;
    }

    /**
     * Pagination function.
     */
    public function pagination_ajax() {

        //Get filter value.
        $filter = $this->input->post('filter');

        //If filter is not set then set it to false.
        if (!$filter) {
            $filter = FALSE;
        } else {

            //Get corresponding filter from the filter value.
            $filter = $this->defineFilter($filter);
        }

        //Get total no. of players from the database.
        $pdata['TotalRec'] = $this->player_model->count($filter);

        //Set the no. of records to be displayed per page for pagination.
        $pdata['perPage'] = PAGINATION_PER_PAGE;

        //Set pagination function.
        $pdata['ajax_function'] = 'pagination_ajax';

        //Parse paging file to create pagination links.
        $data['paging'] = $this->parser->parse('../views/content/paging', $pdata, TRUE);

        //Get the value of offset.
        $page = $this->getOffset();

        //Get data of all the players.
        $data['all_players'] = $this->player_model->get(FALSE, PAGINATION_PER_PAGE, $page, $filter);

        $this->load->view('content/playerlist', $data);
    }

    /**
     * Get the corresponding filter from filter value.
     * @param int $filter
     * @return boolean
     */
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

    /**
     * Function for selecting players.
     */
    public function select() {

        //Get the current selected player id.
        $player_id = $this->input->post('player_id');

        //Get the squad value.
        $squad = $_SESSION['squad'];
        $error = NULL;

        //Check if the selected player exists or not.
        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {

            //Check if no. of players is less than 8.
            if (count($_SESSION['selected']) < 8) {

                //Get the reduced budget according to the player price.
                $result = $this->budget($player_id, 'select');
                if ($result) {

                    //Assign the player id in selected players session array.
                    array_push($_SESSION['selected'], $player_id);

                    //Get the the strategy from helper function using the value of squad.
                    $strategy = getStrategy($squad);

                    //Get the count of skills of selected players.
                    $skill_count = $this->skillCount();

                    //Check strategy match. Returns error if strategy does not match with skill counts.
                    $strategy_flag = $this->checkStrategy($skill_count, $strategy);

                    //If strategy does not match ie, error then remove the last selected player.
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

            //Executes for the first selected player.
            $_SESSION['selected'] = array();
            array_push($_SESSION['selected'], $player_id);
            $result = $this->budget($player_id, 'select');
        }

        //Create the team list with current selected players.
        $html = $this->teamTable();
        echo json_encode(array("html" => $html, "budget" => $_SESSION['budget'], "error" => $error));
    }

    /**
     * Calculate budget.
     * @param int $player_id
     * @param string $option --> Action i.e, is select player or remove.
     * @return boolean
     */
    private function budget($player_id, $option) {

        $player_data = $this->player_model->get(array($player_id));

        //Get the current player price.
        $player_price = $player_data[0]->price;

        //Get the current budget.
        $current_budget = $_SESSION['budget'];
        if ($option == "select") {

            //Check wethet player price is within the budget i.e, no budget overflow.
            if ($current_budget >= $player_price) {

                //Reduce the current budget.
                $current_budget = $_SESSION['budget'] - $player_data[0]->price;
                $_SESSION['budget'] = $current_budget;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        if ($option == "remove") {

            //Increase the current budget.
            $current_budget = $_SESSION['budget'] + $player_data[0]->price;
            $_SESSION['budget'] = $current_budget;
        }
    }

    /**
     * Create team table with selected players data.
     * @return html --> html of team table.
     */
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

    /**
     * Get the count of skills of selected players.
     * @return int when TRUE else FALSE
     */
    private function skillCount() {

        if (isset($_SESSION['selected']) && count($_SESSION['selected']) > 0) {
            $selected = $this->player_model->get($_SESSION['selected']);
            $skill = array();
            foreach ($selected as $player) {

                //Insert the skills of selected players in an array.
                array_push($skill, $player->skill);
            }

            //Count the no. of each skill in array.
            $skill_count = array_count_values($skill);
            return $skill_count;
        } else {
            return FALSE;
        }
    }

    /**
     * Match the strategy.
     * @param array $skill_count
     * @param array $strategy
     * @return string
     */
    private function checkStrategy($skill_count, $strategy) {

        $error = NULL;
        if (isset($skill_count['bat']) && $skill_count['bat'] > $strategy['bat']) {
            $error = "Only " . $strategy['bat'] . " batsman allowed.";
        } else if (isset($skill_count['wk']) && $skill_count['wk'] > $strategy['wk']) {
            $error = "Only " . $strategy['wk'] . " wicket keeper allowed.";
        } else if (isset($skill_count['all']) && $skill_count['all'] > $strategy['all']) {
            $error = "Only " . $strategy['all'] . " all rounder allowed.";
        } else if (isset($skill_count['bow']) && $skill_count['bow'] > $strategy['bow']) {
            $error = "Only " . $strategy['bow'] . " bowler allowed.";
        }

        return $error;
    }

    /**
     * Removes the selected player.
     */
    public function remove() {

        $player_id = $this->input->post('player_id');

        //Remove the player id from the selected player session array.
        $_SESSION['selected'] = array_diff($_SESSION['selected'], array($player_id));

        //Increase the budget.
        $this->budget($player_id, 'remove');

        //Craete team table.
        $html = $this->teamTable();
        echo json_encode(array("html" => $html, "budget" => $_SESSION['budget']));
    }

    /**
     * Save the team list in the database.
     */
    public function save() {

        $team_name = $this->input->post('team_name');
        $error = NULL;

        //Check if team is complete or not.
        if (count($_SESSION['selected']) < 8) {
            $error = "Please complete your team before submitting.";
        } else {
            $result = $this->user_model->get(array('team' => $team_name));

            //Check whether team name exist or not.
            if (count($result) > 0 && $result[0]->username != $_SESSION['username']) {
                $error = "Team name already exist.";
            } else {
                $players = "";

                //Create string of selected players id.
                foreach ($_SESSION['selected'] as $selected) {
                    $players .= $selected . " ";
                }

                $squad = $_SESSION['squad'];
                $budget = $_SESSION['budget'];

                $data = array(
                    'team' => $team_name,
                    'players' => $players,
                    'squad' => $squad,
                    'budget' => $budget
                );

                $condition = array(
                    'username' => $_SESSION['username']
                );

                //Insert to the database.
                $is_added = $this->user_model->update($data, $condition);
                if (!$is_added) {
                    $error = "Something went wrong";
                }
            }
        }
        echo $error;
    }

    /**
     * Changes the squad i.e, the strategy.
     */
    public function changeSquad() {
        $squad = $this->input->post('squad');
        $_SESSION['squad'] = $squad;
        unset($_SESSION['selected']);
        unset($_SESSION['budget']);
        echo "1";
    }

    /**
     * Check availability of team name.
     */
    public function checkName() {

        $name = $this->input->post('name');
        $result = $this->user_model->get(array('team' => $name));
        $error = NULL;
        if (count($result) > 0) {
            if ($result[0]->team == $name) {
                $error = "This team name is already assigned to you.";
            } else {
                $error = "Sorry this name is not available.";
            }
        } else {
            $_SESSION['name'] = $name;
        }
        echo $error;
    }

}
