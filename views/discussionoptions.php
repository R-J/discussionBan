<?php if (!defined('APPLICATION')) exit(); ?>
<h1><?php echo $this->Data('Title') ?></h1>
<div class="">
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>

<div class="P">
   <?php

    echo '<div class="P">';
    echo $this->Form->label('BanUser', 'Ban Users');
    echo wrap($this->Form->textBox('To', array('MultiLine' => true, 'class' => 'MultiComplete')), 'div', array('class' => 'TextBoxWrapper'));
    echo '</div>';

   ?>
</div>
   
<?php
echo '<div class="Buttons Buttons-Confirm">', 
   $this->Form->Button(T('OK')), ' ',
   $this->Form->Button(T('Cancel'), array('type' => 'button', 'class' => 'Button Close')),
   '</div>';
echo $this->Form->Close();
?>
</div>