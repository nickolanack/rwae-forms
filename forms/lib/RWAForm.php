<?php

class RWAForm
{

    public static function ValidateScheduleDData($data)
    {

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

    private static function _Validate($data)
    {

        if (!is_object($data)) {
            throw new Exception('Expected Object: ' . print_r($data, true));
        }
    }

    private static function _GetPid($data)
    {

        $code = '';
        if (key_exists('participant-id', $data) && !empty($data->{'participant-id'})) {
            $code = $data->{'participant-id'};
        } else {
            $code = self::_GeneratePid();
        }
        return $code;
    }

    private static function _GetId($data)
    {

        $id = -1;
        if (key_exists('id', $data)) {
            if ($data->id > 0) {
                $id = $data->id;
            }
        }
        return $id;
    }

    public static function ValidateAddendumData($data)
    {

        self::_Validate($data);

        $code = self::_GetPid($data);
        self::_EnsurePidConsistentForAddendum(self::_GetId($data), $code);

        $data->{'participant-id'} = $code;
        return $data;
    }

    public static function ValidateQuarterlyData($data)
    {

        self::_Validate($data);

        $code = self::_GetPid($data);

        self::_EnsurePidConsistentForQuarterly(self::_GetId($data), $code);

        $data->{'participant-id'} = $code;
        return $data;
    }

    private static function _EnsurePidConsistentForScheduleD($id, $pid)
    {
        // check that pid does not overlap with any other pids if it has been changed.
        // if it has been changed, then updated all adendums/and quarterly reports to match
    }

    private static function _EnsurePidConsistentForAddendum($id, $pid)
    {

        if (empty($pid)) {
            throw new Exception('Pid not set for Addendum');
        }
    }

    private static function _EnsurePidConsistentForQuarterly($id, $pid)
    {

        if (empty($pid)) {
            throw new Exception('Pid not set for Quarterly');
        }
    }

    private static function _GeneratePid()
    {
        return 'XX-'.rand(100, 999).'-'.rand(100, 999);
    }

    public static function GetFormDate($data)
    {

        $qtr = array(
            '1st' => '01',
            '2nd' => '04',
            '3rd' => '07',
            '4th' => '10',
        );

        return $data->{'admin-year'} . '-' . $qtr[$data->{'admin-quarter'}] . '-01 00:00:00';
    }

    public static function GetFieldNames($formName)
    {
        return array_map(function ($f) {

            return $f['name'];

        }, self::GetFormMetadata($formName));
    }

    public static function GetFormMetadata($formName)
    {

        ob_start();
        Scaffold('form.' . $formName, array(), dirname(__DIR__) . '/views');
        $html = ob_get_contents();
        ob_end_clean();

        if (empty($html) || strpos($html, 'invalid') === 0) {
            throw new Exception('Invalid Form form.' . $formName);
        }

        return self::_FieldMetadataArray($html);
    }

    protected static function _FieldMetadataArray($html)
    {

        $fieldMetadataArray = array();
        $fields = self::_FieldElementArray($html);
        foreach ($fields as $field) {

            $fieldHtml = $field['html'];

            if (strpos($fieldHtml, '<input') === 0) {
                $fieldMetadataArray[] = self::_InputMetadata($fieldHtml);
            } elseif (strpos($fieldHtml, '<textarea') === 0) {
                $fieldMetadataArray[] = self::_TextareaMetadata($fieldHtml);
            } elseif (strpos($fieldHtml, '<select') === 0) {
                $fieldMetadataArray[] = self::_SelectMetadata($fieldHtml);
            } else {

                throw new Exception('Unknown field type: ' . $fieldHtml);

            }

        }

        return self::_GroupFieldMetadata($fieldMetadataArray);

    }

    protected static function _GroupFieldMetadata($fieldMetadataArray)
    {

        $groupedFields = array();

        $i = -1;
        foreach ($fieldMetadataArray as $field) {

            if ($i > 0 && $groupedFields[$i]['name'] === $field["name"]) {

                if (!key_exists('values', $groupedFields[$i])) {
                    $groupedFields[$i]['values'] = array($groupedFields[$i]['value']);

                    if (!key_exists('checked', $groupedFields[$i])) {
                        unset($groupedFields[$i]['value']);
                    }

                }

                $groupedFields[$i]['values'][] = $field['value'];

            } else {

                $groupedFields[] = $field;

                $i++;
            }

        }
        return $groupedFields;
    }

    protected static function _FieldElementArray($html)
    {
        $elements = array();
        foreach (self::_ElementArray($html, '<input', '/>') as $el) {
            $elements[] = $el;
        }

        foreach (self::_ElementArray($html, '<textarea', '</textarea>') as $el) {
            $elements[] = $el;
        }

        foreach (self::_ElementArray($html, '<select', '</select>') as $el) {
            $elements[] = $el;
        }

        $comments = array();
        foreach (self::_ElementArray($html, '<!--', '-->') as $el) {
            $comments[] = $el;
        }

        $elements = array_filter($elements, function ($el) use ($comments) {

            foreach ($comments as $comment) {

                if ($comment['index'] < $el['index'] && ($comment['index'] + strlen($comment['html'])) > $el['index']) {
                    return false;
                }
            }
            return true;

        });

        usort($elements, function ($a, $b) {
            return $a['index'] - $b['index'];
        });

        return $elements;
    }

    protected static function _ElementArray($html, $start, $end)
    {
        $items = array();

        $i = 0;
        while (($i = strpos($html, $start, $i)) !== false) {
            $e = strpos($html, $end, $i + strlen($start));
            $e += strlen($end);

            $items[] = array(
                'html' => substr($html, $i, $e - $i),
                'index' => $i,
            );

            $i = $e;

        }

        return $items;

    }

    protected static function _InputMetadata($html)
    {
        $meta = array(
            'name' => self::_AttributeValue($html, 'name'),
            'type' => self::_AttributeValue($html, 'type'),
            'value' => self::_AttributeValue($html, 'value'),
        );

        if ($meta['type'] === "radio" || $meta['type'] === "checkbox") {

            if (strpos($html, 'checked="checked"') !== false) {
                $meta['default'] = true;
            }

        }

        return $meta;
    }

    protected static function _AttributeValue($html, $attribute)
    {

        $values = explode($attribute . '="', $html);

        if (count($values) < 2) {
            throw new Exception('html should have attribute: ' . $attribute . ' ' . $html);
        }

        $value = $values[1];
        return substr($value, 0, strpos($value, '"'));
    }

    protected static function _TextareaMetadata($html)
    {
        $meta = array(
            'name' => self::_AttributeValue($html, 'name'),
            'value' => '',
        );
        return $meta;
    }
    protected static function _SelectMetadata($html)
    {

        $options = self::_ElementArray($html, '<option', '</option>');

        $meta = array(
            'name' => self::_AttributeValue($html, 'name'),
            'values' => array(),
            'value' => self::_AttributeValue($options[0]['html'], 'value'),
        );

        foreach ($options as $opt) {
            $meta['values'][] = self::_AttributeValue($opt['html'], 'value');
            if (strpos($opt['html'], 'checked="checked"') !== false) {
                $meta['value'] = $meta['values'][count($meta['values']) - 1];
            }
        }

        return $meta;
    }

}
