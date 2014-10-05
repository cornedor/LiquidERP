<?php
    final class View
    {
        public function render($template)
        {

        }

        public function json($mixed)
        {
            echo json_encode($mixed);
        }
    }
