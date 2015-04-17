<div class="row">
    <br>
    <div id="select_name" class="small-8 large-8 columns">  
        <div class="small-5 large-5 columns">
            <input type="text" id="team_name" placeholder="Enter Team Name"/>  
        </div>
        <div class="small-2 large-2 columns">
            <input type="button" class="button radius tiny" id="check_avaibility" value="CHECK AVAIBILITY"/>
        </div>
        <div class="small-5 large-5 columns">
            &nbsp;
        </div>
    </div>
    <div class="small-1 large-1 columns"> &nbsp; </div>
    <div id="budget_container" class="small-2 large-2 columns">
        <p class="text-center">BUDGET</p>
        <p class="text-center"><?php echo "$100m" ?></p>
    </div>
    <div class="small-1 large-1 columns"> &nbsp; </div>
</div>
<br>
<div class="row">
    <div class="small-6 large-6 columns">
        <div class="small-12 large-12 columns">
            <select class="text-center" name="squad" id="squad">
                <option disabled selected> ------Select Squad Formation Strategy------ </option>
                <option value="1">3 Batsmen, 1 Wicketkeeper, 2 All rounders, 2 Bowlers</option>
                <option value="2">3 Batsmen, 1 Wicketkeeper, 1 All rounders, 3 Bowlers</option>
                <option value="3">4 Batsmen, 1 Wicketkeeper, 1 All rounders, 2 Bowlers</option>
            </select>
        </div>
        <div id="team">
            <?php $this->load->view("content/teamlist"); ?>
        </div>
    </div><div class="small-1 large-1 columns">&nbsp;</div>

    <div id="player_list" class="small-5 large-5 columns">
        <?php $this->load->view("content/playerlist"); ?>
    </div>
</div>

