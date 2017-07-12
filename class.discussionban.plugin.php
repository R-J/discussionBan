<?php
/**
 * An example plugin.
 *
 * @copyright 2008-2014 Vanilla Forums, Inc.
 * @license GNU GPLv2
 */

// Define the plugin:
$PluginInfo['discussionBan'] = array(
    'Description' => 'Grants moderators or permissioned users ability to ban users from specific discussions',
    'Version' => '1.1',
    'RequiredApplications' => array('Vanilla' => '2.1'),
    'RequiredTheme' => false,
    'RequiredPlugins' => false,
    'HasLocale' => false,
    'License' => 'GNU GPL2',
    'SettingsUrl' => '/plugin/example',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'Author' => "Mike Olson",
    'AuthorUrl' => 'http://www.vanillaforums.com'
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

    public function pluginConttroller_discussionBan_create($sender) {
        $sender->render('discussionban', '', 'plugins/discussionBan');
    }
}
