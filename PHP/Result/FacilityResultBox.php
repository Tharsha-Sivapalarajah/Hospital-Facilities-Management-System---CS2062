<?php
class FacilityResultBox
{
    private Facility $facility;
    public function __construct(Facility $facility)
    {
        $this->facility = $facility;
    }

    public function getDiv():string
    {
        return $this->buildHTML();
    }

    private function buildHTML():string
    {
        $div = "<div class=\"facility ".$this->facility->getClassName()."\">\n
            <h3>".$this->facility->getName()."</h3>\n
            <div class=\"time facility-content\">\n
                <div class=\"facility-content-heading\">TIME</div>\n
                <div class=\"fac-time facility-content-detail\">".$this->facility->getTime()."</div>\n
            </div>\n
            <div class=\"notify-me\" id=\"no-".$this->facility->getClassName()."\">notify me</div>
        </div>\n";

        return $div;
    }
}

?>