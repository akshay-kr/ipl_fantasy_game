<div class="row">
    <br>
    <div id="select_name" class="small-8 large-8 columns">  
        <div class="small-5 large-5 columns">
            <?php if (isset($_SESSION['name'])) { ?>
                <input type="text" id="team_name" disabled value="<?php echo $_SESSION['name']; ?>"/>
            <?php } else { ?>
                <input type="text" id="team_name" placeholder="Enter Team Name"/>  
            <?php } ?>
        </div>

        <div class="small-2 large-2 columns">
            <?php if (isset($_SESSION['name'])) { ?>
                <input type="button" class="button radius tiny" id="editName" value="EDIT"/>
            <?php } else { ?>
                <input type="button" class="button radius tiny" id="saveName" value="SAVE"/>
            <?php } ?>
        </div>
        <div class="small-5 large-5 columns">
            &nbsp;
        </div>
    </div>
    <div class="small-1 large-1 columns"> &nbsp; </div>
    <div id="budget_container" class="small-2 large-2 columns">
        <p class="text-center">BUDGET</p>
        <p id="budget" class="text-center"><?php echo "$" . $budget . "m" ?></p>
    </div>
    <div class="small-1 large-1 columns"> &nbsp; </div>
</div>
<br>
<div class="row">
    <div class="small-6 large-6 columns">
        <div class="small-12 large-12 columns">
            <select class="text-center" id="squad">
                <option disabled selected> ------Select Squad Formation Strategy------ </option>
                <option value="1" <?php echo (isset($squad) && $squad == 1) ? "selected" : "" ?>>3 Batsmen, 1 Wicketkeeper, 2 All rounders, 2 Bowlers</option>
                <option value="2" <?php echo (isset($squad) && $squad == 2) ? "selected" : "" ?>>3 Batsmen, 1 Wicketkeeper, 1 All rounders, 3 Bowlers</option>
                <option value="3" <?php echo (isset($squad) && $squad == 3) ? "selected" : "" ?>>4 Batsmen, 1 Wicketkeeper, 1 All rounders, 2 Bowlers</option>
            </select>
        </div>
        <div id="team">
            <?php $this->load->view("content/teamlist"); ?>
        </div>
    </div><div class="small-1 large-1 columns">&nbsp;</div>

    <div id="player_list" class="small-5 large-5 columns">
        <div class="small-3 large-3 columns">
            <label for="filter">Filter</label>
        </div>
        <div class="small-7 large-7 columns">
            <select class="text-center" id="filter">
                <option value="-1" selected <?php echo (isset($_SESSION['filter']) && $_SESSION['filter'] == -1) ? "selected" : "" ?>>All</option>
                <option value="1" <?php echo (isset($_SESSION['filter']) && $_SESSION['filter'] == 1) ? "selected" : "" ?>>Batsman</option>
                <option value="2" <?php echo (isset($_SESSION['filter']) && $_SESSION['filter'] == 2) ? "selected" : "" ?>>Wicket Keeper</option>
                <option value="3" <?php echo (isset($_SESSION['filter']) && $_SESSION['filter'] == 3) ? "selected" : "" ?>>All Rounder</option>
                <option value="4" <?php echo (isset($_SESSION['filter']) && $_SESSION['filter'] == 4) ? "selected" : "" ?>>Bowler</option>
            </select>
        </div>
        <div class="small-2 large-2 columns">&nbsp;</div>
        <?php $this->load->view("content/playerlist"); ?>
    </div>
</div>

