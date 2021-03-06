<?php
// Define the plugin:
$PluginInfo['discussionBan'] = array(
    'Name' => 'Discussion Ban',
    'Description' => 'Grants moderators or permissioned users ability to ban users from specific discussions',
    'Version' => '1.1',
    'RequiredApplications' => array('Vanilla' => '>=2.3'),
    'RequiredTheme' => false,
    'RequiredPlugins' => false,
    'HasLocale' => true,
    'License' => 'GNU GPL2',
    'Author' => "Mike Olson",
    'AuthorUrl' => 'https://open.vanillaforums.com/profile/MikeOlson'
);

/**
 * Class DiscussionBanPlugin
 *
 * @see http://docs.vanillaforums.com/developers/plugins
 * @see http://docs.vanillaforums.com/developers/plugins/quickstart
 */
class DiscussionBanPlugin extends Gdn_Plugin {
    public function base_discussionOptions_handler($sender, $args) {
        // If user hasn't moderator permissions, we do not want to edit anything.
        if (!Gdn::session()->checkPermission('Garden.Moderation.Manage')) {
            return;
        }
        if (isset($args['DiscussionOptions'])) {
            $args['DiscussionOptions']['discussionBan'] = array(
                'Label' => t('Ban Users From This Discussion'),
                'Url' => url('vanilla/discussionban/'.$args['Discussion']->DiscussionID),
                'Class' => 'Popup'
            );
        }
    }

    /**
     * Add autocomplete.js to every page.
     *
     * @param GardenController $sender Instance of the calling class.
     *
     * @return void.
     */
    public function base_render_before($sender) {
        $sender->addJsFile('jquery.tokeninput.js');
    }

    /**
     * Show ban user form and save results to discussion attributes.
     *
     * @param PluginController $sender Instance of the calling class
     *
     * @return void.
     */
    public function vanillaController_discussionBan_create($sender) {
        $sender->Form = new Gdn_Form();
        $sender->setData('Title', t('Ban Users From This Discussion'));

        if ($sender->Form->authenticatedPostBack() == false) {
            // This will be run when the view is opened
            $sender->Form->setValue('UserNames', 'Hello World');
        } else {
            // This will only be run when the user pressed the button.
            $sender->informMessage(t('Your changes have been saved.'));
        }
        $sender->render('discussionban', '', 'plugins/discussionBan');
    }
}
