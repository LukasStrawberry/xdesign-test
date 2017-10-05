<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace App\Service\Vehicle;

use App\Exceptions\Vehicle\XMLFileDoesNotExistsException;
use App\Exceptions\Vehicle\XMLFileIsNotCorrectXMLException;
use App\Exceptions\Vehicle\XMLFileIsNotFileException;
use App\Exceptions\Vehicle\XMLFileIsNotReadableException;
use App\Exceptions\Vehicle\XMLFileIsNotValidAccordingToSchemaException;
use App\Model\Vehicle\FuelType;
use App\Model\Vehicle\Manufacturer;
use App\Model\Vehicle\Model;
use App\Model\Vehicle\Owner;
use App\Model\Vehicle\OwnerCompany;
use App\Model\Vehicle\Transmission;
use App\Model\Vehicle\Type;
use App\Model\Vehicle\Usage;
use App\Model\Vehicle\WeightCategory;
use App\Repository\BasicRepository;
use App\Repository\Vehicle\VehicleInterface;

class VehicleService
{

    /**
     * @var VehicleInterface
     */
    private $vehicleRepository;

    /**
     * @var string
     */
    private $xsdSchema;

    /**
     * VehicleService constructor.
     * @param VehicleInterface $vehicleRepository
     * @param string $xsdSchema Path to .xsd schema for createFromXML
     */
    public function __construct(VehicleInterface $vehicleRepository, $xsdSchema)
    {
        $this->vehicleRepository = $vehicleRepository;

        if(!file_exists($xsdSchema)){
            throw new \RuntimeException(sprintf(
                'XSD schema "%s" does not exists', $xsdSchema
            ));
        }
        $this->xsdSchema = $xsdSchema;
    }

    public function createFromXML($xmlFile)
    {
        if(!file_exists($xmlFile)){
            throw new XMLFileDoesNotExistsException(sprintf(
                'XML file "%s" does not exists',
                $xmlFile
            ));
        }

        $file = new \SplFileInfo($xmlFile);

        if(!$file->isFile()){
            throw new XMLFileIsNotFileException(sprintf(
                'XML file "%s" is not file',
                $file->getPathname()
            ));
        }

        if(!$file->isReadable()){
            throw new XMLFileIsNotReadableException(sprintf(
                'XML file "%s" is not readable',
                $file->getPathname()
            ));
        }

        $dom = new \DOMDocument();
        try {
            $dom->load($file->getPathname());
        } catch (\Exception $exception){
            throw new XMLFileIsNotCorrectXMLException(sprintf(
                'XML file "%s", is not proper XML (%s)',
                $file->getPathname(),
                $exception->getMessage()
            ));
        }

        try {
            $dom->schemaValidate($this->xsdSchema);
        } catch (\Exception $exception){
            throw new XMLFileIsNotValidAccordingToSchemaException(sprintf(
                'XML file "%s", is not proper formatted according to schema "%s" (%s)',
                $file->getPathname(),
                $this->xsdSchema,
                $exception->getMessage()
            ));
        }

        $vehicles = $dom->getElementsByTagName('Vehicle');

        foreach ($vehicles as $vehicle){
            $manufacturer = (new BasicRepository(new Manufacturer()))->getOrCreate(
                ['name' => $vehicle->getAttribute('manufacturer')]
            );

            $model = (new BasicRepository(new Model()))->getOrCreate(
                [
                    'name' => $vehicle->getAttribute('model'),
                    'manufacturer_id' => $manufacturer->id
                ],
                ['is_hgv' => $vehicle->getElementsByTagName('is_hgv')[0]->nodeValue ? true : false]
            );

            $type = (new BasicRepository(new Type()))->getOrCreate(
                ['name' => $vehicle->getElementsByTagName('type')[0]->nodeValue]
            );

            $usage = (new BasicRepository(new Usage()))->getOrCreate(
                ['name' => $vehicle->getElementsByTagName('usage')[0]->nodeValue]
            );

            $weightCategory = (new BasicRepository(new WeightCategory()))->getOrCreate(
                ['id' => $vehicle->getElementsByTagName('weight_category')[0]->nodeValue],
                ['name' => 'category ' . $vehicle->getElementsByTagName('weight_category')[0]->nodeValue]
            );

            $ownerCompany = (new BasicRepository(new OwnerCompany()))->getOrCreate(
                ['name' => $vehicle->getElementsByTagName('owner_company')[0]->nodeValue]
            );

            $owner = (new BasicRepository(new Owner()))->getOrCreate(
                [
                    'name' => $vehicle->getElementsByTagName('owner_name')[0]->nodeValue,
                    'company_id' => $ownerCompany->id
                ],
                ['profession' => $vehicle->getElementsByTagName('owner_profession')[0]->nodeValue]
            );

            $transmission = (new BasicRepository(new Transmission()))->getOrCreate(
                ['name' => $vehicle->getElementsByTagName('transmission')[0]->nodeValue]
            );

            $fuelType = (new BasicRepository(new FuelType()))->getOrCreate(
                ['name' => $vehicle->getElementsByTagName('fuel_type')[0]->nodeValue]
            );

            $data = [
                'seats_count' => $vehicle->getElementsByTagName('no_seats')[0]->nodeValue,
                'doors_count' => $vehicle->getElementsByTagName('no_doors')[0]->nodeValue,
                'wheels_count' => $vehicle->getElementsByTagName('no_wheels')[0]->nodeValue,
                'has_boot' => $vehicle->getElementsByTagName('has_boot')[0]->nodeValue ? true : false,
                'has_trailer' => $vehicle->getElementsByTagName('has_trailer')[0]->nodeValue ? true : false,
                'has_sunroof' => $vehicle->getElementsByTagName('sunroof')[0]->nodeValue ? true : false,
                'has_gps' => $vehicle->getElementsByTagName('has_gps')[0]->nodeValue ? true : false,
                'colour' => $vehicle->getElementsByTagName('colour')[0]->nodeValue,
                'engine_cc' => $vehicle->getElementsByTagName('engine_cc')[0]->nodeValue,
                'type_id' => $type->id,
                'fuel_type_id' => $fuelType->id,
                'model_id' => $model->id,
                'owner_id' => $owner->id,
                'transmission_id' => $transmission->id,
                'usage_id' => $usage->id,
                'weight_category_id' => $weightCategory->id,
            ];

            if(!$this->vehicleRepository->getOrCreate(
                ['license_plate' => $vehicle->getElementsByTagName('license_plate')[0]->nodeValue],
                $data
            )){
                return false;
            }
        }
        return true;
    }


}