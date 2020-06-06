<?php

namespace Application\Controller;

use Application\Form\AutorForm;
use Application\Model\Autor;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AutorzyController extends AbstractActionController
{
    /**
     * @var autor
     */
    private $autor;

    /**
     * @var autorForm
     */
    private $autorForm;

    public function __construct(Autor $autor, AutorForm $autorForm)
    {
        $this->autor = $autor;
        $this->autorForm = $autorForm;
    }

    public function listaAction()
    {
        return new ViewModel([
            'autor' => $this->autor->pobierzWszystko(),
        ]);
    }

    public function dodajAction()
    {
        $this->autorForm->get('zapisz')->setValue('Dodaj');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->autorForm->setData($request->getPost());

            if ($this->autorForm->isValid()) {
                $this->autor->dodaj($request->getPost());

                return $this->redirect()->toRoute('autorzy');
            }
        }

        return new ViewModel(['tytul' => 'Dodawanie autora', 'form' => $this->autorForm]);
    }

    public function edytujAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('autorzy');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->autorForm->setData($request->getPost());

            if ($this->autorForm->isValid()) {
                $this->autor->aktualizuj($id, $request->getPost());

                return $this->redirect()->toRoute('autorzy');
            }
        } else {
            $daneAutor = $this->autor->pobierz($id);
            $this->autorForm->setData($daneAutor);
        }

        $viewModel = new ViewModel(['tytul' => 'Edytuj autora', 'form' => $this->autorForm]);
        $viewModel->setTemplate('application/autorzy/dodaj');

        return $viewModel;
    }

	public function usunAction()
    {
 
        $id = (int)$this->params()->fromRoute('id', 0);
        if((!$id)){
            return $this->redirect()->toRoute('autorzy');
        }
        $request = $this->getRequest();
        if ($request->isPost()){
            $del=$request->getPost('del', 'Nie');
 
            if ($del == "Usun") {
                $id = (int) $request->getPost('id');
                $this->autor->usun($id);
 
            }
            return $this->redirect()->toRoute('autorzy');
        }
 
 
        $viewModel = new ViewModel(['tytul' => 'Usun', 'autor' => $this->autor->pobierz($id)]);
        $viewModel->setTemplate('application/autorzy/usun');
 
        return $viewModel;
    }
	
	
	public function szczegolyAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('autorzy');
        }
        $daneAutor = $this->autor->pobierz($id);
        $this->autorForm->setData($daneAutor);

        $viewModel = new ViewModel(['tytul' => 'Szczegóły Autora', 'form' => $this->autorForm]);
        $viewModel->setTemplate('application/autorzy/szczegoly');

        return $viewModel;
    }
	
	
}
