<?php

class Field extends ActiveRecord\Model
{
	static $has_many = array(
		array('teams', 'foreign_key' => 'preferred_field_id')
	);
}