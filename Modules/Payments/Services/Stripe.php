<?php
namespace Modules\Payments\Services;

use Modules\Payments\Contacts\PaymentGatewayContract;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentMethod;
use Stripe\PromotionCode;
use Stripe\Price;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Stripe\SubscriptionItem;
use Stripe\SetupIntent;
use Stripe\Webhook;
use Stripe\PaymentIntent;
use Stripe\Transaction;
use Stripe\Charge;
use Stripe\Product;
use Carbon\Carbon;
use Stripe\Stripe as StripeApi;
use Stripe\StripeClient;

class Stripe implements PaymentGatewayContract
{
    
       /** initialization of stripe object
     * @author SA **/
    public function __construct()
    {
        $key=env('STRIPE_SECRET_KEY');
        StripeApi::setApiKey($key);
    }

    // create Stripe Customer
    public function cretaeCustomer($payload):object
    {
        $data = [
            'name' => $payload['company_name'],
            'email' => $payload['email_address'],
            'metadata' => [
                'first_name' => $payload['first_name'],
                'last_name' => $payload['last_name'],
                'organization' => $payload['company_name'],
            ],
        ];
        if(!empty($payload['phone'])){
            $data['phone'] = $payload['phone'];
        }
        return Customer::create($data);
    }

















































//        /** creating session
//      * @author SA **/
//      public function createSession($userOrderId, $priceId, $quantity =1, $stripeCustomer,$userId)
//     {
//         $successUrl = route("subscription-success") . "?orderId=" . $userOrderId;
//         $cancelUrl = route("subscription-cancel") . "?orderId=" . $userOrderId;
//         $create = [
//             'success_url' => $successUrl,
//             'cancel_url' => $cancelUrl,
//             'payment_method_types' => ['card'],
//             'mode' => 'subscription',
//             'line_items' => [
//                 [
//                     'price' => $priceId,
//                     'quantity' => 1,
//                 ],
//             ],
//             'metadata'=>[
//                 'user_id'=>$userId,
//                 ],
//             // 'subscription_data' => [
//             //     'trial_period_days' => 14,
//             //  //    'trial_end' => strtotime(Carbon::now()->addDay(14)->format("Y-m-d"))
//             // ],
//             'customer' => $stripeCustomer,
//             //    'customer_email' => $stripeCustomer->email
//         ];
//         if (isset($create['promoCode'])) {
//             $create['discounts'] = [['coupon' => $create['promoCode']]];
//         }
//         $session = Session::create($create);
//         return $session;
//     }

//        /** fetch session
//      * @author SA **/
//    public function fetchSession($sessionId){
//        return Session::retrieve($sessionId);
//    }
   
//        /** fetch fetch subscription
//      * @author SA **/
//     public function fetchSubscription($subscriptionId){
//         return Subscription::retrieve($subscriptionId);
//     }
//     /** fetch fetch subscription
//      * @author AW **/
    
//     public function fetchAllSubscription($customer_id){
//         return Subscription::all(['customer'=>$customer_id,'status'=>'active']);
//     }

//     /** fetch fetch subscriptions
//      * @author MH 
//      * @created At 12 oct 2021 **/
//     public function fetchSubscriptions()
//     {
//         return Price::all(['product' => env('STRIPE_PRODUCT_ID'), 'active' => true]);
//     }
//            /** fetch payment method
//      * @author SA **/
//     public function fetchPaymentMethod($paymentMethodId){
//         return PaymentMethod::retrieve($paymentMethodId);
//     }

//            /** fetch promocode
//      * @author SA **/
//     public function getCouponByPromoCode($code){
//         return PromotionCode::all(['code'=>$code]);
//     }
//            /** update subscription
//      * @author SA **/
//     public function updateSubscription($subsciptionId,$update){
//         return Subscription::update($subsciptionId,$update);
//     }
//            /** fetch price
//      * @author SA **/
//     public function fetchPrice($priceId){
//         return Price::retrieve($priceId);
//     }
//        /** fetch invoice
//      * @author SA **/
//     public function fetchInvoice($invoiceId){
//         return Invoice::retrieve($invoiceId);
//     }
    
//        /** fetch multiple invoices
//      * @author SA **/
//     public function fetchInvoiceAllItems($invoiceId){
//         return InvoiceItem::all(['invoice'=>$invoiceId]);
//     }

//        /** fetch fetch customer
//      * @author SA **/
//     public function fetchCustomer($customerId){
//         return Customer::retrieve(['id'=>$customerId]);
//     }
    
//        /** create card session
//      * @author SA **/
//     public function createCardSession($data){
//         $successUrl=config('config.DASHBOARD_URL').'/settings?payment=true';
//         $cancelUrl=config('config.DASHBOARD_URL').'/settings';
//         $create=[
//             'payment_method_types' => ['card'],
//             'mode' => 'setup',
//             'customer' => $data['stripe_customer_id'],
//             'setup_intent_data' => [
//                 'metadata' => [
//                     'customer_id' => $data['stripe_customer_id'],
//                     'subscription_id' => $data['payment_gateway_subscription_id'],
//                 ],
//             ],
//             'success_url' => $successUrl,
//             'cancel_url' => $cancelUrl,
//         ];
//         return Session::create($create);
//     }

//        /** fetch setup intent
//      * @author SA **/
//     public function fetchSetupIntent($intentId){
//         return SetupIntent::retrieve($intentId,[]);
//     }

//        /** update subscription
//      * @author SA **/
//     public function subscriptionUpdate($subscriptionId,$update){
//         return Subscription::update($subscriptionId,$update);
//     }
    
//        /** update customer
//      * @author SA **/
//     public function customerUpdate($customerId,$update){
//         return Customer::update($customerId,$update);
//     }

//        /** create customer
//      * @author SA **/
//     //   modified Ab-Wahid 1-3-23
//     public function customerCreate($payload)
//     {
//         $data = [
//             'name' => $payload['company_name'],
//             'email' => $payload['email_address'],
//             'metadata' => [
//                 'first_name' => $payload['first_name'],
//                 'last_name' => $payload['last_name'],
//                 'organization' => $payload['company_name'],
//             ],
//         ];
//         if(!empty($payload['phone'])){
//             $data['phone'] = $payload['phone'];
//         }
//         return Customer::create($data);
//     }

//        /** pause payment collection customer
//      * @author SA **/
//     public function pausePaymentCollection($subscriptionId){
//         return Subscription::update($subscriptionId,[
//                 'pause_collection' => [
//                     'behavior' => 'mark_uncollectible',
//                 ],
//             ]
//         );
//     }
    
//        /** cancle subscription
//      * @author SA **/
//     public function cancelSubscription($subscriptionId){
//         $subscription=$this->fetchSubscription($subscriptionId);
//         return $subscription->cancel();
        
//     }

//        /** contruct event
//      * @author SA **/
//     public function constructEvent($payload)
//     {
//         $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
//         $endpoint_secret = config('stripe.ENDPOINT_SECRET');
//         return Webhook::constructEvent(
//             $payload, $sig_header, $endpoint_secret
//         );
//     }
    
//        /** get payment method
//      * @author SA **/
//     public function paymentMethods($payload)
//     {
//         return PaymentMethod::all($payload);    
//     }

//     /** create setup intent
//      * @author YR **/
//     public function createSetupIntent($customerId, $pmId, $planId, $paymentLink, $orderId, $qty)
//     {
//         $intent = SetupIntent::create([
//             'payment_method_types' => ['card'],
//             'payment_method' => $pmId,
//             'customer' => $customerId,
//             'metadata' => [
//                 'plan_id' => $planId,
//                 'payment_link' => $paymentLink,
//                 'order_id' => $orderId,
//                 'quantity' => $qty
//             ]
//         ]);
//         $client_secret = $intent->client_secret;
//         return $client_secret;
//     }
//     public function paymentIntentClientSecret($customerId, $pmId, $planId, $paymentLink, $orderId, $qty)
//     {
//         $intent = SetupIntent::create([
//             'payment_method_types' => ['card'],
//             'payment_method' => $pmId,
//             'customer' => $customerId,
//             'metadata' => [
//                 'plan_id' => $planId,
//                 'payment_link' => $paymentLink,
//                 'order_id' => $orderId,
//                 'quantity' => $qty
//             ]
//         ]);
//         $client_secret = $intent->client_secret;
//         return $client_secret;
//     }

//     /** set default payment method of customer
//      * @author YR **/
//     public function setDefaultPaymentMethod($pmID, $customerID)
//     {
//         return Customer::update(
//             $customerID,
//                 ['invoice_settings'=>[
//                     'default_payment_method' =>  $pmID
//                 ]
//             ]
//         );
//     }
    
//     /** subscribe customer to a package
//      * @author YR **/
//     public function customerSubscription($customerId, $priceId, $quantity)
//     {
//         return Subscription::create([
//             'customer' => $customerId,
//             'items' => [
//                 [
//                     'price' => $priceId,
//                     'quantity' => $quantity,
//                 ],
//             ],
//             'trial_period_days' => 14
//         ]);
//     }
    
//     public function createTrial($customerId, $priceId, $quantity)
//     {
//         return Subscription::create([
//             'customer' => $customerId,
//             'items' => [
//                 [
//                     'price' => $priceId,
//                     'quantity' => $quantity,
//                 ],
//             ],
//             'trial_period_days' => 14,
//             'cancel_at_period_end' => true      
//         ]);
//     }

//     public function createSubscription($customerId, $priceId, $quantity,$userId=null)
//     {
//         return Subscription::create([
//             'customer' => $customerId,
//             'items' => [
//                 [
//                     'price'    => $priceId,
//                     'quantity' => $quantity,
//                 ],
//             ],
//             'metadata' => [
//                 'user_id' => $userId
//             ],
//         ]);
//     }

//     public function createMultiSubscription($customerId, $align_items)
//     {
//         return Subscription::create([
//             'customer' => $customerId,
//             'items' => $align_items,
//         ]);
//     }

//     public function addCardForCustomer($customerID,$token){
//         $customer = $this->fetchCustomer($customerID);
//         $card = $customer->createSource(
//                         $customerID,
//                         ['source' => $token]
//                     );
//         return $card;
//     }
//     public function addDefaultResourceToCustomer($customerID,$cardID){
//         $customer = $this->fetchCustomer($customerID);
//         $customer->default_source = $cardID;
//         $customer->save();
//         return $customer;
//     }
//     public function deleteCardForCustomer($customerID){
//         $customer = $this->fetchCustomer($customerID);
//         $customer_cards = $customer->allSources($customerID,['object'=>'card'])->data;
//         if(!empty($customer_cards)){
//             foreach ($customer_cards as $card) {
//                 $customer->deleteSource(
//                     $customerID,
//                     $card->id
//                 );
//             }
//         }
//         $customer_cards = $customer->allSources($customerID,['object'=>'card'])->data;
//         return $customer_cards;
//     }

//     // subscription Items 
//            /** fetch  subscription 
//      * @author SA **/
//     public function fetchSubscriptionItem($item_id){
//         return SubscriptionItem::retrieve(
//             $item_id,
//             []
//           );
//     }

//     public function updateSubscriptionItem($item_id,$quantity)
//     {
//         return SubscriptionItem::update(
//             $item_id,
//             [
//             'quantity'=>$quantity, 
//             ],
//           );   
//     }

//     public function createSubscriptionItem($subscription_id,$price_id,$quantity)
//     {
//         return SubscriptionItem::create(
//             [
//             'subscription' => $subscription_id,
//             'price' => $price_id,
//             'quantity' => $quantity,
//             ]
//           );   
//     }

//     public function deleteSubscriptionItem($item_id)
//     {
//         $subscriptionItem = $this->fetchSubscriptionItem($item_id);
//         return $subscriptionItem->delete();  
//     }

//     public function fetchAllTransactions($customer_id){
//             return Charge::all(
//                 [
//                     'customer' => $customer_id,
//                     'status' => 'succeeded',
//                 ]
//             );
//     }
//     public function endSubscriptionTrial($id){
//         return Subscription::update(
//             $id,
//         ['trial_end' => 'now']);
//     }
}

