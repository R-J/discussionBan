<?php if (!defined('APPLICATION')) exit(); ?>
<h1><?php echo $this->data('Title') ?></h1>
<div class="FormWrapper DiscussionBan">
    <?php
    echo $this->Form->open();
    echo $this->Form->errors();
    ?>

    <ul>
        <li>
            <?php
            echo $this->Form->label('Ban User', 'BanUser');
            echo wrap(
                $this->Form->textBox('BanUser', array('class' => 'InputBox MultiComplete')),
                'div',
                array('class' => 'TextBoxWrapper')
            );
            ?>
        </li>
    </ul>

    <?php
    echo $this->Form->close('Ban Users');
    ?>
</div>
