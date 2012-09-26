<?php

class Vote extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('player'),
		array('match')
	);
	static $has_many = array(
		array('vote_modifier'),
 		array('modifiers', 'through' => 'vote_modifier')
	);
}