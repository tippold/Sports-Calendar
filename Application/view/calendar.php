
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

        for($i = 1; $i <= $this->view_data['numberOfDays']; $i++)
        {
            echo '<div class="calendar_griditem"><b>'.$i.'</b>';

            if(true)
            {

            }

            echo '</div>';
        }
    ?>

</div>