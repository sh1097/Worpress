<?php

namespace ElementinvaderAddonsForElementor\Widgets;

use ElementinvaderAddonsForElementor\Core\Elementinvader_Base;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Typography;
use Elementor\Editor;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use ElementinvaderAddonsForElementor\Modules\Forms\Ajax_Handler;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class EliBlog_Preview_Content extends Elementinvader_Base {

    // Default widget settings
    public $defaults = array();
    public $view_folder = 'blog_preview';
    public $items_num = 0;

    public function __construct($data = array(), $args = null) {
        wp_enqueue_style('eli-main', plugins_url('/assets/css/main.css', ELEMENTINVADER_ADDONS_FOR_ELEMENTOR__FILE__));
        parent::__construct($data, $args);
    }

    /**
     * Retrieve the widget name.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'eli-blog-preview-content';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Eli Blog Preview Content', 'elementinvader-addons-for-elementor');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-text-align-justify';
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function register_controls() {
      
        /* TAB_STYLE */

		$this->start_controls_section(
			'config',
			[
				'label' => __( 'Config', 'elementinvader-addons-for-elementor' ),
			]
		);


        $this->end_controls_section();

        /* TAB_STYLE */

        $items = [
            [
                'key'=>'styles_content',
                'label'=> esc_html__('Styles', 'wpdirectorykit'),
                'selector_hide'=>'',
                'selector'=>'{{WRAPPER}} .eli_blog_preview_content',
                'selector_hover'=>'{{WRAPPER}} .eli_blog_preview_content:hover',
                'selector_focus'=>'',
                'options'=>'full',
            ]
        ];

        foreach ($items as $item) {
            $this->start_controls_section(
                $item['key'].'_section',
                [
                    'label' => $item['label'],
                    'tab' => 'tab_layout'
                ]
            );

            if(!empty($item['selector_hide'])) {
                $this->add_responsive_control(
                    $item['key'].'_hide',
                    [
                        'label' => esc_html__( 'Hide Element', 'wdk-svg-map' ),
                        'type' => Controls_Manager::SWITCHER,
                        'none' => esc_html__( 'Hide', 'wdk-svg-map' ),
                        'block' => esc_html__( 'Show', 'wdk-svg-map' ),
                        'return_value' =>  'none',
                        'default' => ($item['key'] == 'field_button_reset' ) ? 'none':'',
                        'selectors' => [
                            $item['selector_hide'] => 'display: {{VALUE}};',
                        ],
                    ]
                );
            }

            $selectors = array();

            if(!empty($item['selector']))
                $selectors['normal'] = $item['selector'];

            if(!empty($item['selector_hover']))
                $selectors['hover'] = $item['selector_hover'];

            if(!empty($item['selector_focus']))
                $selectors['focus'] = $item['selector_hover'];
                
            $this->generate_renders_tabs($selectors, $item['key'].'_dynamic', $item['options']);

            $this->end_controls_section();
            /* END special for some elements */
        }

        parent::register_controls();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function render() {
        parent::render();

        $id_int = substr($this->get_id_int(), 0, 3);
        $settings = $this->get_settings();
        global $eli_post_id;
        $args = array();

        $object = ['eli_post_id'=>$eli_post_id, 'settings'=>$settings,'id_int'=>$id_int];
                
        $object['is_edit_mode'] = false;          
        if(Plugin::$instance->editor->is_edit_mode())
            $object['is_edit_mode'] = true;
      
        echo $this->view('content', $object); 
    }

	public static function ma_el_get_post_types()
	{
		$post_type_args = array(
			'public'            => true,
			'show_in_nav_menus' => true
		);

		$post_types = get_post_types($post_type_args, 'objects');
		$post_lists = array();
		foreach ($post_types as $post_type) {
			$post_lists[$post_type->name] = $post_type->labels->singular_name;
		}
		return $post_lists;
	}
}
