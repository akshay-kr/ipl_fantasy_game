<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function User() {
        parent::__construct();
        session_start(); //Strat the session.
    }

    public function index() {

        //Array of data to passed to the view.
        $data = array(
            "page" => "Login",
            "title" => "IPL Fantasy League",
            "content" => "login",
        );

        //Load the view.
        $this->load->view('index', $data);
    }

    public function register() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $message = NULL;
        $result = $this->user_model->validate($username);
        if (count($result) > 0) {
            $message = "The username is already registered.";
        } else {
            $data = array(
                'username' => $username,
                'password' => $password,
            );
            $this->user_model->add($data);
        }

        echo $message;
    }

    public function login() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $message = NULL;

        $result = $this->user_model->validate($username);
        if (count($result) > 0) {
            $user_data = $this->user_model->validate($username, $password);
            if (count($user_data) > 0) {
                $_SESSION['username'] = $username;
                $this->setTeamData($username);
                $message = TRUE;
            } else {
                $message = "Incorrect password";
            }
        } else {
            $message = "Invalid username";
        }

        echo $message;
    }

    private function setTeamData($username) {

        $team_data = $this->user_model->get(array('username' => $username));
        if ($team_data[0]->team != "") {
            $_SESSION['name'] = $team_data[0]->team;
        }
        $_SESSION['squad'] = $team_data[0]->squad;
        $_SESSION['budget'] = $team_data[0]->budget;
        $splitted = explode(" ", $team_data[0]->players);
        $_SESSION['selected']=array();
        foreach($splitted as $split){
            if($split!=""){
                array_push($_SESSION['selected'], $split);
            }
        }
    }

    public function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        unset($_SESSION['squad']);
        unset($_SESSION['budget']);
        unset($_SESSION['selected']);
        echo TRUE;
    }

}
