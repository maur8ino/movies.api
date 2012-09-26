<?php
class JsonView extends Slim_View {
	public function render($template) {
		$app = Slim::getInstance();
		$object = $this->data['object'];
		$jsonp_callback_name =
			($app->request()->get('callback') !== null ? $app->request()->get('callback') :
				($app->request()->get('jsoncallback') !== null ? $app->request()->get('jsoncallback') : null));

		$return_string = '';
		
		if ($jsonp_callback_name !== null) {
			// jsonp callback opening
			$return_string .= urlencode($jsonp_callback_name).'(';
		}

		// Object serialization
		if (is_array($object)) {
			// Start of the json/jsonp object
			$return_string .= '{';

			// Title of the object
			$return_string .= '"'.((array_key_exists('title', $this->data) && $this->data['title'] !== '') ? urlencode($this->data['title']) : '0').'":';

			// Array
			$return_string .= '[';
		 	foreach ($object as $single_object_element) {
				$return_string .= $single_object_element->to_json();
				if ($single_object_element !== end($object)) {
					$return_string .= ', ';
				}
			}
			$return_string .= ']';
	
			// Count
			$return_string .= ((array_key_exists('include_item_count', $this->data) && $this->data['include_item_count']) ? ', "count": "'.count($object).'"' : '');

			// End of the json/jsonp object
			$return_string .= '}';
		} else {
			// Single value
			$return_string .= $object->to_json();
		}
		
		if ($jsonp_callback_name !== null) {
			// jsonp callback closing
			$return_string .= ')';
		}

		return $return_string;
	}
}