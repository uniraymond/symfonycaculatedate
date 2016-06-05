<?php
//src/tests/AppBundle/Utils/CaculateDaysTest.php
namespace Test\AppBundle\Utils;

use AppBundle\Utils\CaculateDays;
class CaculateDaysTest extends \PHPUnit_Framework_TestCase
{
    public function testDatediff(){
        $cacu = new CaculateDays();
        $data = array('dateFrom'=>'2016-6-2','dateTo'=>'2016-6-6', 'timetype'=>0, 'interval'=>'wd');
        $this->assertEquals(2, $cacu->datediff($data));
        $data = array('dateFrom'=>'2016-6-3','dateTo'=>'2016-6-5', 'timetype'=>0, 'interval'=>'wd');
        $this->assertEquals(1, $cacu->datediff($data));
        $data = array('dateFrom'=>'2016-6-2','dateTo'=>'2016-6-4', 'timetype'=>0, 'interval'=>'wd');
        $this->assertEquals(0, $cacu->datediff($data));
        $data = array('dateFrom'=>'2016-6-2 10:10:10','dateTo'=>'2016-6-5 9:9:9', 'timetype'=>1, 'interval'=>'wd');
        $this->assertEquals(48, $cacu->datediff($data));
    }
}