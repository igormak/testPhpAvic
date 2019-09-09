<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Main\Controller;

use Application\Controller\BaseController as BaseController;

use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\Session;

use Main\Entity\Users;
use Main\Entity\TKoatuuTree;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;



class IndexController extends BaseController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();

        //$region = $em->getRepository('Main\Entity\TKoatuuTree')->findBy(array('terLevel' => 1));
        $query = $em->createQuery("SELECT u FROM Main\Entity\TKoatuuTree u WHERE u.terLevel=1 AND u.regId < 75 ORDER BY u.terName ASC");
        $rows_region = $query->getResult();

        return array('region' => $rows_region);
        //return new ViewModel();
    }

    public function getCityAction()
    {
        $em = $this->getEntityManager();

        $outCity = array();
        //$city = $em->getRepository('Main\Entity\TKoatuuTree')->findBy(array('terPid' => $_POST['region']/*, 'terTypeId' => 1*/));
        $request = $this->getRequest();
        if($request->isPost()) {
            $query = "SELECT u FROM Main\Entity\TKoatuuTree u WHERE u.regId = '". substr($_POST['region'], 0, 2) ."' AND u.terTypeId = 1 ";
            if ($_POST['region'] == '0100000000')
                $query .= "OR u.terId = '8500000000' ";
            if ($_POST['region'] == '3200000000')
                $query .= "OR u.terId = '8000000000' ";

            $query .= "ORDER BY u.terName ASC";

            $query = $em->createQuery($query);
            $rows_city = $query->getResult();

            foreach ($rows_city as $item) {
                $outCity[] = array($item->getTerId(), $item->getTerName());
            }
        }

        return new JsonModel($outCity);
    }

    public function getDistrictAction()
    {
        $em = $this->getEntityManager();

        $outDistrict = array();
        $request = $this->getRequest();
        if($request->isPost()) {
            $district = $em->getRepository('Main\Entity\TKoatuuTree')->findBy(array('terPid' => $_POST['city'], 'terTypeId' => 3));

            if (empty($district))
                $outDistrict[] = array('0', 'Нет райнов');

            foreach ($district as $item) {
                $outDistrict[] = array($item->getTerId(), $item->getTerName());
            }
        }

        return new JsonModel($outDistrict);
    }

    public function checkInAction()
    {
        $em = $this->getEntityManager();

        $request = $this->getRequest();
        if($request->isPost()) {
            $user = $em->getRepository('Main\Entity\Users')->findOneBy(array('email' => $_POST['email']));
            if (!$user) {
                $user = new Users();

                $user->setName($_POST['fio']);
                $user->setEmail($_POST['email']);
                $user->setTerritory($_POST['district'] == 0 ? $_POST['city'] : $_POST['district']);

                $em->persist($user);
                $em->flush();

                return new JsonModel(array('пользователь создан'));
            } else {
                $territory = $em->getRepository('Main\Entity\TKoatuuTree')->findOneBy(array('terId' => $user->getTerritory()));

                $out = 'Name: '. $user->getName() . "<br>";
                $out .= 'Email: '. $user->getEmail() . "<br>";
                $out .= 'Territory: '. $territory->getTerAddress() . "<br>";


                return new JsonModel(array($out));
            }
        }


    }

}
