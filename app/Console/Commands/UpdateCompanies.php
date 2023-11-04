<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class UpdateCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the "days" column of the companies table.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all companies with "days" greater than 0
        $companies = Company::where('days', '>', 0)->get();

        foreach ($companies as $company) {
            // Update the "days" column by subtracting 1
            $company->days = $company->days - 1;

            $company->save();
        }

        $this->info('Companies updated successfully.');
    }
}
