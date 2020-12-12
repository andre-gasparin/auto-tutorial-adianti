<?php
    /**
     * Por: André Gasparin
     */
class AutoTutorial
{
    private $header; 
    private $steps = array(); 
    private $id;
      

    public function __construct()
    {
        $this->id = uniqid();
        $this->header = "function tutorial".$this->id."(){ const con".$this->id." = new Driver( {   animate: false, doneBtnText: 'Concluir', closeBtnText: 'Fechar', nextBtnText: 'Próximo',  prevBtnText: 'Anterior'} ); con".$this->id.".defineSteps([ ";
    }

    public function setStepsArray( $steps )
    {
        foreach($steps as $key=>$step )
        {
            $this->setStep($step, $key);
        }
    }

    public function setStep($step, $key)
    {
        foreach($step as $item => $value )
        {
            $this->steps[$key][$item] = $value;
        }
        $this->createStep($key);
    }

    private function createStep($key)
    {
        $selector = $this->createElement($this->steps[$key]['selector'], $this->steps[$key]['selector_type']);
        $position = isset($this->steps[$key]['position'])   == null ? 'bottom-center' : $this->steps[$key]['position'];
        $onNext =   isset($this->steps[$key]['onNextPage']) == null ? null : ' onNext: () => { __adianti_load_page(\''.$this->steps[$key]['onNextPage'].'\');}';

        $this->steps[$key]['content'] = " {";
        $this->steps[$key]['content'] .= " element: '".$selector."',";
        $this->steps[$key]['content'] .= " popover: {";
        $this->steps[$key]['content'] .= " className: 'first-step-popover-class',";
        $this->steps[$key]['content'] .= " title: '".$this->steps[$key]['title']."',";
        $this->steps[$key]['content'] .= " description: '".$this->steps[$key]['description']."',";
        $this->steps[$key]['content'] .= " position: '".$position."'";
        $this->steps[$key]['content'] .= " },";
        $this->steps[$key]['content'] .= $onNext;
        $this->steps[$key]['content'] .= " },";      

    }

    private function createElement($selector, $selector_type)
    {
        if($selector_type == 'id')
            $string_selector = '#'.$selector;
        elseif($selector_type == 'class')
            $string_selector = '.'.$selector;
        else
            $string_selector = '['. $selector_type.'="'.$selector.'"]';

        return $string_selector;
    }


    public function run($debug = false)
    {
        $js  = $this->header;
        $js .= $this->runSteps();
        $js .=  ' ]); ';
        $js .=  'con'.$this->id.'.start(); ';
        $js .=  ' }';
        $js .=  ' $( document ).ready(function() { ';
        $js .=  ' tutorial'.$this->id.'(); ';
        $js .=  ' });';

        TScript::create($js);
        echo "<style> .driver-highlighted-element { z-index: 100004 !important;   pointer-events: none !important;   }  </style>";
        if($debug == true) echo 'JS: <pre>'.$js.'</pre>';
    }

    private function runSteps()
    {
        $js = '';
        foreach($this->steps as $key => $value){
            $js .= ' '.$this->steps[$key]['content'];
        }
        return $js;
    }

    public function debug()
    {
        echo '<pre>';
        print_r($this->steps);
        echo '</pre>';
    }

}