<?php

namespace Nieruchomosci\Controller;

use Mpdf\Mpdf;
use Nieruchomosci\Form;
use Nieruchomosci\Model\Koszyk;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\PhpRenderer;

class KoszykController extends AbstractActionController
{
    /**
     * @var Koszyk
     */
    private $koszyk;

    /**
     * KoszykController constructor.
     * @param Koszyk $koszyk
     */
    public function __construct(Koszyk $koszyk)
    {
        $this->koszyk = $koszyk;
    }

    public function dodajAction()
    {
        if($this->getRequest()->isPost()) {
            $this->koszyk->dodaj($this->params()->fromRoute('id'));
            $this->getResponse()->setContent('ok');
        }

        return $this->getResponse();
    }
    public function listaAction()
    {
        $parametry = $this->params()->fromQuery();
        $strona = $parametry['strona'] ?? 1;

        // pobierz dane ofert
        $paginator = $this->koszyk->pobierzWszystko($parametry);
        $paginator->setItemCountPerPage(10)->setCurrentPageNumber($strona);

        // zbuduj formularz wyszukiwania
        $form = new Form\KoszykForm();
        $form->populateValues($parametry);

        return new ViewModel([
            'form' => $form,
            'koszyk' => $paginator,
            'parametry' => $parametry]);
    }
	
	
	public function usunAction()
    {
        $this->koszyk->usun($this->params()->fromRoute('id'));
        $this->getResponse()->setContent('ok');
		return $this->getResponse();
    }
	
	
	
}
