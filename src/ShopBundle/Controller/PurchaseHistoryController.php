<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ShopBundle\Entity\CustomerAccount;
use ShopBundle\Entity\PurchaseHistory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * @Route("/purchaseHistory/{id}", name="purchase_history_get")
     * @Method("GET")
     * @Template()
     * @param Request $request
     * @return array
     */
    public function getAction(Request $request)
    {
        $id = $request->attributes->get('id');

        $purchase_history = $this->getDoctrine()->getRepository(PurchaseHistory::class)->find($id);

        return [
            'purchase_history' => $purchase_history
        ];
    }

    /**
     * @Route("/purchaseHistory", name="purchase_history_list")
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $purchase_history = $this->getDoctrine()->getRepository(PurchaseHistory::class)->findAll();

        return [
            'purchase_history' => $purchase_history
        ];
    }

    /**
     * @Route("/purchaseHistory/{customer_id}", name="customer_purchase_history_list")
     * @Method("GET")
     * @Template
     * @param Request $request
     * @return array
     */
    public function listByCustomerAction(Request $request) {
        $customer_id = $request->attributes->get('customer_id');

        $purchase_history = $this->getDoctrine()->getRepository(PurchaseHistory::class)->findBy(['customer_id' => $customer_id]);

        return [
            'purchase_history' => $purchase_history
        ];
    }

    /**
     * @Route("/purchaseHistory", name="own_purchase_history_list")
     * @Method("GET")
     * @Template
     */
    public function listOwnAction() {
        $user_id = $this->getUser()->getId();
        $customer_id = $this->getDoctrine()->getRepository(CustomerAccount::class)->findOneBy(['user_id' => $user_id])->getId();

        $purchase_history = $this->getDoctrine()->getRepository(PurchaseHistory::class)->findBy(['customer_id' => $customer_id]);
        return [
            'purchase_history' => $purchase_history
        ];
    }

}
