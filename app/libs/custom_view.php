<?php
namespace slimSMT\libs;
use Slim\Views;

class CustomView extends Views\Twig
{
	public static $default_vars = array(
		'title'              => 'Slim App',
		'keywords'           => '',
		'js'                 => '',
		'css'                => '',
	);

	//protected $layoutFile = 'layouts/main_layout.php';
	
	public function __construct()
	{
		parent::__construct();
	}

	public static function addCss($css)
	{
        if(strpos($css, 'http') === false)
            $css = 'url' . $css;
		self::$default_vars['css'][] = $css;

	}

	public static function addJs($js)
	{
        if(strpos($js, 'http') === false)
            $js = 'url' . $js;
		self::$default_vars['js'][] = $js;

	}

	public function render($template, $data = NULL ) 
	{
		$view_data = self::$default_vars;
		if( !(empty($data)) && is_array($data) )
			$view_data = array_merge($view_data, $data );
		
		return parent::render($template, $view_data);
	}


}
