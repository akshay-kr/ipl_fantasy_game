<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function User() {
        parent::__construct();
        session_start(); //Strat the session.
    }

    /**
     * Function to pass data to the login page view and load it.
     */
    public function index() {

        //Unset session variables;
        $this->unsetAllSession();

        //Array of data to passed to the view.
        $data = array(
            "page" => "Login",
            "title" => "IPL Fantasy League",
            "content" => "login",
        );

        //Load the view.
        $this->load->view('index', $data);
    }

    /**
     * Register new user.
     */
    public function register() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $message = NULL;

        //Check whether username is available or not.
        $result = $this->user_model->validate($username);
        if (count($result) > 0) {
            $message = "The username is already registered.";
        } else {
            $data = array(
                'username' => $username,
                'password' => $this->encrypt->encode($password), //Encrypt the password.
            );

            //Insert user credentials to the database.
            $this->user_model->add($data);
        }

        echo $message;
    }

    /**
     * Login function for existing users.
     */
    public function login() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $message = NULL;

        //Check whether username exists.
        $result = $this->user_model->validate($username);
        if (count($result) > 0) {

            //Get the current user data.
            $user_data = $this->user_model->get(array("username" => $username));

            //Decode the encrypted password and match with current password.
            if ($password == $this->encrypt->decode($user_data[0]->password)) {
                $_SESSION['username'] = $username;

                //Set the session variables with the current user data.
                $this->setTeamData($user_data);
                $message = TRUE;
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "Invalid username.";
        }

        echo $message;
    }

    /**
     * Set the session variables.
     * @param String $username
     */
    private function setTeamData($team_data) {

        //Check if team name exists.
        if ($team_data[0]->team != "") {
            $_SESSION['name'] = $team_data[0]->team;
        }
        $_SESSION['squad'] = $team_data[0]->squad;
        $_SESSION['budget'] = $team_data[0]->budget;
        $splitted = explode(" ", $team_data[0]->players);
        $_SESSION['selected'] = array();
        foreach ($splitted as $split) {
            if ($split != "") {
                array_push($_SESSION['selected'], $split);
            }
        }
    }

    /**
     * Unset all session variables.
     */
    public function unsetAllSession() {
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        unset($_SESSION['squad']);
        unset($_SESSION['budget']);
        unset($_SESSION['selected']);
    }

}
