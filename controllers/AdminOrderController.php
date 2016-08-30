<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 22.08.16
 * Time: 14:06
 */
class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();
        $orders = Order::getOrders();

        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    public function actionView($id)
    {
        self::checkAdmin();

        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products'], true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);


        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    public static function actionUpdate($id)
    {
        self::checkAdmin();

        $order=Order::getOrderById($id);

        if(isset($_POST['submit'])){
            $userName=$_POST['userName'];
            $userPhone=$_POST['userPhone'];
            $userComment=$_POST['userComment'];
            $date=$_POST['date'];
            $status=$_POST['status'];

            Order::updateOrder($id,$userName,$userPhone,$userComment,$date,$status);
        }

        require_once (ROOT.'/views/admin_order/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Order::deleteOrder($id);
            header('Location:/admin/order');
        }
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }
}