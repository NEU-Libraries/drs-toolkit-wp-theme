<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Multi_Text
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_multi_text' ) ) {

    /**
     * Main ReduxFramework_multi_text class
     *
     * @since       1.0.0
     */
    class ReduxFramework_multi_text extends ReduxFramework {
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function __construct( $field = array(), $value ='', $parent ) {
        
            parent::__construct( $parent->sections, $parent->args, $parent->extra_tabs );

            $this->field = $field;
            $this->value = $value;
        
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            echo '<fieldset id="'.$this->field['id'].'" class="redux-multi-text-container">';

                echo '<ul id="' . $this->field['id'] . '-ul" class="redux-multi-text">';
            
                    if( isset( $this->value ) && is_array( $this->value ) ) {
                        foreach( $this->value as $k => $value ) {
                            if( $value != '' )
                                echo '<li><input type="text" id="' . $this->field['id'] . '-' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="' . esc_attr( $value ) . '" class="regular-text ' . $this->field['class'] . '" /> <a href="javascript:void(0);" class="deletion redux-multi-text-remove">' . __( 'Remove', 'redux-framework' ) . '</a></li>';
                        }
                    } else {
                        echo '<li><input type="text" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="" class="regular-text ' . $this->field['class'] . '" /> <a href="javascript:void(0);" class="button redux-multi-text-remove">' . __( 'Remove', 'redux-framework' ) . '</a></li>';
                    }
                
                    echo '<li style="display:none;"><input type="text" id="' . $this->field['id'] . '" name="" value="" class="" /> <a href="javascript:void(0);" class="redux-multi-text-remove">' . __( 'Remove', 'redux-framework') . '</a></li>';

                echo '</ul>';
            
                echo '<a href="javascript:void(0);" class="button redux-multi-text-add" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]">' . __( 'Add More', 'redux-framework') . '</a><br/>';
                echo ( isset( $this->field['desc'] ) && !empty( $this->field['desc'] ) ) ? '<div class="description">' . $this->field['desc'] . '</div>' : '';
            echo '</fieldset>';
        }   

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
        
            wp_enqueue_script(
                'redux-field-multi-text-js', 
                REDUX_URL . 'inc/fields/multi_text/field_multi_text.min.js', 
                array( 'jquery' ),
                time(),
                true
            );

			wp_enqueue_style(
				'redux-field-multi-text-css', 
				REDUX_URL.'inc/fields/multi_text/field_multi_text.css', 
				time(),
				true
			);            
        
        }
    }   
}