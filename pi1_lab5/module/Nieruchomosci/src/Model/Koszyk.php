<?php

namespace Nieruchomosci\Model;

use Laminas\Db\Adapter as DbAdapter;
use Laminas\Db\Sql\Sql;
use Laminas\Session\Container;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Session\SessionManager;
use Laminas\Paginator\Paginator;

class Koszyk implements DbAdapter\AdapterAwareInterface
{
	use DbAdapter\AdapterAwareTrait;
	
	protected $sesja;
	
	public function __construct()
	{
		$this->sesja = new Container('koszyk');
		$this->sesja->liczba_ofert = $this->sesja->liczba_ofert ? $this->sesja->liczba_ofert : 0;
	}
	
	public function dodaj($idOferty)
	{
		$dbAdapter = $this->adapter;
		$session = new SessionManager();
		
		$sql = new Sql($dbAdapter);
		$select = $sql -> select('koszyk');
		$select -> where (['id_oferty' => $idOferty]);
        $select -> where (['id_sesji' => $session ->getId()]);
        $selectString = $sql ->buildSqlString($select);
        $wynik = $dbAdapter ->query($selectString,$dbAdapter::QUERY_MODE_EXECUTE);
		if(!$wynik->count()){



        $insert = $sql->insert('koszyk');
		$insert->values([
			'id_oferty' => $idOferty,
			'id_sesji' => $session->getId()
        ]);
		
		$selectString = $sql->buildSqlString($insert);
		$wynik = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		
		$this->sesja->liczba_ofert++;
        }
		try {
			return $wynik->getGeneratedValue();
		} catch(Exception $e) {
			return false;
		}
	}
	
	public function liczbaOfert()
	{
		return $this->sesja->liczba_ofert;
	}
	
    public function pobierzWszystko($szukaj = [])
    {
        $dbAdapter = $this->adapter;


        $session = new SessionManager();
        $sql = new Sql($dbAdapter);
        $select = $sql -> select();
        $select -> from(['k' => 'koszyk']);
        $select -> join(['a' => 'oferty'], 'k.id_oferty = a.id', ['typ_oferty', 'typ_nieruchomosci', 'numer', 'powierzchnia', 'cena']);
        $select -> where(['id_sesji' => $session->getId()]);

        $paginatorAdapter = new DbSelect($select, $dbAdapter);
        $paginator = new Paginator($paginatorAdapter);

        return $paginator;
    }


	public function usun($idOferty)
    {
        $dbAdapter = $this->adapter;
		
        $sql = new Sql($dbAdapter);
        $delete = $sql->delete('koszyk');
        $delete->where(['id' => $idOferty]);
        $selectString = $sql->buildSqlString($delete);
        $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
		
		$this->sesja->liczba_ofert--;

        return true;
    }

	
	

}