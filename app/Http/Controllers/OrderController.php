<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repo\OrderRepo\OrderRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepositoty ;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepositoty = $orderRepository;
    }

    public function showOrder()
    {
        //Status = 0 : pending
        $status = 0;
        $orders = $this->orderRepositoty->getOrderByStatus($status);
        return view('admin.order.pending', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order =$this->orderRepositoty->findById($id);
        $details = $this->orderRepositoty->getDetails($id);

        return view('admin.order.vieworder',compact('order','details'));
    }
    public function acceptPayment($id)
    {
        $order =$this->orderRepositoty->findById($id);
        $status = 1;
        $this->orderRepositoty->changeStatus($order,$status);
        $notification = [
            'message'=>'Payment Accept Done',
            'alert-type'=>'success'
        ];
        return redirect()->route('order.showOrder')->with($notification);
    }
    public function cancelPayment($id)
    {
        $order =$this->orderRepositoty->findById($id);
        $status = 4;
        $this->orderRepositoty->changeStatus($order,$status);
        $notification = [
            'message'=>'Payment Cancel Done',
            'alert-type'=>'success'
        ];
        return redirect()->route('order.showOrder')->with($notification);

    }
    public function deleveryProcess($id)
    {
        $order =$this->orderRepositoty->findById($id);
        $status = 2;
        $this->orderRepositoty->changeStatus($order,$status);
        $notification = [
            'message'=>'Send To Delivery',
            'alert-type'=>'success'
        ];
        return redirect()->route('order.showOrder')->with($notification);

    }


    public function showCancelOrder()
    {
        //Status = 0 : pending
        $status = 4;
        $orders = $this->orderRepositoty->getOrderByStatus($status);
        return view('admin.order.pending', compact('orders'));
    }

    public function showProcessPayment()
    {
        //Status = 0 : pending
        $status = 2;
        $orders = $this->orderRepositoty->getOrderByStatus($status);
        return view('admin.order.pending', compact('orders'));
    }
    public function showSuccessPayment()
    {
        //Status = 0 : success
        $status = 3;
        $orders = $this->orderRepositoty->getOrderByStatus($status);
        return view('admin.order.pending', compact('orders'));
    }
    public function showAcceptPayment()
    {
        //Status = 0 : success
        $status = 1;
        $orders = $this->orderRepositoty->getOrderByStatus($status);
        return view('admin.order.pending', compact('orders'));
    }

    public function doneDelivery($id)
    {


        $this->orderRepositoty->subQuantity($id);
        $order =$this->orderRepositoty->findById($id);
        $status = 3;
        $this->orderRepositoty->changeStatus($order,$status);
        $notification = [
            'message'=>'Product Delivery Done',
            'alert-type'=>'success'
        ];

        return Redirect()->route('order.showSuccessPayment')->with($notification);
    }


}
