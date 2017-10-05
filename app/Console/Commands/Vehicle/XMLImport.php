<?php

namespace App\Console\Commands\Vehicle;

use App\Service\Vehicle\VehicleService;
use Illuminate\Console\Command;

class XMLImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:import_xml {xmlFile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var VehicleService
     */
    private $vehicleService;

    /**
     * Create a new command instance.
     *
     * @param VehicleService $vehicleService
     */
    public function __construct(VehicleService $vehicleService)
    {
        parent::__construct();
        $this->vehicleService = $vehicleService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->vehicleService->createFromXML($this->argument('xmlFile'));
    }
}
