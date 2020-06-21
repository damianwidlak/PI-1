<?php

namespace Nieruchomosci\Form;

use Laminas\Form\Form;

class OfertaSzukajForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('oferta_szukaj');

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
            'name' => 'metraz_od',
            'type' => 'Text',
            'options' => [
                'label' => 'Metraz_od',
            ],
        ]);
        $this->add([
            'name' => 'metraz_do',
            'type' => 'Text',
            'options' => [
                'label' => 'Metraz_do',
            ],
        ]);
        $this->add([
            'name' => 'cena_od',
            'type' => 'Text',
            'options' => [
                'label' => 'Cena_od',
            ],
        ]);
        $this->add([
            'name' => 'cena_do',
            'type' => 'Text',
            'options' => [
                'label' => 'Cena_do',
            ],
        ]);
        $this->add([
            'name' => 'szukaj',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Szukaj',
                'class' => 'btn btn-primary'
            ],
            'options' => [
                'label' => 'Filtruj',
            ],
        ]);
    }
}
