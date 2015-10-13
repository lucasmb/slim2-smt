<?php
namespace slimSMT\models;
use League\Monga;
 
class Base_Model
{
    public $app;
    public $collection;

    public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		$this->collection = $this->app->db->collection('books');
	}

	public function say_hi($name)
    {
        return sprintf('hello %s This message is from the base model', $name);
    }

