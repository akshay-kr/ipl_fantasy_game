<?php

/**
 * Get the current strategy from squad value.
 * @param int $squad
 * @return array
 */
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

/**
 * Get skill from skill code.
 * @param string $code
 * @return string
 */
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

