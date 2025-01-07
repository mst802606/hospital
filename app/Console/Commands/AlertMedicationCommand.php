<?php

namespace App\Console\Commands;

use App\Models\MedicationPlan;
use Illuminate\Console\Command;

class AlertMedicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:medication-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alerts nurses on medications that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        MedicationPlan::checkDueMedications();

    }

}
