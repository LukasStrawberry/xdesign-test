<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace Tests\Unit\Repository\Vehicle;

use App\Model\Vehicle\Vehicle;
use App\Repository\Vehicle\VehicleRepository;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class VehicleRepositoryTest extends TestCase
{

    /**
     * @var VehicleRepository
     */
    private $object;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Vehicle
     */
    private $vehicleModelMock;

    private function getVehicleData(){
        $faker = FakerFactory::create();

        return [
            'license_plate' => $faker->regexify('[A-Z0-9]{4} [A-Z0-9]{3}')
        ];
    }

    public function setUp()
    {
        parent::setUp();

        $this->vehicleModelMock = $this->getMockBuilder(Vehicle::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new VehicleRepository($this->vehicleModelMock);
    }

    public function testInsertReturnsBoolean(){
        $this->assertInternalType('bool', $this->object->insert($this->getVehicleData()));
    }

    public function testInsertWillAcceptNoEmptyArray(){
        $this->expectException(\LogicException::class);

        $this->object->insert([]);
    }

    public function testInsertCallsModelCreateOnceAndWithCorrectData(){
        $vehicleData = $this->getVehicleData();
        $this->vehicleModelMock->expects($this->once())
            ->method('__call')
            ->with('create', [$vehicleData]);

        $this->object->insert($vehicleData);
    }

    public function testInsertWillReturnFalseIfThereWasProblemToCreateRecord(){
        $vehicleData = $this->getVehicleData();
        $this->vehicleModelMock->expects($this->once())
            ->method('__call')
            ->with('create', [$vehicleData])
            ->willReturn(false);
        ;

        $this->assertEquals(false, $this->object->insert($vehicleData));
    }

    public function testInsertWillReturnVehicleIfRecordHasBeenCreated(){
        $vehicleData = $this->getVehicleData();
        $this->vehicleModelMock->expects($this->once())
            ->method('__call')
            ->with('create', [$vehicleData])
            ->willReturn(new Vehicle());
        ;

        $this->assertInstanceOf(Vehicle::class, $this->object->insert($vehicleData));
    }

}
