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
                'Url' => '/plugin/discussionBan/'.$args['Discussion']->DiscussionID,
                'Class' => 'Popup'
            );
            /*
            $args['DiscussionOptions']['discussionBan'] = [
                'Label' => t('Ban User from Discussion'),
                'Url' => '/plugin/discussionBan/'.$args['Discussion']->DiscussionID,
                'Class' => 'Popup'
            ];
            */
        }
    }

    public function pluginController_discussionBan_create($sender) {
        $sender->render('discussionban', '', 'plugins/discussionBan');
    }
}
