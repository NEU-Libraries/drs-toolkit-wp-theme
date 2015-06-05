<?php
class ReduxFramework_radio extends ReduxFramework{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since ReduxFramework 1.0.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
        if( !empty( $this->field['data'] ) && empty( $this->field['options'] ) ) {
			if (empty($this->field['args'])) {
				$this->field['args'] = array();
			}        	
        	$this->field['options'] = $parent->get_wordpress_data($this->field['data'], $this->field['args']);
        }

	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since ReduxFramework 1.0.0
	*/
	function render(){
		
		echo '<fieldset id="'.$this->field['id'].'" class="redux-radio-container">';
		
			if (!empty($this->field['options'])) {

				echo '<ul>';
				
				foreach($this->field['options'] as $k => $v){
					
					echo '<li>';
					echo '<label for="'.$this->field['id'].'_'.array_search($k,array_keys($this->field['options'])).'">';
					echo '<input type="radio" class="radio' . $this->field['class'] . '" id="'.$this->field['id'].'_'.array_search($k,array_keys($this->field['options'])).'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.$k.'" '.checked($this->value, $k, false).'/>';
					echo ' <span>'.$v.'</span>';
					echo '</label>';
					echo '</li>';
					
				}//foreach
					
				echo '</ul>';		

			}

		echo '</fieldset>';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<div class="description">'.$this->field['desc'].'</div>':'';
		
	}//function
	
}//class