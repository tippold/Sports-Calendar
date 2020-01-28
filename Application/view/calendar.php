
<h1>Calendar</h1>

<h2>
    <?= $this->view_data['month'] ." ". $this->view_data['year']; ?>
</h2>

<div class="calendar_grid">
    <div class="calendar_head">Mo</div>
    <div class="calendar_head">Tue</div>
    <div class="calendar_head">Wed</div>
    <div class="calendar_head">Thu</div>
    <div class="calendar_head">Fri</div>
    <div class="calendar_head">Sat</div>
    <div class="calendar_head">Sun</div>

    <?php
        for($i = 0; $i < $this->view_data['emptyDays']; $i++)
        {
            echo '<div class="calendar_griditem"></div>';
        }

        foreach($this->view_data['days'] as $day => $events)
        {
            echo '<div class="calendar_griditem"><b>'.date('j',strtotime($day)).'</b><br>';

            foreach($events as $event)
            {
                echo '<br>'.substr_replace($event->time, "", -3).' '.$event->home_team_code.' - '.$event->away_team_code;
            }
            echo '</div>';
        }
    ?>
</div>