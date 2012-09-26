<?php

class Team extends ActiveRecord\Model
{
	static $has_many = array(
		array('players'),
		array('matches')
	);
	static $belongs_to = array(
		array('field', 'foreign_key' => 'preferred_field_id')
	);
}