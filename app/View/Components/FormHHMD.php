<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormHHMD extends Component
{

    public $formType;
    /**
     * Create a new component instance.
     */
    public function __construct($formType = 'kedatangan')
    {
        $this->formType = $formType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        switch ($this->formType) {
            case 'kedatangan':
                return view('components.form-hhmdkedatangan');
            case 'hbscp':
                return view('components.form-hhmdhbscp');
            case 'posbarat':
                return view('components.form-hhmdposbarat');
            case 'postimur':
                return view('components.form-hhmdpostimur');
            case 'pscpselatan':
                return view('components.form-hhmdpscpselatan');
            case 'pscputara':
                return view('components.form-hhmdpscputara');
            default:
                return view('components.form-hhmdkedatangan');
        }
    }
}
