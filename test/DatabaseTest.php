<?php
/**
 *
 * @author nblackwe
 *
 */
class DatabaseTest extends PHPUnit_Framework_TestCase
{

    protected function _includeCore()
    {
        if (!defined('_JEXEC')) {
            define('_JOOMLA', 1);
        }

		/**
		 * use php-core-app a web-app framework for php
		 * and joomla.
		 */
        include_once dirname(__DIR__) . '/forms/php-core-app/core.php';
        Core::Parameters()->disableCaching();
        Core::Parameters()->disableCompression();

        Core::HTML()->setDomain('example.com')->setScriptPath('index.php');

    }

    /**
     * @runInSeparateProcess
     */
    public function testDatabase()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        $db = ScheduleDatabase::GetInstance();

        $db->iterateAllSchedules(function($row){

        	$this->assertTrue(true);
        });

        $this->assertTrue(true);

    }


    /**
     * @runInSeparateProcess
     */
    public function testVerifyDatabase()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        $db    = ScheduleDatabase::GetInstance();

        foreach ($db->tables() as $table) {
            $this->assertTrue(!empty($table));
            $updates = $db->verifyTable($table);
            if (count($updates)) {
                array_walk($updates,
                    function ($alter) use ($db) {
                        $db->execute($alter);
                    
                    });
            }
        }

    }


     /**
     * @runInSeparateProcess
     */
    public function testUserData()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
        $db    = ScheduleDatabase::GetInstance();

        $uid=9999;
        $results=$db->getUserData($uid);
        if(! $results){
            $db->createUserData(array('uid'=>$uid, 'data'=>json_encode(array('rwa-prefixes'=>array('bc', 'ab')),JSON_PRETTY_PRINT)));
        }else{
            $db->updateUserData(array('id'=>$results[0]->id, 'uid'=>$uid, 'data'=>json_encode(array('rwa-prefixes'=>array('bc', 'ab')),JSON_PRETTY_PRINT)));
        }


        $this->assertEquals(array('bc', 'ab'), json_decode($db->getUserData($uid)[0]->data)->{'rwa-prefixes'});

    }



     /**
     * @runInSeparateProcess
     */
    public function testListOrPrefix()
    {

        $this->_includeCore();

        include_once dirname(__DIR__) . DS . 'forms/database' . DS . 'ScheduleDatabase.php';
          $db = ScheduleDatabase::GetInstance();

        $uid=455;
        $prefixes=array();

        $results=$db->getUserData($uid);

        if($results){
            $prefixes=json_decode($results[0]->data)->{'rwa-prefixes'};
        }

        $filter= array(
                array_merge(array('join'=>'OR', 'uid' => $uid), array_map(function($p){
                    return array('field'=>'LOWER(code)','value'=>strtolower($p).'-%', 'comparator'=>'LIKE');
                },$prefixes)),
                'ORDER BY' => 'submitDate DESC',
            );
     
        $count = 0;

        echo '{"results":[' . "\n";

        

        $db->iterateAllSchedules(
            function ($record) use(&$count){
               $count++;
            }, $filter);

        $query = $db->lastQuery();
        $this->fail($query.' => '.$count.' '. print_r($filter, true));

    }


}
