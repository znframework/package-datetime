<?php namespace ZN\DateTime;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;

class DT
{
    /**
     * Protected class
     * 
     * @var string
     */
    protected $class;

    /**
     * Magic Call
     * 
     * @param string $method
     * @param string $parameters
     * 
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->data = $this->class->$method($this->data, ...$parameters);

        return $this;
    }
 
    /**
     * Get ZN\DateTime\Date class
     * 
     * @param string $data
     * 
     * @return DT
     */
    public function date(String $data, $class = 'Date')
    {
        $this->class = Singleton::class('ZN\DateTime\\' . $class);
        $this->data  = $data;
        
        return $this;
    }   

    /**
     * Get ZN\DateTime\Time class
     * 
     * @param string $data
     * 
     * @return DT
     */
    public function time(String $data)
    {
        return $this->date($data, 'Time');
    }   

    /**
     * Apply changes
     * 
     * @return mixed
     */
    public function get(String $output = NULL)
    {
        if( $output !== NULL )
        {
            return $this->class->convert($this->data, $output); 
        }

        return $this->data ?? false;
    }
}
