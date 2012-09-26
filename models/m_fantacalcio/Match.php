<?php

class Match extends ActiveRecord\Model
{
	static $table_name = 'matches';
	static $belongs_to = array(
		array('first_team', 'foreign_key' => 'first_team_id', 'class_name' => 'Team'),
		array('second_team', 'foreign_key' => 'second_team_id', 'class_name' => 'Team'),
		array('field'),
		array('weather')
	);
	static $has_many = array(
		array('votes')
	);
}