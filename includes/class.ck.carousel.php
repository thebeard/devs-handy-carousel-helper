<?php

class CK_Carousel {

	/**
	 * Keeps track of the user-specified template folder
	 * @var string
	 */
	private $template_folder;

	/**
	 * ID/Name of carousel
	 * @var string
	 */
	private $id;

	/**
	 * Array of slides. The template file should deal with amd render the slide contents. No suggestions or format dictated for slide content. A mere array of Post ID's could be used, or nested arrays with multiplte fields per slide
	 * @var array
	 */
	private $slides;

	/**
	 * File with markup of how each slide should be rendered. Works together with contents of $slides property
	 * @var string
	 */
	private $template;

	/**
	 * Keeps track of the stylesheet directory where templates can be overridden
	 * @var string
	 */
	private $stylesheet_directory;

	/**
	 * Whether enough parameters were available and object could be constructed
	 * @var bool
	 */
	private $init;

	/**
	 * Revs up our carousel
	 * @param string 	$id              ID/Name of carousel
	 * @param array 	$slides          Array of slides. Template should deal with slide contents
	 * @param string 	$template        File with markup of how each slide should be rendered
	 * @param boolean 	$render          Whether the carousel should be rendered on construction
	 * @param string  	$template_folder The folder where template files are stored
	 */
	public function __construct( $id, $slides, $template = 'sample_slide', $render = false, $template_folder = '/templates/carousel/' ) {
		
		// Exit if enough parameters aren't available
		if ( !$id || !$slides ) {
			$this->set_init( false );
			return false;
		} else $this->set_init( true );

		// Set object properties
		$this->set_template_folder( $template_folder );
		$this->set_id( $id );
		$this->set_slides( $slides );
		$this->set_template( $template );
		$this->set_plugin_directory();
		$this->set_stylesheet_directory( get_stylesheet_directory() );

		// Render if arguments request rendering on construction
		if ( $render ) $this->render();
	}

	/**
	 * Set the ID/Name
	 * @param string $id
	 */
	private function set_id( $id ) {
		$this->id = $id;			
	}

	/**
	 * Get the ID/Name
	 * @return string
	 */
	private function get_id() {
		return $this->id;
	}

	/**
	 * Set Init Value
	 * @param bool $init
	 */
	private function set_init( $init ) {
		$this->init = $init;			
	}

	/**
	 * Get the Init Value
	 * @return bool
	 */
	private function get_init() {
		return $this->init;
	}

	/**
	 * Set the Slides array
	 * @param array $slides
	 */
	private function set_slides( $slides ) {
		$this->slides = $slides;
	}

	/**
	 * Get the slides array
	 * @return array
	 */
	private function get_slides() {
		return $this->slides;
	}

	/**
	 * Set the template file to be called
	 * @param string $template
	 */
	private function set_template( $template ) {
		$this->template = $template;
	}

	/**
	 * Get the template file to be called
	 * @return string
	 */
	private function get_template() {
		return $this->template;
	}

	/**
	 * Set the template folder where templates will be created
	 * @param string $template_folder
	 */
	private function set_template_folder( $template_folder ) {
		$this->template_folder = $template_folder;
	}

	/**
	 * Get the template folder where templates are created
	 * @return string
	 */
	private function get_template_folder() {
		return $this->template_folder;
	}

	/**
	 * Set the stylesheet directory where templates will be overridden
	 * @param string $stylesheet_dir
	 */
	private function set_stylesheet_directory( $stylesheet_dir ) {
		if ( !$stylesheet_dir ) get_stylesheet_directory_uri();
		$this->stylesheet_directory = $stylesheet_dir;
	}

	/**
	 * Get the stylesheet directory where templates will be overridden
	 * @return string
	 */
	private function get_stylesheet_directory() {
		return $this->stylesheet_directory;
	}

	/**
	 * Set the plugin directory where sample templates are stored
	 */
	private function set_plugin_directory() {
		$this->plugin_directory = dirname( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the plugin directory where sample templates are stored
	 * @return string
	 */
	private function get_plugin_directory() {
		return $this->plugin_directory;
	}

	/**
	 * Returns the templates / that can be overridden in the themes
	 * @return string
	 */
	private function locate_template( $template ) {
		$suffix = $this->get_template_folder() . $template . '.php';
		$theme_candidate = $this->get_stylesheet_directory() . $suffix;
		$plugin_candidate = $this->get_plugin_directory() . $suffix;

		if ( file_exists( $theme_candidate ) ) return $theme_candidate;
		else {
			if ( file_exists( $plugin_candidate ) ) return $plugin_candidate;
			else
				return $this->get_plugin_directory() . $this->get_template_folder() . 'sample_slide.php';
		}
	}

	/**
	 * Renders/draws/prints the carousel
	 * @return void
	 */
	public function render() {

		// Carousel wasn't constructed and render can't printed
		if( !$this->get_init() ) {
			echo "<!-- The carousel wasn't properly constructed and couldn't be rendered -->";
			return false;
		}

		// Print the carousel
		$slides = $this->get_slides();
		$slide_counter = 1;
		$carousel_id = $this->get_id();
		if ( !empty( $slides ) ) {
			$this->before_slider();
			foreach( $slides as $slide ) {
				include $this->locate_template( $this->get_template() );
				$slide_counter++;
			}
			$this->after_slider();
		}
	}

	/**
	 * Prints/returns the html before individual slides
	 * @param  boolean $echo Whether to print or return the HTML markup
	 * @return string
	 */
	private function before_slider( $echo = true ) {
		if ( ! $echo ) ob_start();
		$id = $this->get_id();
		include $this->locate_template( 'before' );
		if ( ! $echo ) return ob_get_clean();
	}

	/**
	 * Prints/returns the html after individual slides
	 * @param  boolean $echo Whether to print or return the HTML markup
	 * @return string
	 */
	private function after_slider( $echo = true ) {
		if ( ! $echo ) ob_start();
		include $this->locate_template( 'after' );	
		if ( ! $echo ) return ob_get_clean();
	}

}