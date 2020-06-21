<?php

namespace Nieruchomosci\Controller;

use Nieruchomosci\Model\Oferta;
use Nieruchomosci\Model\Zapytanie;
use Laminas\Mvc\Controller\AbstractActionController;

class ZapytanieController extends AbstractActionController
{
    /**
     * @var Oferta
     */
    private $oferta;

    /**
     * @var Zapytanie
     */
    private $zapytanie;

    /**
     * ZapytanieController constructor.
     * @param Oferta $oferta
     * @param Zapytanie $zapytanie
     */
    public function __construct(Oferta $oferta, Zapytanie $zapytanie)
    {
        $this->oferta = $oferta;
        $this->zapytanie = $zapytanie;
    }

    public function wyslijAction()
    {
        $id = $this->params()->fromRoute('id');
        if ($this->getRequest()->isPost() && $id) {
            $daneOferty = $this->oferta->pobierz($id);
            $wynik = $this->zapytanie->wyslij($daneOferty, $this->params()->fromPost('tresc'));

            if ($wynik) {
                $this->getResponse()->setContent('ok');
            }
        }

        return $this->getResponse();
    }
}
