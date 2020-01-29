<div id="headerbox">
    <h1>Calendar</h1>

    <h2>
        <?= date("F", $this->view_data['keydate']) ." ". date("Y", $this->view_data['keydate']); ?>
    </h2>
    <p>
        <a href="/sportradar/calendar/show/<?=date('Y',strtotime($this->view_data['prev_month'])) ."/".date('n',strtotime($this->view_data['prev_month'])); ?>">Previous</a>
        <a href="/sportradar/calendar/show/<?=date('Y',strtotime($this->view_data['next_month'])) ."/".date('n',strtotime($this->view_data['next_month'])); ?>">Next</a>
    </p>
</div>

<div class="calendar_grid">
    <div class="calendar_head">Mo</div>
    <div class="calendar_head">Tue</div>
    <div class="calendar_head">Wed</div>
    <div class="calendar_head">Thu</div>
    <div class="calendar_head">Fri</div>
    <div class="calendar_head">Sat</div>
    <div class="calendar_head">Sun</div>

    <?php
        for($i = 0; $i < date('N',$this->view_data['keydate']) - 1; $i++)
        {
            echo '<div class="calendar_griditem"></div>';
        }

        foreach($this->view_data['days'] as $day => $events)
        {
            echo '<div class="calendar_griditem"><b>'.date('j',strtotime($day)).'</b><br>';

            foreach($events as $event)
            {
                echo '<br>'.substr_replace($event->start_time, "", -3).' '.$event->home_team_code.' - '.$event->away_team_code;
            }
            echo '</div>';
        }
    ?>
</div>

<div id="filterbox">
    <form action="/sportradar/calendar/show/<?= date('Y', $this->view_data['keydate'])."/".date('n', $this->view_data['keydate']); ?>" method="POST">
        <label for="filter">Filter:</label>
        <select id="filter" name="sport_filter" onchange="this.form.submit()">

            <option value="">-- select sport --</option>
            <option value="">ALL</option>

            <?php foreach($this->view_data['sports'] as $id => $sport) {?>

                <option value="<?=$id?>" <?php if($id == $this->view_data['sport_filter']) echo 'selected'?>><?= $sport['sport_name']; ?></option>

            <?php } ?>

        </select>
    </form>
</div>