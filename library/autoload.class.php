<?php
    final class Autoload
    {
        /**
         * The array list which contains all defined classpaths.
         * @var array
         */
        private static $_classPath = array();

        /**
         * Adds a path to the list which includes the suffixes
         * @param string $classPath  The classpath directory
         * @param string|array $fileSuffix A single or multiple file suffixes
         */
        public static function addClassPath($classPath, $fileSuffix = '.php')
        {
            if(!is_dir($classPath))
                return false;

            if(!is_array($fileSuffix))
                $fileSuffix = array($fileSuffix);

            self::$_classPath[$classPath] = $fileSuffix;
            return true;
        }

        /**
         * Autoload the class by classname, called from the SPL autoloader
         * @param  string $className The classname
         * @return void
         */
        public static function load($className)
        {
            $className = strtolower($className);

            foreach(self::$_classPath as $classPath => $classSuffix)
                foreach($classSuffix as $suffix)
                    if(file_exists($classPath . '/' . $className . $suffix))
                        require_once $classPath . '/' . $className . $suffix;
        }
    }
