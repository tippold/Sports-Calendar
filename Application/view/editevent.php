<h1><?php echo !empty($this->view_data['event']) ? 'Edit Event' : 'Add Event'; ?></h1>

<div id="editform">
<form action="/sportradar/event/edit/" method="POST">
    <?php
        if(!empty($this->view_data['event']))
        {
            echo '<input type="hidden" name="editevent" value="'.$this->view_data['event']->getId().'">';
        } else {
            echo '<input type="hidden" name="addevent" value="">';
        }
    ?>

    <label for="date">Date: </label>
    <input id="date" type="date" name="date" <?php if(!empty($this->view_data['event'])) echo ' value="'.$this->view_data['event']->date.'"'?>><br>

    <label for="start_time">Time: </label>
    <input id="start_time" type="time" name="start_time" <?php if(!empty($this->view_data['event'])) echo ' value="'.substr_replace($this->view_data['event']->start_time,"","-3").'"'?>><br>

    <label for="home_team">Home Team:</label>
    <select id="home_team" name="home_team_id">
        <option value = "0">-- select Home team</option>
        <?php
            foreach($this->view_data['teams'] as $id => $team)
            {
                $selected = !empty($this->view_data['event']) && $this->view_data['event'] ->home_team_name == $team['team_name'] ? 'selected' : '';
                echo '<option value="'.$id.'" '.$selected.'>'.$team['team_name'].'</option>';
            }
        ?>
    </select><br>

    <label for="away_team">Away Team:</label>
    <select id="away_team" name="away_team_id">
        <option value="0">-- select Away team</option>
        <?php
            foreach($this->view_data['teams'] as $id => $team)
            {
                $selected = !empty($this->view_data['event']) && $this->view_data['event'] ->away_team_name == $team['team_name'] ? 'selected' : '';
                echo '<option value="'.$id.'" '.$selected.'>'.$team['team_name'].'</option>';
            }
        ?>
    </select><br>

    <label for="sport">Sport:</label>
    <select id="sport"  name="sport_id">
        <option value="0">-- select Sport</option>
        <?php
            foreach($this->view_data['sports'] as $id => $sport)
            {
                $selected = !empty($this->view_data['event']) && $this->view_data['event']->sport_name == $sport['sport_name'] ? 'selected' : '';
                echo '<option value="'.$id.'" '.$selected.'>'.$sport['sport_name'].'</option>';
            }
        ?>
    </select><br>

    <input type="submit" value="<?php echo !empty($this->view_data['event']) ? 'Update' : 'Save'; ?>">
</form>
</div>