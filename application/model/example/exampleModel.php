<?php
    class ExampleModel extends Model
    {
        public function getNames()
        {
            return array('kevin', 'iemand', 'nog iemand', $this->config->application->environment);
        }
    }
