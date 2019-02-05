<?php


/**
 * Class tdb_state_base
 *
 */
class tdb_state_base {
    private $state = array ();

    private $is_state_definition_locked = false;


    /**
     * we use this wp_query for all the state if we have it
     * @var WP_Query
     */
    protected $wp_query = '';

    /**
     * After this is called, we can set only existing properties - no new properties. And the set counter statrts to count the number of times a value is set.
     * This allows us to define default values for properties in the constructor of the
     * children and lock the structure in place when the constructor finishes
     * As of 18.1.2018 there is no way to unlock the state... we'll see
     */
    protected function lock_state_definition() {
        $this->is_state_definition_locked = true;
    }


//
//    public function __call($prop_name, $arguments) {
//        if (isset($this->state[$prop_name])) {
//            if (is_callable($this->state[$prop_name]['value'])) {
//                return call_user_func_array($this->state[$prop_name]['value'], $arguments);
////                print_r($arguments);
////                return $this->state[$prop_name]['value']();
//            }
//        }
//    }

    /**
     * Magic setter for properties
     * @param $prop_name
     * @param $value
     */
    public function __set($prop_name, $value) {


        if ($this->is_state_definition_locked === true) {
            // if state definition is locked:
            // - we can set an existing prop ONE TIME
            // - we cannot set new props!

            if (!isset($this->state[$prop_name])) {
                tdb_util::kill("You tried to set a new property: <strong>'$prop_name'</strong> but lock_state_definition() was already called .", debug_backtrace(), get_called_class());
                die;
            }

            $this->state[$prop_name]['set_cnt']++;

            // hard limit on set count?
            if ($this->state[$prop_name]['set_cnt'] > 1) {
                tdb_util::kill("You tried to set <strong>'$prop_name'</strong> again. We allow only one set of a property per run :) .", debug_backtrace(), get_called_class());
                die;
            }

        } else {

            $this->state[$prop_name]['set_cnt'] = 0; // do not count sets when not locked
        }


        $this->state[$prop_name]['value'] = $value;
    }


    /**
     * Magic getter for properties
     * @param $prop_name
     * @return mixed
     */
    public function __get($prop_name) {

        if (isset($this->state[$prop_name])) {
//            if (is_callable($this->state[$prop_name]['value'])) {
//                return $this->state[$prop_name]['value']();
//            }
            return $this->state[$prop_name]['value'];
        }

        // no defined state for this field, die and print a backtrace
        tdb_util::kill("Property <strong>'$prop_name'</strong> does not exists.", debug_backtrace(), get_called_class());
        die;
    }


    /**
     * WARNING: This brakes isset support for properties! Only empty works as expected
     * used by empty and isset on props
     *  - isset does not work on properties with this implementation. If the value is set but it's empty this function
     *      returns false
     * @param $prop_name
     * @return bool
     */
    public function __isset($prop_name) {
        if (isset($this->state[$prop_name]) && !empty($this->state[$prop_name]['value'])) {
            return true;
        }
        return false;
    }


    /**
     * @internal
     * @return array
     */
    public function _debug_get_state_array() {
        return $this->state;
    }


    /**
     * if we don't have any wp_query to work with, this function tells the children that we should use default values
     * @return bool
     */
    function has_wp_query() {
        if ($this->wp_query == '') {
            return false;
        }

        return true;
    }

    /**
     * @param WP_Query $wp_query
     */
    function set_wp_query($wp_query) {
        $this->wp_query = $wp_query;
    }


    /**
     * Get the current wp_query that we use
     * @return WP_Query
     */
    function get_wp_query() {
        return $this->wp_query;
    }

}