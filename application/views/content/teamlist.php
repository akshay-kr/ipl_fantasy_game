<div class="row" id="team_list">
    <div class="small-12 large-12 columns center" id="list-container">  
        <table class="small-12 large-12">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Skill</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tr id="player1">
                <?php if (isset($selected[0])) { ?>
                    <td><?php echo $selected[0]->name ?></td>
                    <td><?php echo getSkill($selected[0]->skill); ?></td>
                    <td><?php echo '$' . $selected[0]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[0]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player2">
                <?php if (isset($selected[1])) { ?>
                    <td><?php echo $selected[1]->name ?></td>
                    <td><?php echo getSkill($selected[1]->skill); ?></td>
                    <td><?php echo '$' . $selected[1]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[1]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player3">
                <?php if (isset($selected[2])) { ?>
                    <td><?php echo $selected[2]->name ?></td>
                    <td><?php echo getSkill($selected[2]->skill); ?></td>
                    <td><?php echo '$' . $selected[2]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[2]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player4">
                <?php if (isset($selected[3])) { ?>
                    <td><?php echo $selected[3]->name ?></td>
                    <td><?php echo getSkill($selected[3]->skill); ?></td>
                    <td><?php echo '$' . $selected[3]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[3]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player5">
                <?php if (isset($selected[4])) { ?>
                    <td><?php echo $selected[4]->name ?></td>
                    <td><?php echo getSkill($selected[4]->skill); ?></td>
                    <td><?php echo '$' . $selected[4]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[4]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player6">
                <?php if (isset($selected[5])) { ?>
                    <td><?php echo $selected[5]->name ?></td>
                    <td><?php echo getSkill($selected[5]->skill); ?></td>
                    <td><?php echo '$' . $selected[5]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[5]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player7">
                <?php if (isset($selected[6])) { ?>
                    <td><?php echo $selected[6]->name ?></td>
                    <td><?php echo getSkill($selected[6]->skill); ?></td>
                    <td><?php echo '$' . $selected[6]->price . "m"; ?></td>
                    <td>
                        <a class="remove" player_id="<?php echo $selected[6]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
            <tr id="player8">
                <?php if (isset($selected[7])) { ?>
                    <td><?php echo $selected[7]->name ?></td>
                    <td><?php echo getSkill($selected[7]->skill); ?></td>
                    <td><?php echo '$' . $selected[7]->price . "m"; ?></td>
                    <td >
                        <a class="remove" player_id="<?php echo $selected[7]->id ?>">X Remove</a>
                    </td>
                <?php } else { ?>
                    <td colspan="4" class="text-center">
                        Select Player
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>