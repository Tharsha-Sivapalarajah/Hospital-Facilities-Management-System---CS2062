<?php

require_once 'Detail.php';
require_once 'SearchField.php';


class HospitalField extends SearchField
{
    private array $hospitals;
    
    public function __construct(Detail $detail)
    {
        parent::__construct($detail);
        $this->hospitals = array();
        $this->putData($this->detail);
        $this->buildField();
    }
    
    protected function putData(Detail $detail):void
    {
        $this->hospitals = $detail->getHospitalList();
    }

    private function buildField():string
    {
        $divs = "";
        foreach ($this->hospitals as $key => $hospital) {
            $divs .= $this->buildDiv($hospital, $key+1);
        }

        $outputDiv = $this->startingHTML . $divs ."</div>
        <div class=\"selected hos-selected\">Select Hospital Category</div>" .$this->endingHTML;

        $this->html = $outputDiv;
        return $outputDiv;
    }

    private function buildDiv($hospital, $key):string
    {
        $indivualDiv = "
        <div class=\"option hos-option ".$hospital[1]."\">
            <input type=\"radio\" id=\"hos".$key."\" />
            <label for=\"hos".$key."\">".$hospital[0]."</label>
        </div>";

        return $indivualDiv;
    }

    public function getHtml():string 
    {
        return $this->html;
    }
}

?>