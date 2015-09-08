<?php

/**
 * @license    GNU/GPL
 * @author	Nicholas Blackwell
 * @license Geolive (CORE) by Nicholas Blackwell is licensed under a Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License.
 */
include_once Core::DatabasesDir() . DS . 'lib' . DS . 'CoreDatabase.php';

class ScheduleDatabase extends CoreDatabase {

    public function __construct($checkTables = false) {
        $this->subPrefix .= 'D_';
        parent::__construct();
    }

    /**
     * returns an array of table names indexed by a short keyword, number etc.
     * allows custom table sets to be created and
     * indentified uniquely (and quickly).
     *
     * @param string $p
     *            database table prefix. usually set by joomla installation.
     */
    protected function getTableNamesMap($p = null) {
        if (! $p) {
            $p = $this->getTablePrefix();
        }
        if (! $this->tableNames) {
            $this->tableNames = array(
                
                'Schedule' => $p . 'Schedule',
                'Addendum' => $p . 'Addendum',
                'Quarterly' => $p . 'Quarterly'
            );
        }
        
        return $this->tableNames;
    }

    protected function getTableCreateStrings() {
        $names = $this->getTableNamesMap();
        
        if (! $this->createStrings) {
            
            $Schedule = $names['Schedule'];
            
            $this->createStrings = array(
                $Schedule => 'CREATE TABLE ' . $Schedule . '(
				id INT(11) AUTO_INCREMENT,
                uid INT(11)
					COMMENT "a unique id that identifies the author",
				code VARCHAR(100)
					COMMENT "a unique code generated for each schedule d identifies",

				PRIMARY KEY (id)
			)'
            );
        }
        
        return $this->createStrings;
    }
    
    // Event Tables Methods
    public function getSchedule($id) {
        return $this->recordList('Schedule', array(
            'id' => $id
        ));
    }

    public function iterateAllSchedules($callback, $filter = array()) {
        return $this->recordIterate('Schedule', $callback, $filter);
    }

    public function getScheduleByCode($code) {
        return $this->recordList('Schedule', array(
            'code' => $code
        ));
    }

    public function createSchedule($args) {
        return $this->createEntry($args, 'Schedule', array(
            'code',
            'uid'
        ));
    }

    public function updateSchedule($args) {
        return $this->updateEntry($args, 'Schedule', array(
            'code',
            'uid'
        ));
    }

    public function deleteSchedule($id) {
        return $this->deleteEntry('Schedule', array(
            'id' => $id
        ));
    }
}
