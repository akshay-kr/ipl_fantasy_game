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

