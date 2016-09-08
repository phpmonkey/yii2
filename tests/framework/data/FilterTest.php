<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yiiunit\framework\data;

use yiiunit\TestCase;
use yii\data\Filter;

class FilterTest extends TestCase
{
    public function testBuildCondition()
    {
        $field_name   = 'some_field';
        $value_string = 'some_string';
        $value_int    = 8;
        $value_array  = [15, 16];
        $filter       = new Filter;

        $condition = $filter->buildCondition('>=', $field_name, $value_int);
        $this->assertEquals($condition, ['>=', $field_name, $value_int]);

        $condition = $filter->buildCondition('<=', $field_name, $value_int);
        $this->assertEquals($condition, ['<=', $field_name, $value_int]);

        $condition = $filter->buildCondition('>', $field_name, $value_int);
        $this->assertEquals($condition, ['>', $field_name, $value_int]);

        $condition = $filter->buildCondition('<', $field_name, $value_int);
        $this->assertEquals($condition, ['<', $field_name, $value_int]);

        $condition = $filter->buildCondition('!=', $field_name, $value_int);
        $this->assertEquals($condition, ['NOT', [$field_name => $value_int]]);

        $condition = $filter->buildCondition('!=', $field_name, $value_array);
        $this->assertEquals($condition, ['NOT IN', $field_name, $value_array]);

        $condition = $filter->buildCondition(null, $field_name, $value_int);
        $this->assertEquals($condition, [$field_name => $value_int]);

        $condition = $filter->buildCondition('like', $field_name, $value_string);
        $this->assertEquals($condition, ['like', $field_name, $value_string, false]);
    }
}
