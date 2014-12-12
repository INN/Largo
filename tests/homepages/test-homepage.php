<?php

class HomepageTest extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();
	}

	function test_largo_register_default_homepage_layouts() {
		//if series are enabled
		$GLOBALS['largo_homepage_factory'] = new HomepageLayoutFactory();
		global $largo_homepage_factory;
		of_set_option('series_enabled', 1);
		largo_register_default_homepage_layouts(); // creates $largo_homepage_factory
		$this->assertCount(5, $largo_homepage_factory->layouts, "Series enabled failed");
		// cleanup
		unset($GLOBALS['largo_homepage_factory']);
		$GLOBALS['largo_homepage_factory'] = new HomepageLayoutFactory();

		//if series are not enabled
		global $largo_homepage_factory;
		of_set_option('series_enabled', 0);
		largo_register_default_homepage_layouts(); // creates $largo_homepage_factory
		$this->assertCount(4, $largo_homepage_factory->layouts, "Series disabled failed");
		// cleanup
		unset($GLOBALS['largo_homepage_factory']);
		$GLOBALS['largo_homepage_factory'] = new HomepageLayoutFactory();
	}

	function test_largo_get_home_layouts() {
		$this->markTestIncomplete('This test has not been implemented yet.');
		
		// if series are enabled
		global $largo_homepage_factory;
		of_set_option('series_enabled', 1);
		largo_register_default_homepage_layouts(); // creates $largo_homepage_factory
		global $largo_homepage_factory;
		foreach ($largo_homepage_factory->layouts as $key => $value) {
			assertInternalType('class', $value);
		}
		// cleanup
		unset($largo_homepage_factory);
		$GLOBALS['largo_homepage_factory'] = new HomepageLayoutFactory();

		// if series are not enabled
		global $largo_homepage_factory;
		of_set_option('series_enabled', 0);
		largo_register_default_homepage_layouts(); // creates $largo_homepage_factory
		global $largo_homepage_factory;
		foreach ($largo_homepage_factory->layouts as $key => $value) {
			assertInternalType('class', $value);
		}
		// cleanup
		unset($largo_homepage_factory);
		$GLOBALS['largo_homepage_factory'] = new HomepageLayoutFactory();
	}

	function test_largo_get_home_thumb() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_render_homepage_layout() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_get_active_homepage_layout() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_single_top() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_featured_stories() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_series_stories_data() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_series_stories_term() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_series_stories() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	function test_largo_home_get_single_featured_and_series() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}
}
