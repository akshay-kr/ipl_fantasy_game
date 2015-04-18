<?php

function getStrategy($squad) {
    if ($squad == 1) {
        $strategy = array(
            'bat' => 3,
            'wk' => 1,
            'all' => 2,
            'bow' => 2
        );
    } else if ($squad == 2) {
        $strategy = array(
            'bat' => 3,
            'wk' => 1,
            'all' => 1,
            'bow' => 3
        );
    } else if ($squad == 3) {
        $strategy = array(
            'bat' => 4,
            'wk' => 1,
            'all' => 1,
            'bow' => 2
        );
    }

    return $strategy;
}

function getSkill($code) {
    switch ($code) {
        case "bat":
            $skill = "Batsman";
            break;

        case "bow":
            $skill = "Bowler";
            break;

        case "all":
            $skill = "All Rounder";
            break;

        case "wk":
            $skill = "Wicket Keeper";
            break;
    }
    return $skill;
}

function getPaginationStyleConfig() {
    $config = array();
    $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
    $config['full_tag_close'] = '</ul>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="current"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['first_link'] = '&lt;&lt;';
    $config['last_link'] = '&gt;&gt;';

    return $config;
}
