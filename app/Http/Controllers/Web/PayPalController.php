<?php

namespace App\Http\Controllers\Web;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

/**
 * Class PayPalController
 *
 * @package App\Http\Controllers\Web
 */
class PayPalController extends WebController
{
    /**
     * @return \PayPal\Api\Payment
     */
    public function createPayment()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARxJipcdkVMbE7PBuAsmIGRT9ZTIBG7IUudevxu9a_-CwizXC6Oz2KpI9Zg63-NVusdH99yJYc0s18JK',     // ClientID
                'EIUnl93D5e_1Q3WIosx9nYYkHu_boQZwX22vfwwzsK3pkrrmUD9YN104kXd6_06u7zTe9II7Q7Y3Yvnr'      // ClientSecret
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
              ->setCurrency('USD')
              ->setQuantity(1)
              ->setSku("123123") // Similar to `item_number` in Classic API
              ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
              ->setCurrency('USD')
              ->setQuantity(5)
              ->setSku("321321") // Similar to `item_number` in Classic API
              ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems([$item1, $item2]);

        $details = new Details();
        $details->setShipping(1.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);

        $amount = new Amount();
        $amount->setCurrency("USD")
               ->setTotal(20)
               ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription("Payment description")
                    ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("https://khopkmobile.xyz/index")
                     ->setCancelUrl("https://khopkmobile.xyz/index");

        // Add NO SHIPPING OPTION
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);

        $webProfile = new WebProfile();
        $webProfile->setName('test'.uniqid())->setInputFields($inputFields);

        $webProfileId = $webProfile->create($apiContext)->getId();

        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }

        return $payment;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \PayPal\Api\Payment
     */
    public function executePayment(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARxJipcdkVMbE7PBuAsmIGRT9ZTIBG7IUudevxu9a_-CwizXC6Oz2KpI9Zg63-NVusdH99yJYc0s18JK',     // ClientID
                'EIUnl93D5e_1Q3WIosx9nYYkHu_boQZwX22vfwwzsK3pkrrmUD9YN104kXd6_06u7zTe9II7Q7Y3Yvnr'      // ClientSecret
            )
        );

        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);

        // $transaction = new Transaction();
        // $amount = new Amount();
        // $details = new Details();

        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(17.50);

        // $amount->setCurrency('USD');
        // $amount->setTotal(21);
        // $amount->setDetails($details);
        // $transaction->setAmount($amount);

        // $execution->addTransaction($transaction);

        try {
            $result = $payment->execute($execution, $apiContext);
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }

        return $result;
    }
}
