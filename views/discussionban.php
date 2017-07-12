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
            echo $this->Form->label('Users to ban', 'UserNames');
            echo wrap(
                $this->Form->textBox('UserNames', array('class' => 'InputBox MultiComplete')),
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
<script>
jQuery(document).ready(function($) {
   $.fn.userTokenInput = function() {
      $(this).each(function() {
         /// Author tag token input.
           var $author = $(this);

           var author = $author.val();
           if (author && author.length) {
               author = author.split(",");
               for (i = 0; i < author.length; i++) {
                   author[i] = { id: i, name: author[i] };
               }
           } else {
               author = [];
           }

           $author.tokenInput(gdn.url('/user/tagsearch'), {
               hintText: gdn.definition("TagHint", "Start to type..."),
               tokenValue: 'name',
               searchingText: '', // search text gives flickery ux, don't like
               searchDelay: 300,
               minChars: 1,
               zindex: 9999,
               prePopulate: author,
               animateDropdown: false
           });
      });
   };

   $('.MultiComplete').userTokenInput();
});
</script>