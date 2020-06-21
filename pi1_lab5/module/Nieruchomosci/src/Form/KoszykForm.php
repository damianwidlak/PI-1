<?php

namespace Nieruchomosci\Form;

use Laminas\Form\Form;

class KoszykForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('koszyk');

        $this->setAttribute('method', 'get');
        $this->add([
            'name' => 'typ_oferty',
            'type' => 'Select',
            'options' => [
                'label' => 'Typ oferty',
                'empty_option' => '-',
                'value_options' => [
                    'S' => 'sprzedaż',
                    'W' => 'wynajem'
                ]
            ],
        ]);
        $this->add([
            'name' => 'typ_nieruchomosci',
            'type' => 'Select',
            'options' => [
                'label' => 'Typ nieruchomości',
                'empty_option' => '-',
                'value_options' => [
                    'M' => 'mieszkanie',
                    'D' => 'dom',
                    'G' => 'grunt'
                ]
            ],
        ]);
        $this->add([
            'name' => 'numer',
            'type' => 'Text',
            'options' => [
                'label' => 'Numer',
            ],
        ]);

        $this->add([
            'name' => 'cena',
            'type' => 'Text',
            'options' => [
                'label' => 'Cena',
            ],
        ]);


        $this->add([
            'name' => 'powierzchnia',
            'type' => 'Text',
            'options' => [
                'label' => 'Powierzchnia',
            ],
        ]);

    }
}
