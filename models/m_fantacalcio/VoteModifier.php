<?php

class VoteModifier extends ActiveRecord\Model
{
	static $table_name = 'vote_modifier';
	static $belongs_to = array(
		array('vote'),
		array('modifier')
	);
}