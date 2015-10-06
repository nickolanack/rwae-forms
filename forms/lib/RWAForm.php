<?php

class RWAForm {

    public static function ValidateScheduleDData($data) {

        self::_Validate($data);
        
        $code = self::_GetPid($data);
        $data->{'participant-id'} = $code;
        $id = self::_GetId($data);
        
        if ($id > 0) {
            self::_EnsurePidConsistentForScheduleD($id, $code);
        }
        
        $data->{'participant-id'} = $code;
        return $data;
    }

    private static function _Validate($data) {

        if (!is_object($data)) {
            throw new Exception('Expected Object: ' . print_r($data, true));
        }
    }

    private static function _GetPid($data) {

        $code = '';
        if (key_exists('participant-id', $data) && !empty($data->{'participant-id'})) {
            $code = $data->{'participant-id'};
        } else {
            $code = self::_GeneratePid();
        }
        return $code;
    }

    private static function _GetId($data) {

        $id = -1;
        if (key_exists('id', $data)) {
            if ($data->id > 0) {
                $id = $data->id;
            }
        }
        return $id;
    }

    public static function ValidateAddendumData($data) {

        self::_Validate($data);
        
        $code = self::_GetPid($data);
        self::_EnsurePidConsistentForAddendum(self::_GetId($data), $code);
        
        $data->{'participant-id'} = $code;
        return $data;
    }

    public static function ValidateQuarterlyData($data) {

        self::_Validate($data);
        
        $code = self::_GetPid($data);
        
        self::_EnsurePidConsistentForQuarterly(self::_GetId($data), $code);
        
        $data->{'participant-id'} = $code;
        return $data;
    }

    private static function _EnsurePidConsistentForScheduleD($id, $pid) {
        // check that pid does not overlap with any other pids if it has been changed.
        // if it has been changed, then updated all adendums/and quarterly reports to match
    }

    private static function _EnsurePidConsistentForAddendum($id, $pid) {

        if (empty($pid)) {
            throw new Exception('Pid not set for Addendum');
        }
    }

    private static function _EnsurePidConsistentForQuarterly($id, $pid) {

        if (empty($pid)) {
            throw new Exception('Pid not set for Quarterly');
        }
    }

    private static function _GeneratePid() {

        return 'gen-rwa-' . rand(100000, 999999) . '-pid';
    }

    public static function GetFormDate($data) {

        $qtr = array(
            '1st' => '01',
            '2nd' => '04',
            '3rd' => '07',
            '4th' => '10'
        );
        
        return $data->{'admin-year'} . '-' . $qtr[$data->{'admin-quarter'}] . '-01 00:00:00';
    }
}