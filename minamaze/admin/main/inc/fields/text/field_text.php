<?php
class ReduxFramework_text {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since ReduxFramework 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since ReduxFramework 1.0.0
    */
    function render() {
        echo '<fieldset id="'.$this->field['id'].'" class="redux-text-container">';
            $placeholder = (isset($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
            echo '<input type="text" id="' . $this->field['id'] . '-text" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" ' . $placeholder . 'value="' . esc_attr($this->value) . '" class="regular-text ' . $this->field['class'] . '" />';
            echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br /><span class="description">' . $this->field['desc'] . '</span>' : '';
        echo '</fieldset>';
    }
}
