<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $trainingIndex = true;
    public $idpIndex = false;
    public $string;

    public function passData(){
        $this->emit('passTable', $this->string);
    }
    public function trainIndex(){
        $this->emitTo('training-show','clear');
        $this->trainingIndex = true;
        $this->idpIndex = false;
    }
    public function idpsIndex(){
        $this->trainingIndex = false;
        $this->idpIndex = true;
    }
    public function render()
    {
        return view('livewire.main');
    }
}
