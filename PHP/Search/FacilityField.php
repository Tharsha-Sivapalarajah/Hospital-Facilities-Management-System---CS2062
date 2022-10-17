<?php

require_once 'Detail.php';
require_once 'SearchField.php';


class FacilityField extends SearchField
{
    private array $facilities;
    
    public function __construct(Detail $detail)
    {
        parent::__construct($detail);
        $this->facilities = array();
        $this->putData($this->detail);
        $this->buildField();
    }
    
    protected function putData(Detail $detail):void
    {
        $this->facilities = $detail->getFacilityList();
    }

    private function buildField():string
    {
        $divs = "";
        foreach ($this->facilities as $key => $facility) {
            $divs .= $this->buildDiv($facility, $key+1);
        }

        $outputDiv = $this->startingHTML . $divs ."</div>
        <div class=\"selected fac-selected\">Select Facility Category</div>" .$this->endingHTML;

        $this->html = $outputDiv;
        return $outputDiv;
    }

    private function buildDiv($facility, $key):string
    {
        $indivualDiv = "
        <div class=\"option fac-option\">
            <input type=\"radio\" id=\"fac".$key."\" />
            <label for=\"fac".$key."\">".$facility."</label>
        </div>";

        return $indivualDiv;
    }

    public function getHtml():string 
    {
        return $this->html;
    }
}

?>