<?php
/**
 * spider
 * @copyright 2014 Liu Dong <ddliuhb@gmail.com>
 * @license MIT
 */

namespace ddliu\spider\Pipe;

/**
 * Ingore duplicate tasks.
 */
class UniquePipe extends BasePipe {
    protected $keys = array();
    public function __construct($key = 'url') {
        $this->key = $key;
    }

    public function run($spider, $task) {
        $id = $task[$this->key];
        if (isset($this->keys[$id])) {
            $task->ignore();
        } else {
            $this->keys[$id] = true;
        }
    }
}