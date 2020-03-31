<?php

namespace App\Observers;

use App\SaleTransaction;

class SaleTransactionObserver
{
    /**
     * Handle the sale transaction "created" event.
     *
     * @param  \App\SaleTransaction  $saleTransaction
     * @return void
     */
    public function created(SaleTransaction $saleTransaction)
    {
        //
    }

    /**
     * Handle the sale transaction "updated" event.
     *
     * @param  \App\SaleTransaction  $saleTransaction
     * @return void
     */
    public function updated(SaleTransaction $saleTransaction)
    {
        //
    }

    /**
     * Handle the sale transaction "deleted" event.
     *
     * @param  \App\SaleTransaction  $saleTransaction
     * @return void
     */
    public function deleted(SaleTransaction $saleTransaction)
    {
        $saleTransaction->items()->delete();
    }

    /**
     * Handle the sale transaction "restored" event.
     *
     * @param  \App\SaleTransaction  $saleTransaction
     * @return void
     */
    public function restored(SaleTransaction $saleTransaction)
    {
        //
    }

    /**
     * Handle the sale transaction "force deleted" event.
     *
     * @param  \App\SaleTransaction  $saleTransaction
     * @return void
     */
    public function forceDeleted(SaleTransaction $saleTransaction)
    {
        //
    }
}
