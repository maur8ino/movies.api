<?php

class Modifier extends ActiveRecord\Model
{
	static $has_many = array(
		array('vote_modifier'),
 		array('votes', 'through' => 'vote_modifier')
	);
}