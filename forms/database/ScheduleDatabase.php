<?php

/**
 * @license    GNU/GPL
 * @author    Nicholas Blackwell
 * @license Geolive (CORE) by Nicholas Blackwell is licensed under a Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License.
 */
include_once Core::DatabasesDir() . DS . 'lib' . DS . 'CoreDatabase.php';

class ScheduleDatabase extends CoreDatabase
{

    public function __construct($checkTables = false)
    {

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
    protected function getTableNamesMap($p = null)
    {

        if (!$p) {
            $p = $this->getTablePrefix();
        }
        if (!$this->tableNames) {
            $this->tableNames = array(

                'Schedule' => $p . 'Schedule',
                'Addendum' => $p . 'Addendum',
                'Quarterly' => $p . 'Quarterly',
            );
        }

        return $this->tableNames;
    }

    protected function getTableCreateStrings()
    {

        $names = $this->getTableNamesMap();

        if (!$this->createStrings) {

            $Schedule = $names['Schedule'];
            $Addendum = $names['Addendum'];
            $Quarterly = $names['Quarterly'];

            $this->createStrings = array(
                $Schedule => 'CREATE TABLE ' . $Schedule . '(
				id INT(11) AUTO_INCREMENT,
                uid INT(11)
					COMMENT "user id of the form the author",
				code VARCHAR(100)
					COMMENT "a unique id code that identifies the participant",
                formData LONGTEXT
					COMMENT "json encoded form data",
                submitDate DATETIME
                    COMMENT "the date when the form was submitted. may not relate to the form year and quarter",
                formDate DATETIME
                    COMMENT "the date that the form is meant to refer to"
				PRIMARY KEY (id)
			)',

                $Addendum => 'CREATE TABLE ' . $Addendum . '(
				id INT(11) AUTO_INCREMENT,
                uid INT(11)
					COMMENT "user id of the form the author",
				code VARCHAR(100)
					COMMENT "a unique id code that identifies the participant",
                formData LONGTEXT
					COMMENT "json encoded form data",
                submitDate DATETIME
                    COMMENT "the date when the form was submitted. may not relate to the form year and quarter",
                formDate DATETIME
                    COMMENT "the date that the form is meant to refer to"

				PRIMARY KEY (id)
			)',

                $Quarterly => 'CREATE TABLE ' . $Quarterly . '(
				id INT(11) AUTO_INCREMENT,
                uid INT(11)
					COMMENT "user id of the form the author",
				code VARCHAR(100)
					COMMENT "a unique id code that identifies the participant",
                formData LONGTEXT
					COMMENT "json encoded form data",
                submitDate DATETIME
                    COMMENT "the date when the form was submitted. may not relate to the form year and quarter",
                formDate DATETIME
                    COMMENT "the date that the form is meant to refer to"

				PRIMARY KEY (id)
			)',
            );
        }

        return $this->createStrings;
    }

    // Event Tables Methods
    public function getSchedule($id)
    {

        return $this->recordList('Schedule', array(
            'id' => $id,
        ));
    }

    public function iterateAllSchedules($callback, $filter = array())
    {

        return $this->recordIterate('Schedule', $callback, $filter);
    }

    public function countAllSchedules($filter = array())
    {

        return $this->countEntries('Schedule', $filter);
    }

    public function createSchedule($args)
    {

        return $this->createEntry($args, 'Schedule',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function updateSchedule($args)
    {

        return $this->updateEntry($args, 'Schedule',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function deleteSchedule($id)
    {

        return $this->deleteEntry('Schedule', array(
            'id' => $id,
        ));
    }

    public function iterateAllAddendums($callback, $filter = array())
    {

        return $this->recordIterate('Addendum', $callback, $filter);
    }

    public function createAddendum($args)
    {

        return $this->createEntry($args, 'Addendum',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function updateAddendum($args)
    {

        return $this->updateEntry($args, 'Addendum',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function deleteAddendum($id)
    {

        return $this->deleteEntry('Addendum', array(
            'id' => $id,
        ));
    }

    public function iterateAllQuarterlys($callback, $filter = array())
    {

        return $this->recordIterate('Quarterly', $callback, $filter);
    }

    public function createQuarterly($args)
    {

        return $this->createEntry($args, 'Quarterly',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function updateQuarterly($args)
    {

        return $this->updateEntry($args, 'Quarterly',
            array(
                'code',
                'uid',
                'formData',
                'submitDate',
                'formDate',
            ));
    }

    public function deleteQuarterly($id)
    {

        return $this->deleteEntry('Quarterly', array(
            'id' => $id,
        ));
    }
}
