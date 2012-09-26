<?php

class Player extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('team')
	);
}