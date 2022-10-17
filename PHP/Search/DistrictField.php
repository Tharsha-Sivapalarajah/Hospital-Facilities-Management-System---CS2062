<?php

require_once 'Detail.php';
require_once 'SearchField.php';


class DistrictField extends SearchField
{
    private array $districts;
    
    public function __construct(Detail $detail)
    {
        parent::__construct($detail);
        $this->districts = array();
        $this->putData($this->detail);
        $this->buildField();
    }
    
    protected function putData(Detail $detail):void
    {
        $this->districts = $detail->getDistrictList();
    }

    private function buildField():string
    {
        $divs = "";
        foreach ($this->districts as $key => $district) {
            $divs .= $this->buildDiv($district, $key+1);
        }

        $outputDiv = $this->startingHTML . $divs ."</div>
        <div class=\"selected dis-selected\">Select District Category</div>" .$this->endingHTML;

        $this->html = $outputDiv;
        return $outputDiv;
    }

    private function buildDiv($district, $key):string
    {
        $indivualDiv = "
        <div class=\"option dis-option\">
            <input value=\"". $district ."\" name='district' type=\"radio\" id=\"dis".$key."\" />
            <label for=\"dis".$key."\">".$district."</label>
        </div>";

        return $indivualDiv;
    }

    public function getHtml():string 
    {
        return $this->html;
    }
}

?>