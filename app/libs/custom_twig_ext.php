<?php
namespace slimSMT\libs;
use Slim\Views;

class CustomTwigExt extends \Twig_Extension
{

 /* This must be unique name, acting as an ID for extension, else it overrides the ones that have the same name */
 public function getName()
    {
        return 'custom';
    }

  public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('sayHello', array($this, 'say_hello')),
            new \Twig_SimpleFunction('getPermalink', array($this, 'get_permalink')),
        );
    }

    public function say_hello()
    {
        return 'Helloooo !';
    }

    public function get_permalink($title = '', $author_name = '', $year = ''){
		$url = $title.'-'.$author_name.'-'.$year;
		return normalize($url);
    }


}