<?php

use App\Model\AccountCategory;
use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'display_name' => 'Current Assets',
                'is_sub_category' => false,
                'description' => null,
                'is_unpaid_balance_required' => false,
                'is_unpaid_balance_date_required' => false,
                'is_current_balance_required' => true,
                'is_current_balance_date_required' => true,
                'sub_categories' => [
                    [
                        'display_name' => 'Allowance For Bad Debts',
                        'description' => 'Use<strong> Allowance for bad debts </strong>to estimate the part of Accounts Receivable (Debtors) that you think you might not collect. Use this <strong>only </strong>if you are keeping your books on the accrual basis.',

                    ],
                    [
                        'display_name' => 'Assets Available For Sale',
                        'description' => 'Use <strong>Assets available for sale </strong>to track assets that are available for sale that are not expected to be held for a long period of time.',

                    ],
                    [
                        'display_name' => 'Balance with Government Authorities',
                        'description' => 'Use <strong>Balance with Government Authorities</strong> to track the amount of taxes paid on input services/purchases, which offset taxes collected on sales (for example, CENVAT Credit Receivable).',

                    ],
                    [
                        'display_name' => 'Deferred Service Tax Input Credit',
                        'description' => 'Use <strong>Deferred Service Tax Input Credit<strong> is used when you need to track your tax credits to use in a later filing period.',

                    ],
                    [
                        'display_name' => 'Development Costs',
                        'description' => 'Use <strong>Development costs</strong> to track amounts you deposit or set aside to arrange for financing, such as an SBA loan, or for deposits in anticipation of the purchase of property or other assets.
                            When the deposit is refunded, or the purchase takes place, remove the amount from this account.',

                    ],
                    [
                        'display_name' => 'Employee Cash Advances',
                        'description' => 'Use <strng>Employee cash advances</strong> to track employee wages and salary you issue to an employee early, or other non-salary money given to employees.
                            If you make a loan to an employee, use the Current asset account type called Loans to others, instead.',

                    ],
                    [
                        'display_name' => 'Inventory',
                        'description' => 'Use <strong>Inventory</strong> to track the cost of goods your business purchases for resale.<br>
                                            When the goods are sold, assign the sale to a <strong>Cost of goods sold</strong> account.',

                    ],
                    [
                        'display_name' => 'Investments - Other ',
                        'description' => 'Use <strong>Investments - Other</strong> to track the value of investments not covered by other investment account types. Examples include publicly-traded shares, coins, or gold.',

                    ],
                    [
                        'display_name' => 'Loans To Officers',
                        'description' => 'If you operate your business as a Corporation, use <strong>Loans to officers</strong> to track money loaned to officers of your business.',

                    ],
                    [
                        'display_name' => 'Loans To Others ',
                        'description' => 'Use <strong>Loans to others</strong> to track money your business loans to other people or businesses.
                                            This type of account is also referred to as Notes Receivable.For early salary payments to employees, use Employee cash advances, instead.',

                    ],
                    [
                        'display_name' => 'Loans To Shareholders',
                        'description' => 'If you operate your business as a Corporation, use <strong>Loans to Shareholders</strong> to track money your business loans to its shareholders.',

                    ],
                    [
                        'display_name' => 'Other current assets',
                        'description' => 'Use <strong>Other current assets</strong> for current assets not covered by the other types. Current assets are likely to be converted to cash or used up in a year.',

                    ],
                    [
                        'display_name' => 'Prepaid expenses',
                        'description' => 'Use <strong>Prepaid expenses</strong> to track payments for expenses that you won’t recognise until your next accounting period.
                                            When you recognise the expense, make a journal entry to transfer money from this account to the expense account.',

                    ],
                    [
                        'display_name' => 'Retainage',
                        'description' => 'Use <strong>Retainage</strong> if your customers regularly hold back a portion of a contract amount until you have completed a project.
                                            This type of account is often used in the construction industry, and only if you record income on an accrual basis.',

                    ],
                    [
                        'display_name' => 'Service Tax Refund',
                        'description' => 'Use <strong>Service Tax Refund</strong> is used when you need to get a refund from the IRS.',

                    ],
                    [
                        'display_name' => 'Short Term Investments in Related Parties',
                        'description' => 'Use <strong>Short Term Investments in Related Parties</strong> to track investments held in subsidiaries, associates, joint ventures and other related entities maturing within 12 months.',

                    ],
                    [
                        'display_name' => 'Short Term Loans and Advances to related parties',
                        'description' => 'Use <strong>Short Term Loans and Advances to related parties</strong> to track loans and advance given to related parties for a period not more than twelve months from the balance sheet date.',

                    ],
                    [
                        'display_name' => 'Undeposited funds',
                        'description' => 'Use <strong>Undeposited funds</strong> for cash or cheques from sales that haven’t been deposited yet.
                                            For petty cash, use Cash on hand, instead.',

                    ],

                ],
            ],
        ];

        //insert data
        foreach ($data as $record) {
            $category = new AccountCategory();

            $category->display_name = $record['display_name'];
            $category->description = $record['description'];
            $category->is_unpaid_balance_required = $record['is_unpaid_balance_required'];
            $category->is_unpaid_balance_date_required = $record['is_unpaid_balance_date_required'];
            $category->is_current_balance_required = $record['is_current_balance_required'];
            $category->is_current_balance_date_required = $record['is_current_balance_date_required'];

            $category->save();

            if (isset($record['sub_categories'])) {
                foreach ($record['sub_categories'] as $cat) {
                    $new_cat = new AccountCategory();

                    $new_cat->fill($cat);
                    $new_cat->parent_id = $category->id;

                    $new_cat->save();
                }
            }
        }
    }
}
