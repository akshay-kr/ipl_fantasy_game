<div class="row" id="sent-list">
    <div class="small-12 large-12 columns center" id="list-container">  
        <table class="small-12 large-12">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Skill</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tr id="player1">
                <?php if (isset($player1)) { ?>
                    <td><?php echo "Player 1" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player2">
                <?php if (isset($player2)) { ?>
                    <td><?php echo "Player 2" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player3">
                <?php if (isset($player3)) { ?>
                    <td><?php echo "Player 3" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player4">
                <?php if (isset($player4)) { ?>
                    <td><?php echo "Player 4" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player5">
                <?php if (isset($player5)) { ?>
                    <td><?php echo "Player 5" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player6">
                <?php if (isset($player6)) { ?>
                    <td><?php echo "Player 6" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player7">
                <?php if (isset($player7)) { ?>
                    <td><?php echo "Player 7" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player8">
                <?php if (isset($player8)) { ?>
                    <td><?php echo "Player 8" ?></td>
                    <td><?php echo getSkill($player->skill); ?></td>
                    <td><?php echo '$' . $player->price . "m"; ?></td>
                    <td colspan="3">
                        <a>X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="3" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>