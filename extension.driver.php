<?php

	Class extension_Uploadselectboxfield extends Extension{

		public function about(){
			return array('name' => 'Field: Uploaded File Select Box',
						 'version' => '1.2',
						 'release-date' => '',
						 'author' => array('name' => 'Nick Dunn, Brendan Abbott',
										   'website' => 'http://nick-dunn.co.uk')
				 		);
		}
		
		public function getSubscribedDelegates() {
			return array(
				array(
					'page' => '/backend/',
					'delegate' => 'AdminPagePreGenerate',
					'callback' => '__appendAssets'
				),
			);
		}
		
		public function __appendAssets(&$context) {
			if(class_exists('Administration')
				&& Administration::instance() instanceof Administration
				&& Administration::instance()->Page instanceof HTMLPage
			) {
				$callback = Administration::instance()->getPageCallback();

				// Let the jQuery magic flow 
				if($context['oPage'] instanceof contentPublish) {
					Administration::instance()->Page->addStylesheetToHead(URL . '/extensions/uploadselectboxfield/assets/uploadselectboxfield.publish.css', 'screen', 100, false);
					Administration::instance()->Page->addScriptToHead(URL . '/extensions/uploadselectboxfield/assets/uploadselectboxfield.publish.js', 200, false);
				}
			}
		}

		public function uninstall(){
			Symphony::Database()->query("DROP TABLE `tbl_fields_uploadselectbox`");
		}


		public function install(){

			return Symphony::Database()->query("CREATE TABLE `tbl_fields_uploadselectbox` (
				`id` int(11) unsigned NOT NULL auto_increment,
				`field_id` int(11) unsigned NOT NULL,
				`allow_multiple_selection` enum('yes','no') NOT NULL default 'no',
				`preview_images` enum('yes','no') NOT NULL default 'no',
				`destination` varchar(255) NOT NULL,
				PRIMARY KEY  (`id`),
				UNIQUE KEY `field_id` (`field_id`)
			) TYPE=MyISAM");

		}


		public function update($previousVersion){
			## Add `preview_images` column
			if(version_compare($previousVersion, '1.2', '<')) {
				Symphony::Database()->query("ALTER TABLE `tbl_fields_uploadselectbox` 
					ADD `preview_images` enum('yes','no') NOT NULL default 'no'"
				);
			}

			return true;
		}
	}