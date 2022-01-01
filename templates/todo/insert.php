
<div class="column-responsive column-80">
    <div class="event form content">
        <?= $this->Form->create($event) ?>
        <fieldset>
            <?php
                echo $this->Form->control('title'); 
                echo $this->Form->control('description'); 
            ?>
        </fieldset>
        <?= $this->Form->button(__('submit')) ?>
        <?= $this->Form->end(); ?>
    </div>

</div>