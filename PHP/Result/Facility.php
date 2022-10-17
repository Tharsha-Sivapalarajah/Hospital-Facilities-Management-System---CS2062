<?php


class Facility
{
    private $name;
    private $eTime;
    private $sTime;
    private $className;

    function __construct($name)
    {
        $this->name = $name;
        $this->setClassName($this->name);
    }

    private function setClassName(string $name):void
    {
        $name = strtolower($name);
        $name = trim($name);
        str_replace(' ','-',$name);
        $this->className = $name;
    }

    public function setStartTime($sTime)
    {
        $this->sTime = $sTime;
    }

    public function setEndTime($eTime)
    {
        $this->eTime = $eTime;
    }

    public function getStartTime()
    {
        return $this->sTime;
    }

    public function getEndTime()
    {
        return $this->eTime;
    }

    public function getTime():string
    {
        return $this->convertTimeToString(explode(":",$this->sTime))." - ".$this->convertTimeToString(explode(":",$this->eTime));
    }

    private function convertTimeToString(array $time):string
    {
        $hour = (int)($time[0]);
        $min = (int)($time[1]);
        $id = "a.m";
        if($hour>12){
            $hour-=12;
            $id = "p.m";
        }elseif($hour ==12 and $min>=0){
            $id="p.m";
        }

        $output = "{$hour}.{$min} {$id}";

        return $output;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getClassName() 
    {
        return $this->className;
    }
}
?>