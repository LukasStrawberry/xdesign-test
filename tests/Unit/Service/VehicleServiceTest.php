<?php
/**
 * Created by PhpStorm.
 * User: lukasjahoda
 */

namespace Tests\Unit\Service\Vehicle;

use App\Exceptions\Vehicle\XMLFileDoesNotExistsException;
use App\Exceptions\Vehicle\XMLFileIsNotCorrectXMLException;
use App\Exceptions\Vehicle\XMLFileIsNotFileException;
use App\Exceptions\Vehicle\XMLFileIsNotReadableException;
use App\Exceptions\Vehicle\XMLFileIsNotValidAccordingToSchemaException;
use App\Repository\Vehicle\VehicleInterface;
use App\Service\Vehicle\VehicleService;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;

class VehicleServiceTest extends TestCase
{

    /**
     * @var VehicleService
     */
    private $object;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|VehicleInterface
     */
    private $vehicleRepositoryInterfaceMock;

    private $existingFilePath;

    public function setUp(){
        $fileName =  'exists' . time() . '.xml';
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('testDir'));
        $this->existingFilePath = vfsStream::newFile($fileName)
            ->at(vfsStreamWrapper::getRoot())
            ->setContent('<?xml version="1.0"?><xml>
    <Vehicle manufacturer="Citroen" model="308">
        <type>electric</type>
        <usage>personal</usage>
        <license_plate>HH14 PCH</license_plate>
        <weight_category>6</weight_category>
        <no_seats>2</no_seats>
        <has_boot/>
        <has_trailer>0</has_trailer>
        <owner_name>Arthur Emard</owner_name>
        <owner_company>Orn, Boyer and Feeney</owner_company>
        <owner_profession>Reservation Agent OR Transportation Ticket Agent</owner_profession>
        <transmission>manual</transmission>
        <colour>DarkGoldenRod</colour>
        <is_hgv>true</is_hgv>
        <no_doors>3</no_doors>
        <sunroof>0</sunroof>
        <has_gps>true</has_gps>
        <no_wheels>2</no_wheels>
        <engine_cc>2752</engine_cc>
        <fuel_type>electric</fuel_type>
    </Vehicle>
    </xml>')
            ->url();

        $this->vehicleRepositoryInterfaceMock = $this->getMockBuilder(VehicleInterface::class)
            ->getMock();

        $this->object = new VehicleService($this->vehicleRepositoryInterfaceMock, resource_path('assets/xsd/vehicle.xsd'));
    }

    public function testCreateFromXMLFileReturnsBoolean(){
        $this->assertInternalType('bool', $this->object->createFromXML($this->existingFilePath));
    }

    public function testCreateFromXMLFileThrowsXMLFileDoesNotExistsExceptionIfFileDoesNotExists(){
        $this->expectException(XMLFileDoesNotExistsException::class);

        $unExistentFileName = '/' . sha1(uniqid('notExistent')) . time();

        $this->object->createFromXML($unExistentFileName);
    }

    public function testCreateFromXMLFileThrowsXMLFileIsNotFileExceptionIfFileIsNotFile(){
        $this->expectException(XMLFileIsNotFileException::class);

        $this->object->createFromXML(vfsStreamWrapper::getRoot()->url());
    }

    public function testCreateFromXMLFileThrowsXMLFileIsNotReadableExceptionIfFileIsNotReadable(){
        $this->expectException(XMLFileIsNotReadableException::class);

        $file = vfsStream::newFile('unreadable')
            ->at(vfsStreamWrapper::getRoot())
            ->chmod(400)
            ->chown(1);

        $this->object->createFromXML($file->url());
    }

    public function testCreateFromXMLFileThrowsXMLFileIsNotCorrectXMLExceptionIfFileIsMalformated(){
        $this->expectException(XMLFileIsNotCorrectXMLException::class);

        $file = vfsStream::newFile('notProperXML')
            ->at(vfsStreamWrapper::getRoot())
            ->setContent('<xml><test />');

        $this->object->createFromXML($file->url());
    }

    public function testCreateFromXMLFileThrowsXMLFileIsNotValidAccordingToSchemaException(){
        $this->expectException(XMLFileIsNotValidAccordingToSchemaException::class);

        $file = vfsStream::newFile('notValidBySchema')
            ->at(vfsStreamWrapper::getRoot())
            ->setContent('<?xml version="1.0"?><xml><Vehicle manufacturer="Citroen" model="308"><type>electric</type></Vehicle></xml>');

        $this->object->createFromXML($file->url());
    }

    public function testCreateFromXMLCallsRepositoryInsert(){
        $this->vehicleRepositoryInterfaceMock
            ->expects($this->atLeastOnce())
            ->method('insert');

        $this->object->createFromXML($this->existingFilePath);
    }

    public function testCreateReturnFalseIfInsertIsNotSuccess(){
        $this->vehicleRepositoryInterfaceMock
            ->expects($this->atLeastOnce())
            ->method('insert')
            ->willReturn(false)
        ;

        $this->assertFalse($this->object->createFromXML($this->existingFilePath));
    }

    public function testCreateReturnTrueIfInsertIsSuccessFull(){
        $this->vehicleRepositoryInterfaceMock
            ->expects($this->atLeastOnce())
            ->method('insert')
            ->willReturn(true)
        ;

        $this->assertTrue($this->object->createFromXML($this->existingFilePath));
    }

}
