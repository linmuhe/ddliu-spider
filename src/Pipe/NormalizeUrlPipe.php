<?php
/**
 * spider
 * @copyright 2014 Liu Dong <ddliuhb@gmail.com>
 * @license MIT
 */

namespace ddliu\spider\Pipe;
use ddliu\normurl\Url;

class NormalizeUrlPipe extends BasePipe {
    public function __construct($options = array()) {
        $this->options = $options;
    }

    public function run($spider, $task) {
        $url = $task['url'];
        $base = ($task->parent && !empty($task->parent['url']))?$task->parent['url']:null;
        $url = Url::normalize($url, $base);
        if (!$url) {
            throw new PipeException('Normalize url failed: '.$task['url']);
        }

        $task['url'] = $url;
    }
}