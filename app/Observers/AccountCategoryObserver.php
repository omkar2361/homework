<?php

namespace App\Observers;

use App\AccountCategory;

class AccountCategoryObserver
{
    /**
     * Handle the account category "created" event.
     *
     * @param  \App\AccountCategory  $accountCategory
     * @return void
     */
    public function created(AccountCategory $accountCategory)
    {
        //
    }

    /**
     * Handle the account category "updated" event.
     *
     * @param  \App\AccountCategory  $accountCategory
     * @return void
     */
    public function updated(AccountCategory $accountCategory)
    {
        //
    }

    /**
     * Handle the account category "deleted" event.
     *
     * @param  \App\AccountCategory  $accountCategory
     * @return void
     */
    public function deleted(AccountCategory $accountCategory)
    {
        //
    }

    /**
     * Handle the account category "restored" event.
     *
     * @param  \App\AccountCategory  $accountCategory
     * @return void
     */
    public function restored(AccountCategory $accountCategory)
    {
        //
    }

    /**
     * Handle the account category "force deleted" event.
     *
     * @param  \App\AccountCategory  $accountCategory
     * @return void
     */
    public function forceDeleted(AccountCategory $accountCategory)
    {
        //
    }
}
