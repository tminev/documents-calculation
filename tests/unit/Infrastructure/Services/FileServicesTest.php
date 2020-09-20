<?php

namespace UnitTest\Infrastructure\Services;

use Application\Exceptions\NotFoundException;
use Application\Services\FileService;
use Codeception\Test\Unit;

/**
 * Class FileServiceTest
 *
 * @author Grigor Milchev <grigor@devision.bg>
 */
class FileServiceTest extends Unit
{
    /**
     * Tests the file services get file content
     */
    public function testFileServicesGetFileContent()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->disableOriginalConstructor()
        ->setMethods(['getFileContent'])
        ->getMock();

        $result = $fileServicesMock->getFileContent(
            'Data/data.csv'
        );

        $this->assertEmpty($result);
        $this->assertEquals($result, []);
    }

    /**
     * Tests the file services process
     */
    public function testFileServiceProcess()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->disableOriginalConstructor()
        ->setMethods(['process'])
        ->getMock();

        $fileServicesMock->expects($this->once())
        ->method('process')
        ->willReturn([
            '123465123'=> ["totalАmount"=> 1543]
        ]);
        $data = [
            ['Vendor 3', '123465123','1000000259', '1', 'GBP','1300'],
            ['Vendor 1', '123465789','1000000260', '1', 'EUR','200'],
            ['Vendor 3', '123465789','1000000261', '1', 'USD','200']
            ];

        $result = $fileServicesMock->process(
            $data,
            '123465123',
            'EUR:1,USD:0.987,GBP:0.878',
            'USD'
        );

        $this->assertNotEmpty($result);
        $this->assertEquals($result, [
            '123465123'=> ["totalАmount"=> 1543]
        ]);
    }

    /**
     * Tests the file services currency exchange is ok
     */
    public function testFileServicesCurrencyExchangeIsOk()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->setConstructorArgs([
            ['config' => ['allowedCurrencies' => ['EUR','GBP','USD']]]
        ])
        ->setMethods(['currencyExchange'])
        ->getMock();

        $fileServicesMock->expects($this->once())
        ->method('currencyExchange')
        ->willReturn(418);

        $result = $fileServicesMock->currencyExchange(
            'EUR:1,USD:0.987,GBP:0.878',
            'USD',
            'GBP',
            400
        );

        $this->assertNotEmpty($result);
        $this->assertEquals($result, 418);
    }

    /**
     * Tests the file services parent document exist
     */
    public function testFileServicesParentDocumentExist()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->disableOriginalConstructor()
        ->setMethods(['parentDocumentExist'])
        ->getMock();

        $fileServicesMock->expects($this->once())
        ->method('parentDocumentExist')
        ->willReturn(true);

        $data = [
            ['Vendor 1', '1000000260','1000000259', '1', 'GBP','1300'],
            ['Vendor 1', '123465789','1000000260', '1', 'EUR','200'],
            ['Vendor 1', '123465789','1000000261', '1', 'USD','200']
            ];
        $result = $fileServicesMock->parentDocumentExist($data);

        $this->assertNotEmpty($result);
        $this->assertEquals($result, true);
    }

    /**
     * Tests the file services parent document not exist
     */
    public function testFileServicesParentDocumentNotExist()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->disableOriginalConstructor()
        ->setMethods(['parentDocumentExist'])
        ->getMock();

        $fileServicesMock->expects($this->once())
        ->method('parentDocumentExist')
        ->willReturn(new NotFoundException());

        $data = [
            ['Vendor 1', '123465123','1000000259', '1', 'GBP','1300'],
            ['Vendor 1', '123465789','1000000260', '1', 'EUR','200'],
            ['Vendor 1', '123465789','1000000261', '1', 'USD','200']
            ];
        $result = $fileServicesMock->parentDocumentExist($data);

        $this->assertNotEmpty($result);
        $this->assertEquals($result, new NotFoundException());
    }

    /**
     * Tests the file services calculate total
     */
    public function testFileServicesCalculateTotal()
    {
        $fileServicesMock = $this->getMockBuilder(FileService::class)
        ->disableOriginalConstructor()
        ->setMethods(['calculateTotal'])
        ->getMock();

        $fileServicesMock->expects($this->once())
        ->method('calculateTotal')
        ->willReturn(1458);

        $data = [
            ['Vendor 1', '1000000260','1000000259', '1', 'GBP','1300'],
            ['Vendor 1', '123465789','1000000260', '1', 'EUR','200'],
            ['Vendor 1', '123465789','1000000261', '1', 'USD','200']
            ];
        $result = $fileServicesMock->calculateTotal($data);

        $this->assertNotEmpty($result);
        $this->assertEquals($result, 1458);
    }
}
