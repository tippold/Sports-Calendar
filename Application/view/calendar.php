

<div id="headerbox">
    <h1><?= date("F", $this->view_data['keydate']) ." ". date("Y", $this->view_data['keydate']); ?></h1>
</div>

<div class="month_nav">
    <a href="/sportradar/calendar/show/<?=date('Y',strtotime($this->view_data['prev_month'])) ."/".date('n',strtotime($this->view_data['prev_month'])); ?>">
        <i class="fas fa-chevron-left"></i><?php echo ' ' .date('F',strtotime($this->view_data['prev_month'])) . ' ' . date('Y',strtotime($this->view_data['prev_month'])); ?>
    </a>

    <div id="filterbox">
        <form action="/sportradar/calendar/show/<?= date('Y', $this->view_data['keydate'])."/".date('n', $this->view_data['keydate']); ?>" method="POST">
            <label for="filter">Filter:</label>
            <select id="filter" name="sport_filter" onchange="this.form.submit()">
                <option value="">-- select sport --</option>
                <option value="">ALL</option>
                <?php foreach($this->view_data['sports'] as $id => $sport) {?><option value="<?=$id?>" <?php if($id == $this->view_data['sport_filter']) echo 'selected'?>><?= $sport['sport_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </form>
    </div>

    <a href="/sportradar/calendar/show/<?=date('Y',strtotime($this->view_data['next_month'])) ."/".date('n',strtotime($this->view_data['next_month'])); ?>">
        <?php echo date('F',strtotime($this->view_data['next_month'])) . ' ' . date('Y',strtotime($this->view_data['next_month'])) . ' ';?><i class="fas fa-chevron-right"></i>
    </a>
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
            echo '<div class="calendar_griditem griditem_empty"></div>';
        }

        foreach($this->view_data['days'] as $day => $events)
        {
            echo '<div class="calendar_griditem"><b>'.date('j',strtotime($day)).'</b>';

            foreach($events as $event)
            {
                echo '<div class="event_listing">';
                    echo '<div class="event_time">' . substr_replace($event->start_time, "", -3) . '</div>';
                    echo '<div class="event_teams">' . $event->home_team_code.' - '.$event->away_team_code . '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    ?>
</div>